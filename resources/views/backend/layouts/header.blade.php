<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); padding: 8px 20px;">
  <!-- Left navbar links -->
  <ul class="navbar-nav align-items-center">
    <li class="nav-item">
      <a class="nav-link text-dark" data-widget="pushmenu" href="#" role="button" style="padding-left: 0;"><i class="fas fa-bars" style="font-size: 1.1rem;"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block align-self-center ml-2">
      <div class="d-flex align-items-center">
          <span class="badge font-weight-bold px-3 py-2 rounded-lg" style="font-size: 0.85rem; background-color: #e6f3ef; color: #006a4e; border: 1px solid rgba(0, 106, 78, 0.2); letter-spacing: 0.3px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
              <i class="fas fa-university mr-2"></i>
              {{user_institute_name(Auth::user()->institute_id)}}
              @if(Auth::user()->institute && Auth::user()->institute->type)
                  - {{Auth::user()->institute->type->name}}
              @endif
          </span>
      </div>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto align-items-center" style="gap: 12px;">

    <!-- User Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center hover-shadow" data-toggle="dropdown" href="#" style="padding: 6px 16px; border-radius: 30px; background-color: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.2s ease-in-out;">
        <div class="rounded-circle overflow-hidden bg-gray-200 d-flex align-items-center justify-center mr-2 border border-secondary/20 shadow-sm" style="width: 28px; height: 28px;">
          @if(auth()->user()->image && file_exists(public_path('uploads/user/' . auth()->user()->image)))
            <img src="{{ asset('uploads/user/' . auth()->user()->image) }}" class="h-full w-full object-cover" alt="User">
          @else
            <i class="fas fa-user-circle text-muted" style="font-size: 1.2rem;"></i>
          @endif
        </div>
        <span class="d-none d-md-inline font-weight-bold text-dark mr-2" style="font-size: 0.85rem; letter-spacing: 0.2px;">{{ auth()->user()->name }}</span>
        <i class="fas fa-chevron-down text-muted" style="font-size: 0.65rem; opacity: 0.7;"></i>
      </a>
      
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right rounded-xl shadow-lg border-0 p-0" style="min-width: 260px; margin-top: 10px; border: 1px solid #f1f5f9 !important; overflow: hidden;">
        <!-- Header Profile Card -->
        <div class="px-4 py-4 text-center border-bottom" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
          <div class="rounded-circle overflow-hidden bg-gray-150 mx-auto mb-2.5 flex items-center justify-center border-2 border-[#006a4e] shadow-sm" style="width: 52px; height: 52px;">
            @if(auth()->user()->image && file_exists(public_path('uploads/user/' . auth()->user()->image)))
              <img src="{{ asset('uploads/user/' . auth()->user()->image) }}" class="h-full w-full object-cover" alt="User">
            @else
              <i class="fas fa-user-circle text-muted text-3xl"></i>
            @endif
          </div>
          <h6 class="font-weight-bold text-dark mb-0 text-sm" style="letter-spacing: 0.2px;">{{ auth()->user()->name }}</h6>
          <p class="text-[10px] text-muted mb-0" style="word-break: break-all;">{{ auth()->user()->email }}</p>
        </div>
        
        <!-- Options List -->
        <div class="p-2" style="background-color: #ffffff;">
          <!-- Edit Profile Option -->
          <a href="{{ route('profile') }}" class="dropdown-item rounded-lg py-2.5 px-3 text-dark font-weight-bold d-flex align-items-center justify-content-between transition-all" style="font-size: 0.85rem; border-radius: 8px; transition: 0.2s;">
            <span class="d-flex align-items-center"><i class="fas fa-user-cog mr-2.5" style="color: #006a4e; font-size: 0.95rem;"></i> Edit Profile</span>
            <i class="fas fa-chevron-right text-xs opacity-40"></i>
          </a>
          
          <div class="dropdown-divider my-1" style="border-top: 1px solid #f1f5f9;"></div>
          
          <!-- Logout Option -->
          <button type="button" onclick="event.preventDefault();document.getElementById('logoutForm').submit();"
            class="dropdown-item rounded-lg py-2.5 px-3 text-danger font-weight-bold d-flex align-items-center justify-content-between transition-all border-0 bg-transparent" style="font-size: 0.85rem; border-radius: 8px; transition: 0.2s;">
            <span class="d-flex align-items-center"><i class="fas fa-sign-out-alt mr-2.5" style="font-size: 0.95rem;"></i> Logout</span>
            <i class="fas fa-chevron-right text-xs opacity-50"></i>
          </button>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link text-dark hover-opacity" data-widget="fullscreen" href="#" role="button" style="padding: 8px;">
        <i class="fas fa-expand-arrows-alt" style="font-size: 1rem;"></i>
      </a>
    </li>
  </ul>
</nav>

<style>
  .hover-shadow:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    border-color: #cbd5e1 !important;
    background-color: #f1f5f9 !important;
  }
  .dropdown-item:hover {
    background-color: #f8fafc !important;
  }
  .dropdown-item.text-danger:hover {
    background-color: #fee2e2 !important;
    color: #b91c1c !important;
  }
  .hover-opacity:hover {
    opacity: 0.8;
  }
</style>