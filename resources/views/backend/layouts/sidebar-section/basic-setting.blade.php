{{-- Basic Settings --}}
<li class="nav-item
        @if (
            $subMenu == 'Pourashava' ||
            $subMenu == 'Financialyear' ||
            $subMenu == 'MarketType' ||
            $subMenu == 'MarketCategory' ||
            $subMenu == 'MarketOwnershipType' ||
            $subMenu == 'VehicleCategory' ||
            $subMenu == 'VehicleSubcategory' ||
            $subMenu == 'VehicleType' ||
            $subMenu == 'Village' ||
            $subMenu == 'VillageArea' ||
            $subMenu == 'Union' ||
            $subMenu == 'District' ||
            $subMenu == 'Thana' ||
            $subMenu == 'HotelCategory' ||
            $subMenu == 'LicenseCategory' ||
            $subMenu == 'Mouza' ||
            $subMenu == 'Upazila' ||
            $subMenu == 'Year'
        ) menu-open @endif
        ">
    <a href="#" class="nav-link {{ $mainMenu == 'Basic' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
            Basic Settings
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        @if (has_module_access('pourashava'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.pourashava.index') }}"
                    class="nav-link {{ $subMenu == 'Pourashava' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pourashava</p>
                </a>
            </li>
        @endif

        @if (has_module_access('department'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.department.index') }}"
                    class="nav-link {{ $subMenu == 'Department' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departments</p>
                </a>
            </li>
        @endif

        @if (has_module_access('hotel-category'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.hotel-category.index') }}"
                    class="nav-link {{ $subMenu == 'HotelCategory' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hotel Category</p>
                </a>
            </li>
        @endif

        @if (has_module_access('license-category') || has_module_access('license_category') || has_module_access('basic-settings') || has_module_access('basic_settings'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.license-category.index') }}"
                    class="nav-link {{ $subMenu == 'LicenseCategory' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>License Category</p>
                </a>
            </li>
        @endif

        @if (has_module_access('vehicle-category'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.vehicle-category.index') }}"
                    class="nav-link {{ $subMenu == 'VehicleCategory' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Vehicle Category</p>
                </a>
            </li>
        @endif

        @if (has_module_access('vehicle-type'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.vehicle-type.index') }}"
                    class="nav-link {{ $subMenu == 'VehicleType' ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Vehicle Type</p>
                </a>
            </li>
        @endif

        @if (has_module_access('village') || has_module_access('villages'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.village.index') }}"
                    class="nav-link {{ $subMenu == 'Village' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Village</p>
                </a>
            </li>
        @endif

        @if (has_module_access('union') || has_module_access('unions'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.union.index') }}"
                    class="nav-link {{ $subMenu == 'Union' ? 'active' : '' }} ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Union</p>
                </a>
            </li>
        @endif

        @if (has_module_access('district'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.district.index') }}"
                    class="nav-link {{ $subMenu == 'District' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>District</p>
                </a>
            </li>
        @endif

        @if (has_module_access('thana'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.thana.index') }}"
                    class="nav-link {{ $subMenu == 'Thana' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thana</p>
                </a>
            </li>
        @endif

        @if (has_module_access('mouza'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.mouza.index') }}"
                    class="nav-link {{ $subMenu == 'Mouza' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mouza</p>
                </a>
            </li>
        @endif

        @if (has_module_access('upazila'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.upazila.index') }}"
                    class="nav-link {{ $subMenu == 'Upazila' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Upazila/Circle</p>
                </a>
            </li>
        @endif

    </ul>
</li>