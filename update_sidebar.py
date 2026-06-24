import re

with open('resources/views/backend/layouts/sidebar.blade.php', 'r') as f:
    content = f.read()

# Find where to add Leave Application
# Under Staff Info, there are child menus like "Staff Create" and "Staff List"
# We can find "Staff List" and append Leave Application below it.

staff_list_pattern = r'(<li class="nav-item">\s*<a href="\{\{ route\(\'staff\.index\'\) \}\}" class="nav-link \@if \(\$subMenu == \'StaffList\'\) active \@endif">\s*<i class="far fa-circle nav-icon"></i>\s*<p>Staff List</p>\s*</a>\s*</li>)'

leave_app_html = r'''\1
                            <li class="nav-item">
                                <a href="{{ route('leave-application.index') }}" class="nav-link @if (isset($subMenu) && $subMenu == 'LeaveApplication') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Leave Application</p>
                                </a>
                            </li>'''

content = re.sub(staff_list_pattern, leave_app_html, content)

with open('resources/views/backend/layouts/sidebar.blade.php', 'w') as f:
    f.write(content)

