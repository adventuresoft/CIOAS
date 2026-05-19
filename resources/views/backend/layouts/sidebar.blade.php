<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('backend') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">UPMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                {{-- Dashboard --}}
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link  @if ($subMenu == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item @if ($mainMenu == 'Application Form') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'Application Form') active @endif">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Application Form
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('application-form.create') }}"
                                class="nav-link @if ($subMenu == 'ApplicationFormCreate') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('application-form.index') }}"
                                class="nav-link @if ($subMenu == 'ApplicationFormList') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Application Form List</p>
                            </a>
                        </li>
                    </ul>
                </li>

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
            $subMenu == 'InstituteList') menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Institute') active @endif ">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Institute Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item">
                                <a href="{{ route('institute-type.index') }}"
                                    class="nav-link @if ($subMenu == 'InstituteType') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Type</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('institute-category.index') }}"
                                    class="nav-link @if ($subMenu == 'InstituteCategory') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>



                            <li class="nav-item">
                                <a href="{{ route('institute.create') }}"
                                    class="nav-link @if ($subMenu == 'InstituteCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('institute.index') }}"
                                    class="nav-link @if ($subMenu == 'InstituteList') active @endif ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (create_permission())
                    <li class="nav-item @if ($subMenu == 'AdminCreate' || $subMenu == 'AdminList' || $subMenu == 'AdminShow') menu-open @endif">
                        <a href="#" class="nav-link @if ($mainMenu == 'Admin') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Institutional Admins
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('institutional-admin.create') }}"
                                    class="nav-link  @if ($subMenu == 'AdminCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('institutional-admin.index') }}"
                                    class="nav-link  @if ($subMenu == 'AdminList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>

                        </ul>

                    </li>
                @endif

                {{-- People Info --}}
                <li class="nav-item @if ($subMenu == 'Create' || $subMenu == 'View' || $subMenu == 'Show' || $subMenu == 'approvedList') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'People') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            People Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- @if (create_permission()) --}}
                        <li class="nav-item">
                            <a href="{{ route('people.create') }}"
                                class="nav-link @if ($subMenu == 'Create') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('people.index') }}"
                                    class="nav-link @if ($subMenu == 'View') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Applicant List</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('peopleapprovedlist') }}"
                                    class="nav-link @if ($subMenu == 'approvedList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reg. People List</p>
                                </a>
                            </li>
                        @endif


                    </ul>
                </li>

                {{-- Certificate --}}
                <li class="nav-item  @if ($mainMenu == 'Certificate') menu-open @endif ">
                    <a href="#" class="nav-link @if ($mainMenu == 'Certificate') active @endif">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>
                            Certificate
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('citizen.index') }}"
                                class="nav-link @if ($subMenu == 'Citizen') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Citizen</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('character.index') }}"
                                class="nav-link  @if ($subMenu == 'Character') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Character</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('death.index') }}"
                                class="nav-link  @if ($subMenu == 'Death') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Death</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('succession.index') }}"
                                class="nav-link  @if ($subMenu == 'Succession') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Succession</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('unmarried.index') }}"
                                class="nav-link  @if ($subMenu == 'Unmarried') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Unmarried</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('married.index') }}"
                                class="nav-link  @if ($subMenu == 'Married') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Married</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('remarried.index') }}"
                                class="nav-link  @if ($subMenu == 'Remarried') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Remarried</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('landless.index') }}"
                                class="nav-link  @if ($subMenu == 'Landless') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Landless</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('name.index') }}"
                                class="nav-link  @if ($subMenu == 'Name') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Name</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('income.index') }}"
                                class="nav-link  @if ($subMenu == 'Income') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Yearly Income</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('disability-certificate.index') }}"
                                class="nav-link  @if ($subMenu == 'Disability') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disability</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
        <a href="{{route('birth.index')}}" class="nav-link  @if ($subMenu == 'Birth') active @endif">
          <i class="far fa-circle nav-icon"></i>
          <p>Objection</p>
        </a>
      </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('voter-area.index') }}"
                                class="nav-link  @if ($subMenu == 'VoterArea') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Voter Area Change</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('voter-list.index') }}"
                                class="nav-link  @if ($subMenu == 'VoterList') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Not Voter List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('nid-correction.index') }}"
                                class="nav-link  @if ($subMenu == 'NidCorrection') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>NID Correction</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('childless.index') }}"
                                class="nav-link  @if ($subMenu == 'Childless') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Childless</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('orphan.index') }}"
                                class="nav-link  @if ($subMenu == 'Orphan') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orphan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('financial-instability.index') }}"
                                class="nav-link  @if ($subMenu == 'FinancialInstability') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Financial Instability</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('age.index') }}"
                                class="nav-link  @if ($subMenu == 'Age') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Age</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('permanent-citizen.index') }}"
                                class="nav-link  @if ($subMenu == 'PermanentCitizen') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permanent Citizen</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
        <a href="{{route('birth.index')}}" class="nav-link  {{$subMenu == 'Birth'?'active'?''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>Alive</p>
        </a>
      </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('residential.index') }}"
                                class="nav-link  @if ($subMenu == 'Residential') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Residential</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('guardian-income.index') }}"
                                class="nav-link  @if ($subMenu == 'GuardianIncome') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Guardian Income</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Organization Info --}}
                <li class="nav-item

  @if (
      $subMenu == 'OrganizationCreate' ||
          $subMenu == 'OrganizationList' ||
          $subMenu == 'OrganizationShow' ||
          $subMenu == 'RegistrationFees' ||
          $subMenu == 'RenewFees' ||
          $subMenu == 'TradeLicense' ||
          $subMenu == 'GetTradeLicense') menu-open @endif
  ">
                    <a href="#" class="nav-link @if ($mainMenu == 'Organization') active @endif ">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Organization
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('organization.create') }}"
                                    class="nav-link @if ($subMenu == 'OrganizationCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('organization.index') }}"
                                    class="nav-link @if ($subMenu == 'OrganizationList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Applicant Org. List</p>
                                </a>
                            </li>
                        @endif

                        @if (basic_settings_permissions())
                            <li class="nav-item">
                                <a href="{{ route('organizationA.registration-fees.index') }}"
                                    class="nav-link @if ($subMenu == 'RegistrationFees') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fees</p>
                                </a>
                            </li>
                        @endif



                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('organizationA.trade-license.index') }}"
                                    class="nav-link @if ($subMenu == 'TradeLicense') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Generate Invoice </p>
                                </a>
                            </li>
                        @endif

                        @if (create_permission())
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

                {{-- Hotel & Restaurant --}}
                <li class="nav-item

                     @if ($subMenu == 'HotelRestaurant' || $subMenu == 'HotelRestaurantist') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'HotelRestaurant') active @endif ">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Hotel & Restaurant
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- @if (create_permission()) --}}
                        <li class="nav-item">
                            <a href="{{ route('hotel-restaurant.create') }}"
                                class="nav-link @if ($subMenu == 'HotelRestaurantCreate') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        @if (view_permission())
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



                {{-- Tax --}}
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

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('tax.create') }}"
                                    class="nav-link  @if ($subMenu == 'TaxGenerate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tax Generate</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('tax.index') }}"
                                    class="nav-link @if ($subMenu == 'TaxList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('taxes.tax-rate.index') }}"
                                    class="nav-link {{ $subMenu == 'TaxRateList' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tax Rate</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                {{-- <a href="{{ route('taxes.tax.receipt') }}" --}}
                                <a href="#" class="nav-link @if ($subMenu == 'TaxReceipt') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tax Recipt</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
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

                {{-- Relief --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-seedling"></i>
                        <p>
                            Relief
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Relief</p>
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

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Type</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Distribution</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Recived</p>
                                </a>
                            </li>
                        @endif


                    </ul>
                </li>



                {{-- House Info --}}
                <li class="nav-item @if ($subMenu == 'HouseCreate' || $subMenu == 'HouseList') menu-open @endif">
                    <a href="#" class="nav-link  @if ($mainMenu == 'House') active @endif ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            House Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('house.create') }}"
                                    class="nav-link @if ($subMenu == 'HouseCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif


                        @if (view_permission())
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

                {{-- Land Info --}}
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

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('land.create') }}"
                                    class="nav-link @if ($subMenu == 'LandCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif
                        @if (view_permission())
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



                {{-- Vehicle Info --}}
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
              $subMenu == 'VehicleAddFeesList') menu-open @endif">
                    <a href="#" class="nav-link @if ($mainMenu == 'Vehicle') active @endif">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Vehicle Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('vehicle.create') }}"
                                    class="nav-link @if ($subMenu == 'VehicleCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('vehicle.index') }}"
                                    class="nav-link @if ($subMenu == 'VehicleList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Application List</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link @if ($subMenu == 'VehicleApprovalList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Approval List</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item has-treeview @if ($subMenu == 'VehicleAddFeesNewSetup' || $subMenu == 'VehicleAddFeesList') menu-open @endif">
                                <a href="#" class="nav-link @if ($subMenu == 'VehicleAddFeesNewSetup' || $subMenu == 'VehicleAddFeesList') active @endif">
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

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link @if ($subMenu == 'VehicleGenerateInvoice') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Generate Invoice</p>
                                </a>
                            </li>
                        @endif



                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link @if ($subMenu == 'VehicleLicense') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>License</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item has-treeview @if ($subMenu == 'VehicleOwnershipChangeApplication' || $subMenu == 'VehicleOwnershipChangeApproval') menu-open @endif">
                                <a href="#" class="nav-link @if ($subMenu == 'VehicleOwnershipChangeApplication' || $subMenu == 'VehicleOwnershipChangeApproval') active @endif">
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

                {{-- Road Info --}}
                <li class="nav-item @if ($subMenu == 'RoadCreate' || $subMenu == 'RoadList') menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-road"></i>
                        <p>
                            Road Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('road.create') }}"
                                    class="nav-link @if ($subMenu == 'RoadCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
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

                {{-- Bridge Info --}}
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

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('bridge.create') }}"
                                    class="nav-link @if ($subMenu == 'BridgeCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
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

                {{-- Market Info --}}
                <li class="nav-item  @if ($subMenu == 'MarketCreate' || $subMenu == 'MarketList') menu-open @endif">
                    <a href="#" class="nav-link  @if ($mainMenu == 'Market') active @endif">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Market Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('market.create') }}"
                                    class="nav-link @if ($subMenu == 'MarketCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
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
                <li class="nav-item

          @if (
              $subMenu == 'MarriageCreate' ||
                  $subMenu == 'MarriageList' ||
                  $subMenu == 'DivorceCreate' ||
                  $subMenu == 'DivorceList') menu-open @endif


          ">
                    <a href="#" class="nav-link @if ($mainMenu == 'Marriage' || $mainMenu == 'Divorce') active @endif ">
                        <i class="nav-icon fas fa-ring"></i>
                        <p>
                            Marriage & Divorce
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('marriage.create') }}"
                                    class="nav-link @if ($subMenu == 'MarriageCreate') active @endif ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Marriage Reg.</p>
                                </a>
                            </li>
                        @endif


                        @if (view_permission())
                            <li class="nav-item">
                                <a href="{{ route('marriage.index') }}"
                                    class="nav-link @if ($subMenu == 'MarriageList') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Marriage List</p>
                                </a>
                            </li>
                        @endif

                        @if (create_permission())
                            <li class="nav-item">
                                <a href="{{ route('divorce.create') }}"
                                    class="nav-link @if ($subMenu == 'DivorceCreate') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Divorce Reg</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
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

                {{-- Chairman Info --}}
                <li class="nav-item {{ $mainMenu == 'chairman' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $mainMenu == 'chairman' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Chairman Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item ">
                            <a href="{{ route('chairman.create') }}"
                                class="nav-link {{ $subMenu == 'chairmanCreate' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Chairman</p>
                            </a>
                        </li>


                        @if (view_permission())
                            <li class="nav-item ">
                                <a href="{{ route('chairman.index') }}"
                                    class="nav-link {{ $subMenu == 'chairmanList' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View</p>
                                </a>
                            </li>
                        @endif

                        @if (view_permission())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Ex Chairman</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>

                {{-- Member/Councilor Info --}}
                <li class="nav-item {{ $mainMenu == 'councilor' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $mainMenu == 'councilor' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Member/Councilor Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="{{ route('councilor.create') }}"
                                class="nav-link {{ $subMenu == 'councilorCreate' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Member</p>
                            </a>
                        </li>


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
                </li>

                {{-- Member/Commitee  --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Member/Commitee
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Member</p>
                            </a>
                        </li>
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
                    </ul>
                </li>






            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
