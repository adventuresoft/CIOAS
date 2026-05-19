<div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04); background: #fff;">
    <div class="card-body p-3">
        <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
            <a href="{{ route('user.index') }}" class="nav-tab-item {{ Request::is('*user*') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i> Users Directory
            </a>
            <a href="{{ route('role.index') }}" class="nav-tab-item {{ Request::is('*role*') && !Request::is('*roleuser*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Role Definitions
            </a>
            <a href="{{ route('permission.index') }}" class="nav-tab-item {{ Request::is('*permission*') ? 'active' : '' }}">
                <i class="fas fa-key"></i> Permission Pool
            </a>
        </div>
    </div>
</div>

<style>
    .nav-tab-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        color: #64748b;
        border: 1px solid transparent;
        background: transparent;
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .nav-tab-item:hover {
        color: #1e293b;
        background: #f8fafc;
    }
    .nav-tab-item.active {
        color: #2563eb;
        background: #eff6ff;
        border-color: #bfdbfe;
    }
</style>
