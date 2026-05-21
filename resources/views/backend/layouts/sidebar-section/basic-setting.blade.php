{{-- Basic Settings --}}
<li class="nav-item
        @if (
            $subMenu == 'CityCorporation' ||
                $subMenu == 'CityCorporationWard' ||
                $subMenu == 'FamilyCategory' ||
                $subMenu == 'FamilySubcategory' ||
                $subMenu == 'FamilyType' ||
                $subMenu == 'Financialyear' ||
                $subMenu == 'HouseType' ||
                $subMenu == 'HouseCategory' ||
                $subMenu == 'HouseOwnershipType' ||
                $subMenu == 'LandType' ||
                $subMenu == 'LandClass' ||
                $subMenu == 'LandOwnershipType' ||
                $subMenu == 'MarketType' ||
                $subMenu == 'MarketCategory' ||
                $subMenu == 'MarketOwnershipType' ||
                $subMenu == 'OrganizationCategory' ||
                $subMenu == 'OrganizationSubcategory' ||
                $subMenu == 'OrganizationWorkArea' ||
                $subMenu == 'OrganizationOwnershipType' ||
                $subMenu == 'OrganizationType' ||
                $subMenu == 'OrganizationSubtype' ||
                $subMenu == 'Profession' ||
                $subMenu == 'ProfessionCategory' ||
                $subMenu == 'ProfessionSubcategory' ||
                $subMenu == 'ProfessionType' ||
                $subMenu == 'RoadCategory' ||
                $subMenu == 'RoadType' ||
                $subMenu == 'RoadOwner' ||
                $subMenu == 'ResarvWard' ||
                $subMenu == 'VehicleCategory' ||
                $subMenu == 'VehicleSubcategory' ||
                $subMenu == 'VehicleType' ||
                $subMenu == 'UnionWard' ||
                $subMenu == 'ReserveWard' ||
                $subMenu == 'Village' ||
                $subMenu == 'VillageArea' ||
                $subMenu == 'Union' ||
                $subMenu == 'Year') menu-open @endif
        ">
    <a href="#" class="nav-link {{ $mainMenu == 'Basic' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
            Basic Settings
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        @if (has_module_access('city-corporation'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.city-corporation.index') }}"
                class="nav-link {{ $subMenu == 'CityCorporation' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>City Corporation</p>
            </a>
        </li>
        @endif

        @if (has_module_access('city-corporation-ward'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.city-corporation-ward.index') }}"
                class="nav-link {{ $subMenu == 'CityCorporationWard' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>City Corporation Ward</p>
            </a>
        </li>
        @endif

        @if (has_module_access('family-category'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.family-category.index') }}"
                class="nav-link {{ $subMenu == 'FamilyCategory' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Family Category</p>
            </a>
        </li>
        @endif

        @if (has_module_access('family-subcategory'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.family-subcategory.index') }}"
                class="nav-link {{ $subMenu == 'FamilySubcategory' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Family Subcategory</p>
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

        @if (has_module_access('hotel-subcategory'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.hotel-subcategory.index') }}"
                class="nav-link {{ $subMenu == 'HotelSubcategory' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Hotel Subcategory</p>
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

        @if (has_module_access('license-subcategory') || has_module_access('license_subcategory') || has_module_access('basic-settings') || has_module_access('basic_settings'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.license-subcategory.index') }}"
                class="nav-link {{ $subMenu == 'LicenseSubcategory' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>License Subcategory</p>
            </a>
        </li>
        @endif

        @if (has_module_access('family-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.family-type.index') }}"
                class="nav-link {{ $subMenu == 'FamilyType' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Family Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('financial-year') || has_module_access('financialyear'))
        <li class="nav-item">
            <a href="#" class="nav-link {{ $subMenu == 'FinancialYear' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Financial Year</p>
            </a>
        </li>
        @endif

        @if (has_module_access('house-ownership-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.house-ownership-type.index') }}"
                class="nav-link {{ $subMenu == 'HouseOwnershipType' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>House Ownership Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('house-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.house-type.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>House Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('house-category'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.house-category.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }} @if ($subMenu == 'HouseCategory') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>House Category</p>
            </a>
        </li>
        @endif

        @if (has_module_access('land-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.land-type.index') }}"
                class="nav-link  {{ $subMenu == 'HouseType' ? 'active' : '' }} @if ($subMenu == 'LandType') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Land Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('land-class'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.land-class.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }} @if ($subMenu == 'LandClass') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Land Class</p>
            </a>
        </li>
        @endif

        @if (has_module_access('land-ownership-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.land-ownership-type.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }} @if ($subMenu == 'LandOwnershipType') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Land Ownership Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('organization-category'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.organization-category.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }} @if ($subMenu == 'OrganizationCategory') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Organization Category</p>
            </a>
        </li>
        @endif

        @if (has_module_access('organization-subcategory'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.organization-subcategory.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }} @if ($subMenu == 'OrganizationSubcategory') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Org. Subcategory</p>
            </a>
        </li>
        @endif

        @if (has_module_access('organization-work-area'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.organization-work-area.index') }}"
                class="nav-link {{ $subMenu == 'HouseType' ? 'active' : '' }}  @if ($subMenu == 'OrganizationWorkArea') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Org. Work Area</p>
            </a>
        </li>
        @endif

        @if (has_module_access('organization-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.organization-type.index') }}"
                class="nav-link {{ $subMenu == 'CityCorporationWard' ? 'active' : '' }} @if ($subMenu == 'OrganizationType') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Organization Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('organization-ownership') || has_module_access('organization_ownership'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.organization-ownership-type.index') }}"
                class="nav-link {{ $subMenu == 'CityCorporationWard' ? 'active' : '' }} @if ($subMenu == 'OrganizationOwnershipType') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Org. Ownership Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('profession') || has_module_access('professions'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.profession.index') }}"
                class="nav-link {{ $subMenu == 'CityCorporationWard' ? 'active' : '' }} @if ($subMenu == 'Profession') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Profession</p>
            </a>
        </li>
        @endif

        @if (has_module_access('profession-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.profession-type.index') }}"
                class="nav-link {{ $subMenu == 'ProfessionType' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Profession Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('profession-category'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.profession-category.index') }}"
                class="nav-link {{ $subMenu == 'ProfessionCategory' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Profession Category</p>
            </a>
        </li>
        @endif

        @if (has_module_access('profession-subcategory'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.profession-subcategory.index') }}"
                class="nav-link {{ $subMenu == 'ProfessionSubcategory' ? 'active' : '' }} @">
                <i class="far fa-circle nav-icon"></i>
                <p>Profession Subcategory</p>
            </a>
        </li>
        @endif

        @if (has_module_access('road-category'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.road-category.index') }}"
                class="nav-link {{ $subMenu == 'RoadCategory' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Road Category</p>
            </a>
        </li>
        @endif

        @if (has_module_access('road-type'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.road-type.index') }}"
                class="nav-link {{ $subMenu == 'RoadType' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Road Type</p>
            </a>
        </li>
        @endif

        @if (has_module_access('road-owner'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.road-owner.index') }}"
                class="nav-link {{ $subMenu == 'RoadOwner' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Road Owner</p>
            </a>
        </li>
        @endif

        @if (has_module_access('reserve-ward'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.reserve-ward.index') }}"
                class="nav-link {{ $subMenu == 'ReserveWard' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Reserve Ward</p>
            </a>
        </li>
        @endif

        @if (has_module_access('union') || has_module_access('unions'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.union.index') }}"
                class="nav-link {{ $subMenu == 'CityCorporationWard' ? 'active' : '' }} {{ $subMenu == 'Union' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Union</p>
            </a>
        </li>
        @endif

        @if (has_module_access('union-ward'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.union-ward.index') }}"
                class="nav-link {{ $subMenu == 'UnionWard' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Union Ward</p>
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

        @if (has_module_access('village-area'))
        <li class="nav-item">
            <a href="{{ route('basic-settings.village-area.index') }}"
                class="nav-link {{ $subMenu == 'VillageArea' ? 'active' : '' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>Village Area</p>
            </a>
        </li>
        @endif

    </ul>
</li>
