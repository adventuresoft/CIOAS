import re

with open('resources/views/backend/pages/inventory/create.blade.php', 'r') as f:
    content = f.read()

# Add Product Type in the table header
header_pattern = r'<th style="min-width: 170px;">Category</th>'
new_header = '<th style="min-width: 150px;">Product Type</th>\n                                        <th style="min-width: 170px;">Category</th>'
content = re.sub(header_pattern, new_header, content)

# Add Product Type in the table body
body_pattern = r'<td>\s*<select class="form-control form-control-sm item-category" required>'
new_body = '''<td>
                                                <select class="form-control form-control-sm item-product-type" name="items[{{ $itemIndex }}][product_type]" required>
                                                    <option value="">Select</option>
                                                    <option value="One time use" {{ isset($item['product_type']) && $item['product_type'] === 'One time use' ? 'selected' : '' }}>One time use</option>
                                                    <option value="All time use" {{ isset($item['product_type']) && $item['product_type'] === 'All time use' ? 'selected' : '' }}>All time use</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm item-category" name="items[{{ $itemIndex }}][category]" required>'''
content = re.sub(body_pattern, new_body, content)

with open('resources/views/backend/pages/inventory/create.blade.php', 'w') as f:
    f.write(content)
