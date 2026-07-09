@extends('frontend.master')

@section('content')


    <!-- Hero Section -->
    <section style="min-height: calc(100vh - 200px);" class="pt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container font-kalpurush">

            <h1 class="text-center fw-bolder text-dark mb-4 text-uppercase fs-5"
                style="letter-spacing: 1px; text-shadow: 0 1px 2px rgba(0,0,0,0.05); font-size: 28px;">
                কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম
            </h1>

            <div id="departments-grid" class="row g-4 justify-content-left" style="transition: opacity 0.3s ease-in-out;">

                <!-- Card -->
                @if(isset($departments))
                    @foreach ($departments as $department)
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="javascript:void(0)"
                                onclick="showDepartmentServices('{{ $department->id }}', '{{ $department->bn_name }}')"
                                class="gov-card p-3 d-block text-decoration-none h-100 group">
                                <div class="d-flex align-items-start h-100">
                                    <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                        <i class="fas fa-calendar-check fs-4"></i>
                                    </div>

                                    <div class="d-flex flex-column h-100 w-100">
                                        <h3 class="fs-card-title">{{ $department->bn_name}}</h3>
                                        <p class="fs-content text-muted mb-3">{{$department->info }}</p>
                                        <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                            ক্লিক করুন <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Services Section -->
            <div id="services-container" style="display: none; animation: fadeIn 0.4s;">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <button class="btn btn-outline-primary btn-sm me-3 shadow-sm" onclick="showDepartmentsGrid()"
                        style="border-radius: 20px; padding: 5px 15px;">
                        <i class="fas fa-arrow-left"></i> ফিরে যান
                    </button>
                    <h3 id="department-title" class="mb-0 text-dark fw-bold" style="font-size: 22px;"></h3>
                </div>

                <div id="services-wrapper">
                    @if(isset($departments))
                        @foreach ($departments as $department)
                            <div id="dept-content-{{ $department->id }}" class="department-content" style="display: none;">
                                @if(!empty($department->url) && view()->exists($department->url))
                                    <div class="row g-4 justify-content-left">
                                        @include($department->url)
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center p-5 shadow-sm"
                                        style="border-radius: 12px; border: 1px solid #ffeeba;">
                                        <i class="fas fa-exclamation-triangle fs-1 text-warning mb-3"></i>
                                        <h5 class="fw-bold">দুঃখিত!</h5>
                                        <p class="mb-0">এই বিভাগের জন্য এখনো কোনো সেবা বা ফর্ম যুক্ত করা হয়নি।</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('style')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Fix d-d-block typo from previous layout */
        .d-d-block {
            display: block;
        }
    </style>
@endpush

@push('script')
    <script>
        function showDepartmentServices(id, name) {
            // Hide departments grid
            document.getElementById('departments-grid').style.display = 'none';

            // Show services container
            document.getElementById('services-container').style.display = 'block';

            // Update Title
            document.getElementById('department-title').innerText = name + " - এর সেবাসমূহ";

            // Hide all department contents
            let contents = document.querySelectorAll('.department-content');
            contents.forEach(content => {
                content.style.display = 'none';
            });

            // Show the specific department's content
            let targetContent = document.getElementById('dept-content-' + id);
            if (targetContent) {
                targetContent.style.display = 'block';
            }
        }

        function showDepartmentsGrid() {
            // Hide services container
            document.getElementById('services-container').style.display = 'none';

            // Show departments grid
            document.getElementById('departments-grid').style.display = 'flex';
        }
    </script>
@endpush