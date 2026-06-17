import re
import sys

def process_file(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    # HTML addition
    html_addition = """<input type="text" name="driver_registration_no" value="{{ $vehicle->driver_registration_no ?? '' }}" class="form-control" id="driver_registration_no" placeholder="Enter Registration Number">
                                        <div id="driver_info_display" class="mt-2 text-primary" style="display: none; font-weight: 500;">
                                            <i class="fas fa-user-check"></i> Driver Found: <span id="driver_name_display"></span> (<span id="driver_phone_display"></span>)
                                        </div>
                                        <div id="driver_info_error" class="mt-2 text-danger" style="display: none; font-weight: 500;">
                                            <i class="fas fa-times-circle"></i> Driver not found
                                        </div>"""
    
    # We replace the input field
    # Notice that edit.blade.php has `value="{{ $vehicle->driver_registration_no }}"` whereas create.blade.php doesn't or has `value=""`
    # Let's just use regex to match the input line
    content = re.sub(r'<input type="text" name="driver_registration_no".*?>', html_addition, content)

    # JS addition
    js_addition = """
    const driverInput = $('#driver_registration_no');
    const driverInfoDisplay = $('#driver_info_display');
    const driverInfoError = $('#driver_info_error');
    const driverNameDisplay = $('#driver_name_display');
    const driverPhoneDisplay = $('#driver_phone_display');

    function fetchDriverInfo() {
        const driverId = driverInput.val();
        if (driverId.length > 0) {
            $.ajax({
                url: "{{ route('vehicle.api.driver_info') }}",
                type: "GET",
                data: { driver_id: driverId },
                success: function(response) {
                    if (response.status) {
                        driverNameDisplay.text(response.name);
                        driverPhoneDisplay.text(response.phone || 'No Phone');
                        driverInfoDisplay.show();
                        driverInfoError.hide();
                    } else {
                        driverInfoDisplay.hide();
                        driverInfoError.show();
                    }
                },
                error: function() {
                    driverInfoDisplay.hide();
                    driverInfoError.hide();
                }
            });
        } else {
            driverInfoDisplay.hide();
            driverInfoError.hide();
        }
    }

    driverInput.on('input', function() {
        clearTimeout(window.driverTimeout);
        window.driverTimeout = setTimeout(fetchDriverInfo, 500);
    });

    // Run once on load if there's a value
    if (driverInput.val() !== '') {
        fetchDriverInfo();
    }
    """
    
    # Add JS before </script>
    content = content.replace('</script>', js_addition + '\n</script>')

    with open(filepath, 'w') as f:
        f.write(content)

process_file('resources/views/backend/pages/vehicle/create.blade.php')
process_file('resources/views/backend/pages/vehicle/edit.blade.php')
