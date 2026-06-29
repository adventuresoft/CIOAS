<style>
.stepper-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 20px 10px;
    overflow-x: auto;
}

.stepper-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    text-align: center;
    min-width: 60px;
    z-index: 2;
}

.step-link {
    text-decoration: none !important;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.step-icon-wrapper {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    font-size: 20px;
    margin-bottom: 10px;
    transition: all 0.3s;
    background-color: #fff;
}

.step-label {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.step-divider {
    flex-grow: 1;
    height: 2px;
    background-color: #e0e0e0;
    margin: 0 5px;
    margin-top: -25px; /* align with icons */
    min-width: 20px;
}

/* Status: Inactive */
.stepper-item.inactive .step-icon-wrapper {
    background-color: #f4f6f9;
    color: #a0a0a0;
}
.stepper-item.inactive .step-label {
    color: #000000;
}

/* Status: Active */
.stepper-item.active .step-icon-wrapper {
    background-color: #5b4bdf;
    color: #fff;
    box-shadow: 0 4px 10px rgba(91, 75, 223, 0.3);
}
.stepper-item.active .step-label {
    color: #000000;
}

/* Status: Completed */
.stepper-item.completed .step-icon-wrapper {
    background-color: #fff;
    color: #28a745;
    border: 2px solid #28a745;
    border-radius: 50%;
}
.stepper-item.completed .step-label {
    color: #000000;
}
.step-divider.completed-divider {
    background-color: #28a745;
}
</style>

@php
    $steps = [
        'personal' => ['label' => 'PERSONAL', 'icon' => 'fas fa-user', 'route' => 'staff.edit'],
        'family' => ['label' => 'FAMILY', 'icon' => 'fas fa-users', 'route' => 'staff.family'],
        'address' => ['label' => 'ADDRESS', 'icon' => 'fas fa-map-marker-alt', 'route' => 'staff.address'],
        'education' => ['label' => 'EDUCATION', 'icon' => 'fas fa-graduation-cap', 'route' => 'staff.education'],
        'professional' => ['label' => 'EMPLOYMENT', 'icon' => 'fas fa-briefcase', 'route' => 'staff.professional'],
        'financial' => ['label' => 'FINANCIAL', 'icon' => 'fas fa-wallet', 'route' => 'staff.financial'],
        'property' => ['label' => 'PROPERTY', 'icon' => 'fas fa-building', 'route' => 'staff.property'],
        'disability' => ['label' => 'DISABILITY', 'icon' => 'fas fa-wheelchair', 'route' => 'staff.disability'],
        'freedom' => ['label' => 'FREEDOM FIGHTER', 'icon' => 'fas fa-medal', 'route' => 'staff.freedom'],
        'july_fighter' => ['label' => 'JULY FIGHTER', 'icon' => 'fas fa-flag', 'route' => 'staff.julyFighter'],
    ];

    $step_keys = array_keys($steps);
    $current_index = array_search($active_tab, $step_keys);
@endphp

<div class="stepper-wrapper">
    @foreach($steps as $key => $step)
        @php
            $index = array_search($key, $step_keys);
            if ($index < $current_index) {
                $status = 'completed';
            } elseif ($index == $current_index) {
                $status = 'active';
            } else {
                $status = 'inactive';
            }
            $url = isset($user->id) && $step['route'] !== '#' ? route($step['route'], $user->id) : '#';
            if (!isset($user->id)) {
                $status = ($index == 0) ? 'active' : 'inactive';
            }
        @endphp

        <div class="stepper-item {{ $status }}">
            <a href="{{ $url }}" class="step-link">
                <div class="step-icon-wrapper">
                    @if($status == 'completed')
                        <i class="fas fa-check"></i>
                    @else
                        <i class="{{ $step['icon'] }}"></i>
                    @endif
                </div>
                <div class="step-label">{{ $step['label'] }}</div>
            </a>
        </div>
        @if(!$loop->last)
            <div class="step-divider {{ $index < $current_index ? 'completed-divider' : '' }}"></div>
        @endif
    @endforeach
</div>
