import re

with open('resources/views/backend/pages/vehicle/edit.blade.php', 'r') as f:
    content = f.read()

# Fix AJAX url
content = content.replace('url: "{{ route(\'vehicle.store\') }}"', 'url: "{{ route(\'vehicle.update\', $vehicle->id) }}"')

# Fix Select defaults (vehicle_type and vehicle_category are populated via JS, but we want them to default to $vehicle->val)
# To do this, in JS, after populating, we should set the val
js_select_fix = """
    populateSelect($type, Object.keys(vehicleData), "Select Vehicle Type");
    $type.val('{{ $vehicle->vehicle_type }}').trigger('change');

    populateSelect($category, vehicleData['{{ $vehicle->vehicle_type }}'] || [], "Select Vehicle Category");
    $category.val('{{ $vehicle->vehicle_category }}').trigger('change');
"""
content = re.sub(r'populateSelect\(\$type, Object.keys\(vehicleData\), "Select Vehicle Type"\);\s*populateSelect\(\$category, \[\], "Select Vehicle Category"\);', js_select_fix, content)

# Fix route iteration
route_blade = """<tbody id="routeBody">
                                            @if($vehicle->routes->count() > 0)
                                                @foreach($vehicle->routes as $index => $route)
                                                <tr>
                                                    <td><input type="text" name="routes[{{ $index }}][from_point]" value="{{ $route->from_point }}" class="form-control" placeholder="From Point" required></td>
                                                    <td><input type="text" name="routes[{{ $index }}][middle_point]" value="{{ $route->middle_point }}" class="form-control" placeholder="Middle Point"></td>
                                                    <td><input type="text" name="routes[{{ $index }}][end_point]" value="{{ $route->end_point }}" class="form-control" placeholder="End Point" required></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td><input type="text" name="routes[0][from_point]" value="" class="form-control" placeholder="From Point" required></td>
                                                    <td><input type="text" name="routes[0][middle_point]" value="" class="form-control" placeholder="Middle Point"></td>
                                                    <td><input type="text" name="routes[0][end_point]" value="" class="form-control" placeholder="End Point" required></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                            @endif
                                        </tbody>"""

content = re.sub(r'<tbody id="routeBody">.*?</tbody>', route_blade, content, flags=re.DOTALL)

# In JS for addRouteBtn
# let routeIndex = 1; -> let routeIndex = {{ $vehicle->routes->count() > 0 ? $vehicle->routes->count() : 1 }};
content = content.replace('let routeIndex = 1;', 'let routeIndex = {{ $vehicle->routes->count() > 0 ? $vehicle->routes->count() : 1 }};')

# the JS HTML append has value="{{ $vehicle->routes[${routeIndex}][from_point] }}" which is broken syntax. Fix it to have empty value
content = re.sub(r'value="\{\{ \$vehicle->routes\[\$\{routeIndex\}\]\[from_point\] \}\}"', 'value=""', content)
content = re.sub(r'value="\{\{ \$vehicle->routes\[\$\{routeIndex\}\]\[middle_point\] \}\}"', 'value=""', content)
content = re.sub(r'value="\{\{ \$vehicle->routes\[\$\{routeIndex\}\]\[end_point\] \}\}"', 'value=""', content)

with open('resources/views/backend/pages/vehicle/edit.blade.php', 'w') as f:
    f.write(content)
