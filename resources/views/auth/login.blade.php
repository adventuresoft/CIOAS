@extends('backend.layouts.login', ['title' => 'লগইন'])
@push('style')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            /* Light metallic/white background */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #1e293b;
        }

        .login-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            display: flex;
            /* Light Metallic effect */
            background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            border-top: 1px solid #ffffff;
            border-left: 1px solid #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            overflow: hidden;
            width: 100%;
            max-width: 700px;
            max-height: 400px;
            height: 400px;
        }

        /* Left Side */
        .login-left {
            flex: 0 0 260px;
            background: #046307;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 24px 22px;
            text-align: center;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        /* Metallic shine effect on left */
        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.1) 45%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 55%, transparent 60%);
            animation: shine 6s infinite;
            pointer-events: none;
        }

        @keyframes shine {
            0% {
                transform: translateX(-50%) translateY(-50%) rotate(0deg);
            }

            100% {
                transform: translateX(50%) translateY(50%) rotate(45deg);
            }
        }

        .login-top {
            margin-bottom: 14px;
        }

        .login-top h6 {
            font-size: 11px;
            font-weight: 500;
            margin: 0;
            letter-spacing: 1.5px;
            color: #a7f3d0;
            text-transform: uppercase;
        }

        .login-top h3 {
            font-size: 30px;
            font-weight: 800;
            color: #ffffff;
            margin: 6px 0 3px 0;
            letter-spacing: 1px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .login-top h4 {
            font-size: 12px;
            font-weight: 400;
            color: #e2e8f0;
            margin: 0 0 16px 0;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
            width: 100%;
        }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 11.5px;
            color: #d1fae5;
            line-height: 1.5;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li .f-icon {
            width: 26px;
            height: 26px;
            min-width: 26px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #a7f3d0;
            margin-top: 1px;
        }

        .login-bottom {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .login-bottom h5 {
            font-size: 10px;
            font-weight: 600;
            color: #d1fae5;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-bottom img {
            max-width: 110px;
            width: 100%;
            filter: brightness(0) invert(1);
            opacity: 1;
        }

        /* Right Side */
        .login-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 24px 30px;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 360px;
        }

        .login-form-header {
            text-align: center;
            margin-bottom: 14px;
        }

        .login-form-header img {
            height: 44px;
            width: 44px;
            margin-bottom: 7px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .login-form-header h5 {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .login-form-header p {
            font-size: 11px;
            color: #475569;
            margin: 3px 0 0 0;
        }

        .form-group {
            margin-bottom: 10px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-group input {
            width: 100%;
            padding: 9px 13px;
            /* Light Metallic input style */
            background: linear-gradient(to bottom, #ffffff, #f8fafc);
            border: 1px solid #cbd5e1;
            border-top: 1px solid #94a3b8;
            border-radius: 8px;
            font-size: 13px;
            color: #1e293b;
            transition: all 0.3s ease;
            font-family: inherit;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .form-group input:focus {
            outline: none;
            border-color: #006a4e;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04), 0 0 0 3px rgba(0, 106, 78, 0.15);
            background: #ffffff;
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            cursor: pointer;
            color: #94a3b8;
            font-size: 14px;
            transition: color 0.3s;
            display: none;
        }

        .input-icon:hover {
            color: #475569;
        }

        .input-icon.show {
            display: block;
        }

        .form-group.has-icon input {
            padding-right: 45px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            border-left: 4px solid transparent;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-color: #10b981;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        .btn-login {
            width: 100%;
            padding: 9px;
            /* Premium metallic button */
            background: #046307;
            color: white;
            border: 1px solid #00523b;
            border-top: 1px solid #00d59b;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 6px;
            box-shadow: 0 4px 15px rgba(0, 106, 78, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #00c992, #008260);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 106, 78, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-login:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(0, 106, 78, 0.4), inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-footer {
            margin-top: 10px;
            text-align: center;
            font-size: 11px;
        }

        .form-footer a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: #0f172a;
        }

        .forgot-password {
            display: inline-block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                max-width: 100%;
                max-height: none;
                height: auto;
                border-radius: 12px;
            }

            .login-left {
                flex: none;
                width: 100%;
                flex: 0 0 auto;
                padding: 22px 20px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            }

            .login-left::before {
                display: none;
            }

            .login-top h3 {
                font-size: 24px;
            }

            .feature-list {
                display: none;
            }

            .login-bottom {
                display: none;
            }

            .login-right {
                padding: 24px 20px;
            }

            .login-form-wrapper {
                max-width: 100%;
            }

            .login-form-header img {
                height: 38px;
                width: 38px;
            }

            .login-form-header h5 {
                font-size: 15px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side -->
            <div class="login-left">
                <div class="login-top">
                    <h6>Welcome to</h6>
                    <h3>CIOAS</h3>
                    <h4>System Gateway</h4>
                    <ul class="feature-list">
                        <li>
                            <span class="f-icon"><i class="fas fa-tasks"></i></span>
                            <span>প্রশাসনিক ও মনিটরিং কার্যক্রম পরিচালনা করুন।</span>
                        </li>
                        <li>
                            <span class="f-icon"><i class="fas fa-chart-line"></i></span>
                            <span>রিয়েল-টাইম রিপোর্ট এবং তথ্য বিশ্লেষণ করুন।</span>
                        </li>
                        <li>
                            <span class="f-icon"><i class="fas fa-users-cog"></i></span>
                            <span>নাগরিক সেবা ও ইউজার ম্যানেজমেন্ট নিশ্চিত করুন।</span>
                        </li>
                    </ul>
                </div>
                <div class="login-bottom">
                    <h5>Powered by</h5>
                    <img src="{{ asset('frontend/img/adv_soft_logo.png') }}" alt="Adventure Soft">
                </div>
            </div>

            <!-- Right Side -->
            <div class="login-right">
                <div class="login-form-wrapper">
                    <div class="login-form-header">
                        <img src="{{ asset('frontend/img/govt-logo.png') }}" alt="Bangladesh Logo">
                        <h5>Secure Login</h5>
                        <p>Enter your credentials to access the portal</p>
                    </div>

                    <form method="POST" action="{{ route('login.check') }}">
                        @csrf

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle mr-2"></i> {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i> {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">User ID</label>
                            <div class="input-wrapper">
                                <input type="email" id="email" name="email" placeholder="Enter your user ID"
                                    class="form-control" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group has-icon">
                            <label for="password">Password</label>
                            <div class="input-wrapper">
                                <input type="password" id="password" name="password" placeholder="Enter your password"
                                    class="form-control" required>
                                <span class="input-icon show" id="togglePassword" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt mr-2"></i> Login to
                            System</button>
                    </form>

                    <div class="form-footer">
                        <a href="#" class="forgot-password">Forgot password?</a>
                        <div class="footer-links">
                            <a href="#">Terms of Use</a>
                            <a href="#">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
    </script>
@endsection

@push('script')
@endpush