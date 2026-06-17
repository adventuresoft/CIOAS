<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('images/icon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CIOAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                {{-- Dashboard --}}
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link  @if ($subMenu == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (has_module_access('application_form') || has_module_access('application-form'))
                    <li class="nav-item @if ($mainMenu == 'Application Form') menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Application Form') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Letter Submit
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('application_form', 'create') || has_sub_module_access('application-form', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('application-form.create') }}"
                                        class="nav-link @if ($subMenu == 'ApplicationFormCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif
                            @if (has_sub_module_access('application_form', 'read') || has_sub_module_access('application-form', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('application-form.index') }}"
                                        class="nav-link @if ($subMenu == 'ApplicationFormList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Letter Submit List</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- sidebar --}}
                @if (basic_settings_permissions())
                    @include('backend.layouts.sidebar-section.basic-setting')
                @endif

                @if (access_management_permission())
                    <li
                        class="nav-item has-treeview {{ isset($page) && ($page == 'role' || $page == 'permission' || $page == 'rolepermission' || $page == 'userper' || $page == 'roleuser' || $page == 'user') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ isset($page) && ($page == 'role' || $page == 'permission' || $page == 'rolepermission' || $page == 'userper' || $page == 'roleuser' || $page == 'user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Access Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (is_superadmin() || auth()->user()->can('users.read'))
                                <li class="nav-item ">
                                    <a href="{{ route('user.index') }}"
                                        class="nav-link {{ isset($page) && $page == 'user' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users Directory</p>
                                    </a>
                                </li>
                            @endif
                            @if (is_superadmin() || auth()->user()->can('roles.read'))
                                <li class="nav-item ">
                                    <a href="{{ route('role.index') }}"
                                        class="nav-link {{ isset($page) && $page == 'role' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Role Definitions</p>
                                    </a>
                                </li>
                            @endif
                            @if (is_superadmin() || auth()->user()->can('permissions.read'))
                                <li class="nav-item ">
                                    <a href="{{ route('permission.index') }}"
                                        class="nav-link {{ isset($page) && $page == 'permission' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permission Pool</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (institute_permissions())
                    {{-- Institute Settings --}}
                    <li
                        class="nav-item
                                                                                                                            @if (
                                                                                                                                $subMenu == 'InstituteCreate' ||
                                                                                                                                $subMenu == 'InstituteType' ||
                                                                                                                                $subMenu == 'InstituteCategory' ||
                                                                                                                                $subMenu == 'InstituteList'
                                                                                                                            ) menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Institute') active @endif ">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Institute Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @if (has_module_access('institute-type') || has_module_access('institute_type'))
                                <li class="nav-item">
                                    <a href="{{ route('institute-type.index') }}"
                                        class="nav-link @if ($subMenu == 'InstituteType') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Type</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('institute-category') || has_module_access('institute_category'))
                                <li class="nav-item">
                                    <a href="{{ route('institute-category.index') }}"
                                        class="nav-link @if ($subMenu == 'InstituteCategory') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('institutions', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('institute.create') }}"
                                        class="nav-link @if ($subMenu == 'InstituteCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif
                            @if (has_sub_module_access('institutions', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('institute.index') }}"
                                        class="nav-link @if ($subMenu == 'InstituteList') active @endif ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (has_module_access('institutional-admin') || has_module_access('institutional_admin'))
                    <li
                        class="nav-item @if ($subMenu == 'AdminCreate' || $subMenu == 'AdminList' || $subMenu == 'AdminShow') menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Admin') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Institutional Admins
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('institutional_admin', 'create') || has_sub_module_access('institutional-admin', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('institutional-admin.create') }}"
                                        class="nav-link  @if ($subMenu == 'AdminCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('institutional_admin', 'read') || has_sub_module_access('institutional-admin', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('institutional-admin.index') }}"
                                        class="nav-link  @if ($subMenu == 'AdminList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif



                {{-- Staff Info --}}
                @if (has_module_access('staff') || has_module_access('staffs'))
                    <li class="nav-item @if (
                        $mainMenu == 'Staff' &&
                        ($subMenu == 'StaffCreate' ||
                            $subMenu == 'Create' ||
                            $subMenu == 'StaffList' ||
                            $subMenu == 'StaffApproveList' ||
                            $subMenu == 'approvedList' ||
                            $subMenu == 'Index')
                    ) menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Staff') active @endif">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Staff Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('staff', 'create') || has_sub_module_access('staffs', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('staff.create') }}"
                                        class="nav-link @if ($mainMenu == 'Staff' && ($subMenu == 'StaffCreate' || $subMenu == 'Create')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('staff', 'read') || has_sub_module_access('staffs', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('staff.index') }}"
                                        class="nav-link @if ($mainMenu == 'Staff' && ($subMenu == 'StaffList' || $subMenu == 'Index')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Staff List</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('staffapprovedlist') }}"
                                        class="nav-link @if ($mainMenu == 'Staff' && ($subMenu == 'StaffApproveList' || $subMenu == 'approvedList')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Approve Staff List</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <li class="nav-item  @if ($mainMenu == 'Inquiry') menu-open @endif ">
                    <a href="{{ route('inquiry.formlist') }}"
                        class="nav-link @if ($mainMenu == 'Inquiry') active @endif">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Inquiries List
                        </p>
                    </a>
                </li>

                {{-- Appointment Management --}}
                <li class="nav-item @if (isset($mainMenu) && $mainMenu == 'Appointment') menu-open @endif">
                    <a href="#" class="nav-link @if (isset($mainMenu) && $mainMenu == 'Appointment') active @endif">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Appointments
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('appointment.slots.index') }}"
                                class="nav-link @if (isset($subMenu) && $subMenu == 'Slots') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Slots</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('appointment.booking.index') }}"
                                class="nav-link @if (isset($subMenu) && $subMenu == 'Bookings') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bookings List</p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- Organization Info --}}
                {{-- Organization Info --}}
                @if (
                        has_module_access('organization') ||
                        has_module_access('organizations') ||
                        has_module_access('trade-license') ||
                        has_module_access('trade_license')
                    )
                    <li class="nav-item
                                                                                                                      @if (
                                                                                                                        $subMenu == 'OrganizationCreate' ||
                                                                                                                        $subMenu == 'OrganizationList' ||
                                                                                                                        $subMenu == 'OrganizationShow' ||
                                                                                                                        $subMenu == 'RegistrationFees' ||
                                                                                                                        $subMenu == 'RenewFees' ||
                                                                                                                        $subMenu == 'TradeLicense' ||
                                                                                                                        $subMenu == 'GetTradeLicense'
                                                                                                                    ) menu-open @endif
                                                                                                                      ">
                        <a href="#" class="nav-link @if ($mainMenu == 'Organization') active @endif ">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Organization
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('organization', 'create') || has_sub_module_access('organizations', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('organization.create') }}"
                                        class="nav-link @if ($subMenu == 'OrganizationCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('organization', 'read') || has_sub_module_access('organizations', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('organization.index') }}"
                                        class="nav-link @if ($subMenu == 'OrganizationList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Applicant Org. List</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('registration-fees') ||
                                    has_module_access('registration_fees') ||
                                    has_module_access('renew-fees') ||
                                    has_module_access('renew_fees')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('organizationA.registration-fees.index') }}"
                                        class="nav-link @if ($subMenu == 'RegistrationFees') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fees</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('trade-license') || has_module_access('trade_license'))
                                <li class="nav-item">
                                    <a href="{{ route('organizationA.trade-license.index') }}"
                                        class="nav-link @if ($subMenu == 'TradeLicense') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generate Invoice </p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('trade-license') || has_module_access('trade_license'))
                                <li class="nav-item">
                                    <a href="{{ route('organizationA.trade-license.getTradeLicense') }}"
                                        class="nav-link @if ($subMenu == 'GetTradeLicense') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Trade License</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    {{-- Vehicle Info --}}
                    @if (has_module_access('vehicle') || has_module_access('vehicles'))
                        <li
                            class="nav-item @if (in_array($subMenu, ['VehicleCreate', 'VehicleList', 'VehicleShow'])) menu-open @endif">
                            <a href="#" class="nav-link @if ($mainMenu == 'Vehicle') active @endif">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    Vehicle
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (has_sub_module_access('vehicle', 'create') || has_sub_module_access('vehicles', 'create'))
                                    <li class="nav-item">
                                        <a href="{{ route('vehicle.create') }}"
                                            class="nav-link @if ($subMenu == 'VehicleCreate') active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Vehicle</p>
                                        </a>
                                    </li>
                                @endif
                                @if (has_sub_module_access('vehicle', 'read') || has_sub_module_access('vehicles', 'read'))
                                    <li class="nav-item">
                                        <a href="{{ route('vehicle.index') }}"
                                            class="nav-link @if ($subMenu == 'VehicleList') active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Vehicle List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('vehicle.repairing.index') }}"
                                            class="nav-link @if ($subMenu == 'VehicleRepairingList' || $subMenu == 'VehicleRepairingCreate') active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Repairing</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('vehicle.fuel.index') }}"
                                            class="nav-link @if ($subMenu == 'VehicleFuelList' || $subMenu == 'VehicleFuelCreate') active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fuel</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif

                {{-- License --}}
                @if (has_module_access('license') || has_module_access('licenses'))
                    <li class="nav-item
                                                                                                                      @if ($subMenu == 'LicenseCreate' || $subMenu == 'LicenseList' || $subMenu == 'LicenseShow' || $subMenu == 'LicenseEdit') menu-open @endif
                                                                                                                      ">
                        <a href="#" class="nav-link @if ($mainMenu == 'License') active @endif ">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                License
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('license', 'create') || has_sub_module_access('licenses', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('license.create') }}"
                                        class="nav-link @if ($subMenu == 'LicenseCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('license', 'read') || has_sub_module_access('licenses', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('license.index') }}"
                                        class="nav-link @if ($subMenu == 'LicenseList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>License List</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Hotel & Restaurant --}}
                {{-- Hotel & Restaurant --}}
                @if (has_module_access('hotel-restaurant') || has_module_access('hotel_restaurant'))
                    <li
                        class="nav-item
                                                                                                                         @if ($subMenu == 'HotelRestaurant' || $subMenu == 'HotelRestaurantist') menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'HotelRestaurant') active @endif ">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Hotel & Restaurant
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('hotel-restaurant', 'create') || has_sub_module_access('hotel_restaurant', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('hotel-restaurant.create') }}"
                                        class="nav-link @if ($subMenu == 'HotelRestaurantCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('hotel-restaurant', 'read') || has_sub_module_access('hotel_restaurant', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('hotel-restaurant.index') }}"
                                        class="nav-link @if ($subMenu == 'HotelRestaurantList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Hotel & Restaurant List</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Gun License --}}
                <li class="nav-item @if (isset($mainMenu) && $mainMenu == 'GunLicense') menu-open @endif">
                    <a href="#" class="nav-link @if (isset($mainMenu) && $mainMenu == 'GunLicense') active @endif ">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Gun License
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('gun-license.create') }}"
                                class="nav-link @if (isset($subMenu) && $subMenu == 'GunLicenseCreate') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>আবেদন করুন</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gun-license.index') }}"
                                class="nav-link @if (isset($subMenu) && $subMenu == 'GunLicenseList') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>আবেদন তালিকা</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Mis Case --}}
                {{-- @if (has_module_access('miscase') || has_module_access('miscases')) --}}
                <li
                    class="nav-item
                                                                         @if ($subMenu == 'MisCase' || $subMenu == 'MisCaseList') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'MisCase') active @endif ">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Mis Case
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (has_sub_module_access('miscase', 'create') || has_sub_module_access('miscases',
                        'create')) --}}
                        <li class="nav-item">
                            <a href="{{ route('miscase.create') }}"
                                class="nav-link @if ($subMenu == 'MisCaseCreate') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if (has_sub_module_access('miscase', 'read') || has_sub_module_access('miscases', 'read'))
                        --}}
                        <li class="nav-item">
                            <a href="{{ route('miscase.index') }}"
                                class="nav-link @if ($subMenu == 'MisCaseList') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mis Case List</p>
                            </a>
                        </li>
                        {{-- @endif --}}
                    </ul>
                </li>
                {{-- @endif --}}


                <li
                    class="nav-item
                                                                         @if ($subMenu == 'CaseOrder' || $subMenu == 'CaseOrderList' || $subMenu == 'CaseOrderCreate' || $subMenu == 'CaseDateEdit' || $subMenu == 'HearingNotice') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'CaseOrder') active @endif ">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Case Order
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (has_sub_module_access('miscase', 'create') || has_sub_module_access('miscases',
                        'create')) --}}

                        <li class="nav-item">
                            <a href="{{ route('caseorder.index') }}"
                                class="nav-link @if ($subMenu == 'CaseOrderList') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Case Order</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('caseorder.create') }}"
                                class="nav-link @if ($subMenu == 'CaseOrderCreate') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Case Order</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if (has_sub_module_access('miscase', 'read') || has_sub_module_access('miscases', 'read'))
                        --}}
                        <li class="nav-item">
                            <a href="{{ route('caseorder.dateEditList') }}"
                                class="nav-link @if ($subMenu == 'CaseDateEdit') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Case Date Edit</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        <li class="nav-item">
                            <a href="{{ route('caseorder.hearingNotice') }}"
                                class="nav-link @if ($subMenu == 'HearingNotice') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hearing Notice</p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- Inventory --}}
                <li class="nav-item @if ($mainMenu == 'Inventory') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'Inventory') active @endif">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (
                            $subMenu == 'InventoryRequisitionCreate' ||
                            $subMenu == 'InventoryRequisitionList' ||
                            $subMenu == 'InventoryStatus'
                        ) menu-open @endif">
                            <a href="#" class="nav-link @if (
                                $subMenu == 'InventoryRequisitionCreate' ||
                                $subMenu == 'InventoryRequisitionList' ||
                                $subMenu == 'InventoryStatus'
                            ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Requisition
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('inventory.requisition.create') }}"
                                        class="nav-link @if ($subMenu == 'InventoryRequisitionCreate') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Add New Requisition</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.requisition.index') }}"
                                        class="nav-link @if ($subMenu == 'InventoryRequisitionList') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Requisition List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.requisition.approve_list') }}"
                                        class="nav-link @if ($subMenu == 'InventoryApproveList') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Approve List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item @if (
                            $subMenu == 'InventoryWorkOrderCreate' ||
                            $subMenu == 'InventoryWorkOrderList' ||
                            $subMenu == 'InventoryWorkOrderApproveList'
                        ) menu-open @endif">
                            <a href="#" class="nav-link @if (
                                $subMenu == 'InventoryWorkOrderCreate' ||
                                $subMenu == 'InventoryWorkOrderList' ||
                                $subMenu == 'InventoryWorkOrderApproveList'
                            ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Work Order
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{ route('inventory.work-order.create') }}"
                                        class="nav-link @if ($subMenu == 'InventoryWorkOrderCreate') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Add New Work Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.work-order.index') }}"
                                        class="nav-link @if ($subMenu == 'InventoryWorkOrderList') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Work Order List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.work-order.approve_list') }}"
                                        class="nav-link @if ($subMenu == 'InventoryWorkOrderApproveList') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Approve List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li
                            class="nav-item @if (in_array($subMenu, ['InventoryVendorList', 'InventoryVendorCreate', 'InventoryVendorAssigned', 'InventoryQuotationCreate', 'InventoryQuotationList'])) menu-open @endif">
                            <a href="#"
                                class="nav-link @if (in_array($subMenu, ['InventoryVendorList', 'InventoryVendorCreate', 'InventoryVendorAssigned', 'InventoryQuotationCreate', 'InventoryQuotationList'])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Vendor
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('inventory.vendors.create') }}"
                                        class="nav-link @if ($subMenu == 'InventoryVendorCreate') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create New Vendor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.vendors.index') }}"
                                        class="nav-link @if ($subMenu == 'InventoryVendorList') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Vendor List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.vendors.assigned') }}"
                                        class="nav-link @if ($subMenu == 'InventoryVendorAssigned') active @endif">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Assigned Vendor</p>
                                    </a>
                                </li>
                                @php
                                    $isInventoryQuotation = in_array($subMenu, ['InventoryQuotationCreate', 'InventoryQuotationList']);
                                @endphp
                                <li class="nav-item @if ($isInventoryQuotation) menu-open @endif">
                                    <a href="#" class="nav-link @if ($isInventoryQuotation) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Quotation
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ml-3">
                                        <li class="nav-item">
                                            <a href="{{ route('inventory.quotation.create') }}"
                                                class="nav-link @if ($subMenu == 'InventoryQuotationCreate') active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>New Quotation</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('inventory.quotation.index') }}"
                                                class="nav-link @if ($subMenu == 'InventoryQuotationList') active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Quotation List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('inventory.purchase_orders.index') }}"
                                class="nav-link @if ($subMenu == 'InventoryPurchaseOrderList') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Receive Point</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('inventory.stock') }}"
                                class="nav-link @if ($subMenu == 'InventoryStock') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inventory.distribution') }}"
                                class="nav-link @if ($subMenu == 'InventoryDistribution') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Distribution</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>