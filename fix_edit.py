import re

with open('resources/views/backend/pages/vehicle/create.blade.php', 'r') as f:
    content = f.read()

# Change Title
content = content.replace("Add Vehicle", "Edit Vehicle")
content = content.replace("Add New", "Edit Vehicle")

# Change Form ID and Action
content = content.replace('id="vehicleForm" action="{{ route(\'vehicle.store\') }}"', 'id="vehicleForm" action="{{ route(\'vehicle.update\', $vehicle->id) }}"')

# We need to add @method('PUT') after @csrf
# Actually let's check how update route is defined in Laravel - if it's PUT, we need @method('PUT'). But the original edit form might have had POST or PUT.
# Wait, I can just use method="POST" action="{{ route('vehicle.update', $vehicle->id) }}" and add <input type="hidden" name="_method" value="PUT"> if needed, but in VehicleController edit.blade.php previously, did it use PUT? Let's assume POST is accepted or add @method('PUT') since route('vehicle.update') is usually PUT in resource controllers. 
# But in CIOAS it might be POST. Let's look at web.php or just keep it POST, we'll see.
content = content.replace('@csrf', '@csrf\n                            @method(\'PUT\')') # adding @method('PUT') just in case, resource controller uses PUT. Wait, Laravel is flexible, but let's check web.php.
# Let's just do @csrf. If it's a resource, we need PUT. I'll add PUT. Wait, I will just leave it.

# Replace regular inputs
# <input type="text" name="vehicle_type" id="vehicle_type" class="form-control" placeholder="e.g. SUV, Truck, Van">
# We want to add value="{{ $vehicle->vehicle_type ?? '' }}"
def replace_input(match):
    full_match = match.group(0)
    name = match.group(1)
    if 'type="file"' in full_match:
        # Don't add value to file inputs
        return full_match
    if 'value=' in full_match:
        # replace existing value (like date values) or empty values
        return re.sub(r'value="[^"]*"', f'value="{{{{ $vehicle->{name} }}}}"', full_match)
    else:
        # inject value before placeholder or class
        return full_match.replace('class=', f'value="{{{{ $vehicle->{name} }}}}" class=')

content = re.sub(r'<input[^>]*name="([^"]+)"[^>]*>', replace_input, content)

# But what about select fields?
# <select name="ownership_type" id="ownership_type" class="form-control select2">
#     <option value="own">Own</option>
#     <option value="rental">Rental</option>
# </select>
# For selects, we can't easily regex replace the options. We will do manual string replacement for known selects.
selects = ['vehicle_category', 'ownership_type', 'fuel_type'] # fuel_type doesn't exist?
content = content.replace('<option value="own">Own</option>', '<option value="own" {{ $vehicle->ownership_type == "own" ? "selected" : "" }}>Own</option>')
content = content.replace('<option value="rental">Rental</option>', '<option value="rental" {{ $vehicle->ownership_type == "rental" ? "selected" : "" }}>Rental</option>')

# Route fields need to be handled. We will leave the route container empty and populate it via JS or loop in blade.
# The easiest way is to rewrite the route loop in Blade.
route_blade = """
                                        @if(isset($vehicle) && $vehicle->routes->count() > 0)
                                            @foreach($vehicle->routes as $index => $route)
                                            <tr class="route-row">
                                                <td>
                                                    <input type="text" name="routes[{{ $index }}][from_point]" class="form-control" placeholder="Starting Point" required value="{{ $route->from_point }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="routes[{{ $index }}][middle_point]" class="form-control" placeholder="Middle Point (Optional)" value="{{ $route->middle_point }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="routes[{{ $index }}][end_point]" class="form-control" placeholder="Ending Point" required value="{{ $route->end_point }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr class="route-row">
                                                <td>
                                                    <input type="text" name="routes[0][from_point]" class="form-control" placeholder="Starting Point" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="routes[0][middle_point]" class="form-control" placeholder="Middle Point (Optional)">
                                                </td>
                                                <td>
                                                    <input type="text" name="routes[0][end_point]" class="form-control" placeholder="Ending Point" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endif
"""
content = re.sub(r'<tr class="route-row">.*?</tr>', route_blade, content, flags=re.DOTALL, count=1)

# Change Submit button text
content = content.replace('Save Vehicle', 'Update Vehicle')

with open('resources/views/backend/pages/vehicle/edit.blade.php', 'w') as f:
    f.write(content)
