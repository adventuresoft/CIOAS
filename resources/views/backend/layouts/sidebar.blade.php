<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('backend') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
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
                    <li class="nav-item
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

                {{-- People Info --}}
                @if (has_module_access('people'))
                    <li class="nav-item @if (
                        $mainMenu == 'People' &&
                        ($subMenu == 'Create' || $subMenu == 'View' || $subMenu == 'Show' || $subMenu == 'approvedList')
                    ) menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'People') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                People Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('people', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('people.create') }}"
                                        class="nav-link @if ($mainMenu == 'People' && $subMenu == 'Create') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('people', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('people.index') }}"
                                        class="nav-link @if ($mainMenu == 'People' && $subMenu == 'View') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Applicant List</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('peopleapprovedlist') }}"
                                        class="nav-link @if ($mainMenu == 'People' && $subMenu == 'approvedList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reg. People List</p>
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
                {{-- Certificate --}}
                @if (has_module_access('certificate') || has_module_access('certificates'))
                    <li class="nav-item  @if ($mainMenu == 'Certificate') menu-open @endif ">
                        <a href="#" class="nav-link @if ($mainMenu == 'Certificate') active @endif">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p>
                                Certificate
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                    has_module_access('citizen-certificate') ||
                                    has_module_access('citizen_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('citizen.index') }}"
                                        class="nav-link @if ($subMenu == 'Citizen') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Citizen</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('character-certificate') ||
                                    has_module_access('character_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('character.index') }}"
                                        class="nav-link  @if ($subMenu == 'Character') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Character</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('death-certificate') ||
                                    has_module_access('death_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('death.index') }}"
                                        class="nav-link  @if ($subMenu == 'Death') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Death</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('succession-certificate') ||
                                    has_module_access('succession_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('succession.index') }}"
                                        class="nav-link  @if ($subMenu == 'Succession') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Succession</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('unmarried-certificate') ||
                                    has_module_access('unmarried_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('unmarried.index') }}"
                                        class="nav-link  @if ($subMenu == 'Unmarried') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Unmarried</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('married-certificate') ||
                                    has_module_access('married_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('married.index') }}"
                                        class="nav-link  @if ($subMenu == 'Married') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Married</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('remarried-certificate') ||
                                    has_module_access('remarried_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('remarried.index') }}"
                                        class="nav-link  @if ($subMenu == 'Remarried') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Remarried</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('landless-certificate') ||
                                    has_module_access('landless_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('landless.index') }}"
                                        class="nav-link  @if ($subMenu == 'Landless') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Landless</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('name-certificate') || has_module_access('name_certificate') || has_module_access('certificate'))
                                <li class="nav-item">
                                    <a href="{{ route('name.index') }}"
                                        class="nav-link  @if ($subMenu == 'Name') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Name</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('yearly-income-certificate') ||
                                    has_module_access('yearly_income_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('income.index') }}"
                                        class="nav-link  @if ($subMenu == 'Income') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Yearly Income</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('disability-certificate') ||
                                    has_module_access('disability_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('disability-certificate.index') }}"
                                        class="nav-link  @if ($subMenu == 'Disability') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Disability</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('voter-area-certificate') ||
                                    has_module_access('voter_area_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('voter-area.index') }}"
                                        class="nav-link  @if ($subMenu == 'VoterArea') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Voter Area Change</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('voter-list-certificate') ||
                                    has_module_access('voter_list_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('voter-list.index') }}"
                                        class="nav-link  @if ($subMenu == 'VoterList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Not Voter List</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('nid-correction-certificate') ||
                                    has_module_access('nid_correction_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('nid-correction.index') }}"
                                        class="nav-link  @if ($subMenu == 'NidCorrection') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>NID Correction</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('childless-certificate') ||
                                    has_module_access('childless_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('childless.index') }}"
                                        class="nav-link  @if ($subMenu == 'Childless') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Childless</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('orphan-certificate') ||
                                    has_module_access('orphan_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('orphan.index') }}"
                                        class="nav-link  @if ($subMenu == 'Orphan') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Orphan</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('financial-instability-certificate') ||
                                    has_module_access('financial_instability_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('financial-instability.index') }}"
                                        class="nav-link  @if ($subMenu == 'FinancialInstability') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Financial Instability</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('age-certificate') || has_module_access('age_certificate') || has_module_access('certificate'))
                                <li class="nav-item">
                                    <a href="{{ route('age.index') }}" class="nav-link  @if ($subMenu == 'Age') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Age</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('permanent-citizen-certificate') ||
                                    has_module_access('permanent_citizen_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('permanent-citizen.index') }}"
                                        class="nav-link  @if ($subMenu == 'PermanentCitizen') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permanent Citizen</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('residential-certificate') ||
                                    has_module_access('residential_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('residential.index') }}"
                                        class="nav-link  @if ($subMenu == 'Residential') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Residential</p>
                                    </a>
                                </li>
                            @endif

                            @if (
                                    has_module_access('guardian-certificate') ||
                                    has_module_access('guardian_certificate') ||
                                    has_module_access('certificate')
                                )
                                <li class="nav-item">
                                    <a href="{{ route('guardian-income.index') }}"
                                        class="nav-link  @if ($subMenu == 'GuardianIncome') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Guardian Income</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

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



                {{-- Tax --}}
                @if (has_module_access('tax') || has_module_access('taxes'))
                    <li class="nav-item
                                                                    @if ($subMenu == 'TaxGenerate' || $subMenu == 'TaxReceived' || $subMenu == 'TaxRateList' || $subMenu == 'TaxList') menu-open @endif
                                                                    ">
                        <a href="#" class="nav-link @if ($mainMenu == 'Tax') active @endif">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Tax
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('tax', 'create') || has_sub_module_access('taxes', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('tax.create') }}"
                                        class="nav-link  @if ($subMenu == 'TaxGenerate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tax Generate</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('tax', 'read') || has_sub_module_access('taxes', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('tax.index') }}"
                                        class="nav-link @if ($subMenu == 'TaxList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('tax') || has_module_access('taxes'))
                                <li class="nav-item">
                                    <a href="{{ route('taxes.tax-rate.index') }}"
                                        class="nav-link {{ $subMenu == 'TaxRateList' ? 'active' : '' }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tax Rate</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('tax') || has_module_access('taxes'))
                                <li class="nav-item">
                                    {{-- <a href="{{ route('taxes.tax.receipt') }}" --}} <a href="#"
                                        class="nav-link @if ($subMenu == 'TaxReceipt') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tax Recipt</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('tax') || has_module_access('taxes'))
                                <li class="nav-item">
                                    <a href="{{ route('taxes.tax.received') }}"
                                        class="nav-link @if ($subMenu == 'TaxReceived') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tax Received</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Relief --}}
                @if (has_module_access('relief'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>
                                Relief
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('relief', 'create'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Relief</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('relief', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('relief'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Type</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('relief'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('relief'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sub Category</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('relief'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Distribution</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('relief'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Recived</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif



                {{-- House Info --}}
                @if (has_module_access('house') || has_module_access('houses'))
                    <li class="nav-item @if ($subMenu == 'HouseCreate' || $subMenu == 'HouseList') menu-open @endif">
                        <a href="#" class="nav-link  @if ($mainMenu == 'House') active @endif ">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                House Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('house', 'create') || has_sub_module_access('houses', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('house.create') }}"
                                        class="nav-link @if ($subMenu == 'HouseCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('house', 'read') || has_sub_module_access('houses', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('house.index') }}"
                                        class="nav-link @if ($subMenu == 'HouseList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Land Info --}}
                @if (has_module_access('land') || has_module_access('lands'))
                    <li class="nav-item
                                                                    @if ($subMenu == 'LandCreate' || $subMenu == 'LandList') menu-open @endif
                                                                    ">
                        <a href="#" class="nav-link @if ($mainMenu == 'Land') active @endif">
                            <i class="nav-icon fas fa-bacon"></i>
                            <p>
                                Land Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('land', 'create') || has_sub_module_access('lands', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('land.create') }}"
                                        class="nav-link @if ($subMenu == 'LandCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif
                            @if (has_sub_module_access('land', 'read') || has_sub_module_access('lands', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('land.index') }}"
                                        class="nav-link @if ($subMenu == 'LandList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif



                {{-- Vehicle Info --}}
                @if (has_module_access('vehicle') || has_module_access('vehicles'))
                    <li class="nav-item
                                                                      @if (
                                                                        $subMenu == 'VehicleCreate' ||
                                                                        $subMenu == 'VehicleList' ||
                                                                        $subMenu == 'VehicleApprovalList' ||
                                                                        $subMenu == 'VehicleGenerateInvoice' ||
                                                                        $subMenu == 'VehicleLicense' ||
                                                                        $subMenu == 'VehicleOwnershipChangeApplication' ||
                                                                        $subMenu == 'VehicleOwnershipChangeApproval' ||
                                                                        $subMenu == 'VehicleAddFeesNewSetup' ||
                                                                        $subMenu == 'VehicleAddFeesList'
                                                                    ) menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Vehicle') active @endif">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Vehicle Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('vehicle', 'create') || has_sub_module_access('vehicles', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('vehicle.create') }}"
                                        class="nav-link @if ($subMenu == 'VehicleCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('vehicle', 'read') || has_sub_module_access('vehicles', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('vehicle.index') }}"
                                        class="nav-link @if ($subMenu == 'VehicleList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Application List</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('vehicle', 'read') || has_sub_module_access('vehicles', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link @if ($subMenu == 'VehicleApprovalList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Approval List</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('vehicle') || has_module_access('vehicles'))
                                <li
                                    class="nav-item has-treeview @if ($subMenu == 'VehicleAddFeesNewSetup' || $subMenu == 'VehicleAddFeesList') menu-open @endif">
                                    <a href="#"
                                        class="nav-link @if ($subMenu == 'VehicleAddFeesNewSetup' || $subMenu == 'VehicleAddFeesList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Add Fees
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('vehicle.fees.vehicle') }}"
                                                class="nav-link @if ($subMenu == 'VehicleAddFeesNewSetup') active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>New Setup Fees</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('vehicle.fees.list') }}"
                                                class="nav-link @if ($subMenu == 'VehicleAddFeesList') active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Vehicle Fees Setup List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if (has_sub_module_access('vehicle', 'read') || has_sub_module_access('vehicles', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link @if ($subMenu == 'VehicleGenerateInvoice') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generate Invoice</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('vehicle', 'read') || has_sub_module_access('vehicles', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link @if ($subMenu == 'VehicleLicense') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>License</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_module_access('vehicle') || has_module_access('vehicles'))
                                <li
                                    class="nav-item has-treeview @if ($subMenu == 'VehicleOwnershipChangeApplication' || $subMenu == 'VehicleOwnershipChangeApproval') menu-open @endif">
                                    <a href="#"
                                        class="nav-link @if ($subMenu == 'VehicleOwnershipChangeApplication' || $subMenu == 'VehicleOwnershipChangeApproval') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Ownership Change
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#"
                                                class="nav-link @if ($subMenu == 'VehicleOwnershipChangeApplication') active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Application for Change Ownership</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#"
                                                class="nav-link @if ($subMenu == 'VehicleOwnershipChangeApproval') active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Approval</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Road Info --}}
                @if (has_module_access('road') || has_module_access('roads'))
                    <li class="nav-item @if ($subMenu == 'RoadCreate' || $subMenu == 'RoadList') menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-road"></i>
                            <p>
                                Road Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('road', 'create') || has_sub_module_access('roads', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('road.create') }}"
                                        class="nav-link @if ($subMenu == 'RoadCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('road', 'read') || has_sub_module_access('roads', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('road.index') }}"
                                        class="nav-link @if ($subMenu == 'RoadList') active @endif ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Bridge Info --}}
                @if (has_module_access('bridge') || has_module_access('bridges'))
                    <li class="nav-item
                                                                    @if ($subMenu == 'BridgeCreate' || $subMenu == 'BridgeList') menu-open @endif
                                                                    ">
                        <a href="#" class="nav-link @if ($mainMenu == 'Bridge') active @endif">
                            <i class="nav-icon fas fa-archway"></i>
                            <p>
                                Bridge Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('bridge', 'create') || has_sub_module_access('bridges', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('bridge.create') }}"
                                        class="nav-link @if ($subMenu == 'BridgeCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('bridge', 'read') || has_sub_module_access('bridges', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('bridge.index') }}"
                                        class="nav-link @if ($subMenu == 'BridgeList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Market Info --}}
                @if (has_module_access('market') || has_module_access('markets'))
                    <li class="nav-item  @if ($subMenu == 'MarketCreate' || $subMenu == 'MarketList') menu-open @endif">
                        <a href="#" class="nav-link  @if ($mainMenu == 'Market') active @endif">
                            <i class="nav-icon fas fa-store"></i>
                            <p>
                                Market Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('market', 'create') || has_sub_module_access('markets', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('market.create') }}"
                                        class="nav-link @if ($subMenu == 'MarketCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('market', 'read') || has_sub_module_access('markets', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('market.index') }}"
                                        class="nav-link @if ($subMenu == 'MarketList') active @endif ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Ferry Info --}}
                <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ship"></i>
              <p>
                Ferry Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (create_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
@endif

              @if (view_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
@endif

            </ul>
          </li> -->

                {{-- River & Cannel Info --}}
                <!--  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-water"></i>
              <p>
                River & Cannel Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (create_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
@endif

              @if (view_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
@endif

            </ul>
          </li> -->

                {{-- Animals Info --}}
                <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-horse"></i>
              <p>
                Animals Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (create_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
@endif

              @if (view_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
@endif


            </ul>
          </li> -->

                {{-- Archeology Info --}}
                <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-landmark"></i>
              <p>
                Archeology Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (create_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
@endif

              @if (view_permission())
<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                  </a>
                </li>
@endif

            </ul>
          </li> -->

                {{-- Wedding --}}
                @if (
                        has_module_access('marriage') ||
                        has_module_access('marriages') ||
                        has_module_access('divorce') ||
                        has_module_access('divorces')
                    )
                    <li class="nav-item
                                                                      @if (
                                                                        $subMenu == 'MarriageCreate' ||
                                                                        $subMenu == 'MarriageList' ||
                                                                        $subMenu == 'DivorceCreate' ||
                                                                        $subMenu == 'DivorceList'
                                                                    ) menu-open @endif
                                                                      ">
                        <a href="#" class="nav-link @if ($mainMenu == 'Marriage' || $mainMenu == 'Divorce') active @endif ">
                            <i class="nav-icon fas fa-ring"></i>
                            <p>
                                Marriage & Divorce
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('marriage', 'create') || has_sub_module_access('marriages', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('marriage.create') }}"
                                        class="nav-link @if ($subMenu == 'MarriageCreate') active @endif ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Marriage Reg.</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('marriage', 'read') || has_sub_module_access('marriages', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('marriage.index') }}"
                                        class="nav-link @if ($subMenu == 'MarriageList') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Marriage List</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('divorce', 'create') || has_sub_module_access('divorces', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('divorce.create') }}"
                                        class="nav-link @if ($subMenu == 'DivorceCreate') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Divorce Reg</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('divorce', 'read') || has_sub_module_access('divorces', 'read'))
                                <li class="nav-item">
                                    <a href="{{ route('divorce.index') }}"
                                        class="nav-link {{ $subMenu == 'DivorceList' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Divorce List</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Chairman Info --}}
                @if (has_module_access('chairman'))
                    <li class="nav-item {{ $mainMenu == 'chairman' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $mainMenu == 'chairman' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Chairman Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('chairman', 'create'))
                                <li class="nav-item ">
                                    <a href="{{ route('chairman.create') }}"
                                        class="nav-link {{ $subMenu == 'chairmanCreate' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Chairman</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('chairman', 'read'))
                                <li class="nav-item ">
                                    <a href="{{ route('chairman.index') }}"
                                        class="nav-link {{ $subMenu == 'chairmanList' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('chairman', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Ex Chairman</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Member/Councilor Info --}}
                @if (has_module_access('councilor'))
                    <li class="nav-item {{ $mainMenu == 'councilor' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $mainMenu == 'councilor' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Member/Councilor Info
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('councilor', 'create'))
                                <li class="nav-item">
                                    <a href="{{ route('councilor.create') }}"
                                        class="nav-link {{ $subMenu == 'councilorCreate' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Member</p>
                                    </a>
                                </li>
                            @endif

                            @if (has_sub_module_access('councilor', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Ex Member</p>
                                    </a>
                                </li>
                            @endif
                            @if (has_module_access('councilor'))
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add New Resv. Member</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Resv. Member</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Ex Resv. Member</p>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Member/Commitee --}}
                @if (has_module_access('committee') || has_module_access('committees') || has_module_access('councilor'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Member/Commitee
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (has_sub_module_access('councilor', 'create'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Member</p>
                                    </a>
                                </li>
                            @endif
                            @if (has_sub_module_access('councilor', 'read'))
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Ex Member</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif






            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>