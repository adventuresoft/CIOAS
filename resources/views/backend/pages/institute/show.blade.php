@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteList'])

@push('style')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .inst-show-page {
        font-family: 'Inter', sans-serif;
        padding: 20px 0;
    }

    /* ── Hero Banner ── */
    .inst-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f766e 100%);
        border-radius: 18px;
        padding: 36px 40px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(15,23,42,.45);
    }

    .inst-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 280px; height: 280px;
        background: radial-gradient(circle, rgba(255,255,255,.06) 0%, transparent 70%);
        border-radius: 50%;
    }
    .inst-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -40px;
        width: 320px; height: 320px;
        background: radial-gradient(circle, rgba(16,185,129,.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .inst-hero-inner {
        position: relative; z-index: 2;
        display: flex; align-items: center; gap: 28px;
    }

    .inst-icon-wrap {
        width: 76px; height: 76px;
        background: rgba(255,255,255,.12);
        border: 2px solid rgba(255,255,255,.22);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        backdrop-filter: blur(8px);
    }
    .inst-icon-wrap i { font-size: 32px; color: #fff; }

    .inst-hero-text h2 {
        margin: 0 0 6px;
        font-size: 24px; font-weight: 800;
        color: #fff; letter-spacing: -.3px;
    }
    .inst-hero-text p {
        margin: 0; font-size: 14px;
        color: rgba(255,255,255,.65);
    }

    .inst-hero-meta {
        margin-left: auto;
        display: flex; gap: 12px; align-items: center;
    }

    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 16px; border-radius: 999px;
        font-size: 12px; font-weight: 600;
        backdrop-filter: blur(8px);
    }
    .hero-badge.active   { background: rgba(16,185,129,.25); color: #6ee7b7; border: 1px solid rgba(16,185,129,.35); }
    .hero-badge.inactive { background: rgba(239,68,68,.25);  color: #fca5a5; border: 1px solid rgba(239,68,68,.35); }

    .btn-edit-hero {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 20px; border-radius: 10px;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        color: #fff; font-size: 13px; font-weight: 600;
        text-decoration: none;
        transition: background .2s;
    }
    .btn-edit-hero:hover { background: rgba(255,255,255,.25); color: #fff; }

    /* ── Info Cards ── */
    .info-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(15,23,42,.06);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .info-card-header {
        display: flex; align-items: center; gap: 12px;
        padding: 16px 24px;
        background: linear-gradient(90deg, #f8fafc, #f1f5f9);
        border-bottom: 1px solid #e8edf5;
    }
    .info-card-header .header-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .header-icon.teal   { background: #d1fae5; color: #059669; }
    .header-icon.blue   { background: #dbeafe; color: #2563eb; }
    .header-icon.purple { background: #ede9fe; color: #7c3aed; }
    .header-icon.amber  { background: #fef3c7; color: #d97706; }

    .info-card-header h6 {
        margin: 0; font-size: 14px; font-weight: 700;
        color: #0f172a; letter-spacing: .1px;
    }

    .info-card-body { padding: 24px; }

    /* ── Field Row ── */
    .field-row {
        display: flex; align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .field-row:last-child { border-bottom: none; padding-bottom: 0; }
    .field-row:first-child { padding-top: 0; }

    .field-label {
        min-width: 180px; flex-shrink: 0;
        font-size: 12px; font-weight: 600;
        color: #64748b; text-transform: uppercase; letter-spacing: .6px;
        padding-top: 2px;
    }
    .field-value {
        flex: 1;
        font-size: 14px; font-weight: 500; color: #1e293b;
        line-height: 1.5;
    }

    .val-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 12px; border-radius: 8px;
        font-size: 12px; font-weight: 600;
    }
    .val-badge.type   { background: #dbeafe; color: #1d4ed8; }
    .val-badge.cat    { background: #f0fdf4; color: #15803d; }
    .val-badge.sub    { background: #fef9c3; color: #a16207; }

    /* ── Location chip ── */
    .loc-chain {
        display: flex; flex-wrap: wrap; gap: 8px; align-items: center;
    }
    .loc-chip {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 14px; border-radius: 999px;
        background: #f1f5f9; border: 1px solid #e2e8f0;
        font-size: 12px; font-weight: 600; color: #475569;
    }
    .loc-chip i { font-size: 11px; color: #94a3b8; }
    .loc-arrow { color: #cbd5e1; font-size: 12px; }

    /* ── Admin card ── */
    .admin-card-inner {
        display: flex; align-items: center; gap: 20px;
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
    }
    .admin-avatar {
        width: 56px; height: 56px; border-radius: 14px;
        background: linear-gradient(135deg, #1e40af, #0f766e);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 22px; color: #fff; font-weight: 700;
    }
    .admin-info h6 { margin: 0 0 3px; font-size: 15px; font-weight: 700; color: #0f172a; }
    .admin-info p  { margin: 0; font-size: 13px; color: #64748b; }

    .no-data {
        text-align: center; padding: 30px;
        color: #94a3b8; font-size: 14px;
    }
    .no-data i { font-size: 32px; display: block; margin-bottom: 8px; }

    @media (max-width: 768px) {
        .inst-hero-inner { flex-direction: column; align-items: flex-start; }
        .inst-hero-meta  { margin-left: 0; }
        .field-label     { min-width: 140px; }
    }
</style>
@endpush

@section('title', 'Institute — ' . ($institute->type->name ?? 'Details'))

@section('content')

<div class="inst-show-page">
    <div class="container-fluid">


        <div class="row">

            {{-- Left Column --}}
            <div class="col-lg-8">

                {{-- Basic Info --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="header-icon teal"><i class="fas fa-info-circle"></i></div>
                        <h6>Basic Information</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="field-row">
                            <span class="field-label">Institute Type</span>
                            <span class="field-value">
                                <span class="val-badge type">
                                    <i class="fas fa-tag"></i>
                                    {{ $institute->type->name ?? '—' }}
                                </span>
                            </span>
                        </div>
                        <div class="field-row">
                            <span class="field-label">Category</span>
                            <span class="field-value">
                                <span class="val-badge cat">{{ $institute->category->name ?? '—' }}</span>
                            </span>
                        </div>
                        <div class="field-row">
                            <span class="field-label">Subcategory</span>
                            <span class="field-value">
                                @php
                                    $subMap = [1 => 'Category A', 2 => 'Category B', 3 => 'Category C'];
                                @endphp
                                <span class="val-badge sub">
                                    {{ $subMap[$institute->institute_subcategory_id] ?? '—' }}
                                </span>
                            </span>
                        </div>
                        <div class="field-row">
                            <span class="field-label">Activation Date</span>
                            <span class="field-value">
                                <i class="fas fa-calendar-check text-muted mr-1" style="font-size:12px;"></i>
                                {{ $institute->activation_time ? \Carbon\Carbon::parse($institute->activation_time)->format('d M, Y') : '—' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Location --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="header-icon blue"><i class="fas fa-map-marker-alt"></i></div>
                        <h6>Location</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="field-row">
                            <span class="field-label">Full Address</span>
                            <span class="field-value">
                                <div class="loc-chain">
                                    @if($institute->division)
                                        <span class="loc-chip"><i class="fas fa-map"></i> {{ $institute->division->name }}</span>
                                        <span class="loc-arrow">›</span>
                                    @endif
                                    @if($institute->district)
                                        <span class="loc-chip"><i class="fas fa-city"></i> {{ $institute->district->name }}</span>
                                        <span class="loc-arrow">›</span>
                                    @endif
                                    @if($institute->thana)
                                        <span class="loc-chip"><i class="fas fa-map-pin"></i> {{ $institute->thana->name }}</span>
                                    @endif
                                    @if(!$institute->division && !$institute->district && !$institute->thana)
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </span>
                        </div>
                        @if($institute->union)
                        <div class="field-row">
                            <span class="field-label">Union</span>
                            <span class="field-value">{{ $institute->union->name ?? '—' }}</span>
                        </div>
                        @endif
                        @if($institute->pourashava)
                        <div class="field-row">
                            <span class="field-label">Pourashava</span>
                            <span class="field-value">{{ $institute->pourashava->name ?? '—' }}</span>
                        </div>
                        @endif
                        @if($institute->cityCorporation)
                        <div class="field-row">
                            <span class="field-label">City Corporation</span>
                            <span class="field-value">{{ $institute->cityCorporation->name ?? '—' }}</span>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Right Column --}}
            <div class="col-lg-4">

                {{-- Admin Info --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="header-icon purple"><i class="fas fa-user-shield"></i></div>
                        <h6>Institute Admin</h6>
                    </div>
                    <div class="info-card-body" style="padding: 16px;">
                        @if($institute->superUser)
                            <div class="admin-card-inner">
                                <div class="admin-avatar">
                                    {{ strtoupper(substr($institute->superUser->name ?? 'A', 0, 1)) }}
                                </div>
                                <div class="admin-info">
                                    <h6>{{ $institute->superUser->name ?? '—' }}</h6>
                                    <p>{{ $institute->superUser->email ?? '—' }}</p>
                                    @if($institute->superUser->username)
                                        <p style="margin-top:3px; font-size:12px; color:#94a3b8;">@{{ $institute->superUser->username }}</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="no-data">
                                <i class="fas fa-user-slash"></i>
                                No admin assigned yet.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="header-icon amber"><i class="fas fa-bolt"></i></div>
                        <h6>Quick Actions</h6>
                    </div>
                    <div class="info-card-body" style="padding: 16px; display: flex; flex-direction: column; gap: 10px;">
                        <a href="{{ route('institute.edit', $institute->id) }}"
                           style="display:flex; align-items:center; gap:10px; padding: 12px 16px; border-radius:10px;
                                  background: linear-gradient(135deg,#1e40af,#2563eb); color:#fff; text-decoration:none;
                                  font-size:13px; font-weight:600; transition: opacity .2s;">
                            <i class="fas fa-pen" style="font-size:14px;"></i> Edit Institute Info
                        </a>
                        <a href="{{ route('instituteA.adminCreate', $institute->id) }}"
                           style="display:flex; align-items:center; gap:10px; padding: 12px 16px; border-radius:10px;
                                  background: linear-gradient(135deg,#0f766e,#059669); color:#fff; text-decoration:none;
                                  font-size:13px; font-weight:600; transition: opacity .2s;">
                            <i class="fas fa-user-cog" style="font-size:14px;"></i> Manage Admin
                        </a>
                        <a href="{{ route('instituteA.imagesCreate', $institute->id) }}"
                           style="display:flex; align-items:center; gap:10px; padding: 12px 16px; border-radius:10px;
                                  background: linear-gradient(135deg,#7c3aed,#a855f7); color:#fff; text-decoration:none;
                                  font-size:13px; font-weight:600; transition: opacity .2s;">
                            <i class="fas fa-images" style="font-size:14px;"></i> Manage Images
                        </a>
                        <a href="{{ route('institute.index') }}"
                           style="display:flex; align-items:center; gap:10px; padding: 12px 16px; border-radius:10px;
                                  background: #f1f5f9; color:#475569; text-decoration:none;
                                  font-size:13px; font-weight:600; border: 1px solid #e2e8f0;">
                            <i class="fas fa-arrow-left" style="font-size:14px;"></i> Back to List
                        </a>
                    </div>
                </div>

                {{-- Meta Info --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="header-icon teal"><i class="fas fa-clock"></i></div>
                        <h6>Record Info</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="field-row">
                            <span class="field-label">ID</span>
                            <span class="field-value">
                                <code style="background:#f1f5f9; padding: 2px 8px; border-radius: 5px; font-size:13px;">
                                    #{{ str_pad($institute->id, 4, '0', STR_PAD_LEFT) }}
                                </code>
                            </span>
                        </div>
                        <div class="field-row">
                            <span class="field-label">Created</span>
                            <span class="field-value">{{ $institute->created_at ? $institute->created_at->format('d M Y, h:i A') : '—' }}</span>
                        </div>
                        <div class="field-row">
                            <span class="field-label">Updated</span>
                            <span class="field-value">{{ $institute->updated_at ? $institute->updated_at->format('d M Y, h:i A') : '—' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
@push('script')
@endpush
