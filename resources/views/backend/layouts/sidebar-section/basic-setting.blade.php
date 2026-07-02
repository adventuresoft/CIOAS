{{-- Basic Settings
     basic_setting.read  → সব sub-items দেখতে পারবে
     basic_setting.create / update / delete → respective access
     Superadmin / Developer → সব কিছু
--}}
<li class="nav-item
        @if (
            $subMenu == 'Pourashava' ||
            $subMenu == 'Financialyear' ||
            $subMenu == 'MarketType' ||
            $subMenu == 'MarketCategory' ||
            $subMenu == 'MarketOwnershipType' ||
            $subMenu == 'Village' ||
            $subMenu == 'VillageArea' ||
            $subMenu == 'Union' ||
            $subMenu == 'District' ||
            $subMenu == 'Thana' ||
            $subMenu == 'HotelCategory' ||
            $subMenu == 'LicenseCategory' ||
            $subMenu == 'Mouza' ||
            $subMenu == 'Upazila' ||
            $subMenu == 'Department' ||
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

        {{-- Pourashava --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.pourashava.index') }}"
                    class="nav-link {{ $subMenu == 'Pourashava' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pourashava</p>
                </a>
            </li>
        @endif

        {{-- Departments --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.department.index') }}"
                    class="nav-link {{ $subMenu == 'Department' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departments</p>
                </a>
            </li>
        @endif

        {{-- Hotel Category --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.hotel-category.index') }}"
                    class="nav-link {{ $subMenu == 'HotelCategory' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hotel Category</p>
                </a>
            </li>
        @endif

        {{-- License Category --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.license-category.index') }}"
                    class="nav-link {{ $subMenu == 'LicenseCategory' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>License Category</p>
                </a>
            </li>
        @endif

        {{-- Village --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.village.index') }}"
                    class="nav-link {{ $subMenu == 'Village' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Village</p>
                </a>
            </li>
        @endif

        {{-- Union --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.union.index') }}"
                    class="nav-link {{ $subMenu == 'Union' ? 'active' : '' }} ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Union</p>
                </a>
            </li>
        @endif

        {{-- District --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.district.index') }}"
                    class="nav-link {{ $subMenu == 'District' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>District</p>
                </a>
            </li>
        @endif

        {{-- Thana --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.thana.index') }}"
                    class="nav-link {{ $subMenu == 'Thana' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thana</p>
                </a>
            </li>
        @endif

        {{-- Mouza --}}
        @if (has_basic_setting_access('read'))
            <li class="nav-item">
                <a href="{{ route('basic-settings.mouza.index') }}"
                    class="nav-link {{ $subMenu == 'Mouza' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mouza</p>
                </a>
            </li>
        @endif

        {{-- Upazila --}}
        @if (has_basic_setting_access('read'))
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