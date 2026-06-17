import re

with open('resources/views/backend/pages/vehicle/edit.blade.php', 'r') as f:
    content = f.read()

# Wrap Allocate to Route section
section_start = r'(<hr>\s*<h5 class="text-info mb-3"><i class="fas fa-route"></i> Allocate to Route</h5>)'
content = re.sub(section_start, r'<div id="routeAllocationSection" style="display: {{ $vehicle->vehicle_type == \'Heavy Passenger Vehicle\' ? \'block\' : \'none\' }};">\n                            \1', content)

section_end = r'(<button type="button" class="btn btn-success btn-sm mt-2" id="addRouteBtn"><i class="fas fa-plus"></i> Add More Route</button>\s*</div>\s*</div>)'
content = re.sub(section_end, r'\1\n                            </div>', content)

# Add JS toggle
js_find = r'(\$category\.val\(\'\{\{ \$vehicle->vehicle_category \}\}\'\)\.trigger\(\'change\'\);)'
js_replace = r'''\1

    // Toggle Route Allocation Section based on vehicle type
    $type.on("change", function () {
        if ($(this).val() === "Heavy Passenger Vehicle") {
            $("#routeAllocationSection").slideDown();
        } else {
            $("#routeAllocationSection").slideUp();
        }
    });'''

content = re.sub(js_find, js_replace, content)

with open('resources/views/backend/pages/vehicle/edit.blade.php', 'w') as f:
    f.write(content)

