
@extends('backend.layouts.login', ['title' => 'লগইন'])
@push('style')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
        }

        .login-container {
            height: 100vh;
            display: flex;
            background: white;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            display: flex;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            width: 100%;
            max-width: 680px;
            height: auto;
        }

        .login-left {
            flex: 0 0 auto;
            background: linear-gradient(135deg, #98dcc3 0%, #b8e6d5 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 30px 28px;
            color: #333;
            width: 260px;
        }

        .login-top {
            text-align: left;
            width: 100%;
        }

        .login-top h6 {
            font-size: 12px;
            font-weight: 400;
            margin: 0;
            letter-spacing: 0.5px;
            color: #333;
        }

        .login-top h3 {
            font-size: 32px;
            font-weight: 700;
            color: #1a3a7d;
            margin: 6px 0 2px 0;
        }

        .login-top h4 {
            font-size: 16px;
            font-weight: 600;
            color: #e74c3c;
            margin: 0;
        }

        .login-bottom {
            text-align: center;
            width: 100%;
        }

        .login-bottom h5 {
            font-size: 12px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .login-bottom img {
            max-width: 120px;
            width: 100%;
        }

        .login-right {
            flex: 1;
            background: #f8f9fb;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            min-width: 320px;
        }

        .login-form-wrapper {
            background: transparent;
            border-radius: 0;
            padding: 20px 30px;
            width: 100%;
            max-width: none;
            box-shadow: none;
        }

        .login-form-header {
            text-align: center;
            margin-bottom: 16px;
            padding: 0;
        }

        .login-form-header img {
            height: 50px;
            width: 50px;
            margin-bottom: 8px;
        }

        .login-form-header h4 {
            font-size: 13px;
            font-weight: 600;
            color: #1a9f5c;
            letter-spacing: 0.3px;
            margin: 8px 0 4px 0;
        }

        .login-form-header h5 {
            font-size: 16px;
            font-weight: 700;
            color: #1a3a7d;
            margin: 0;
        }

        .form-group {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: #333;
            white-space: nowrap;
            min-width: 70px;
        }

        .form-group .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            flex: 1;
        }

        .form-group input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 13px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1a3a7d;
            box-shadow: 0 0 0 2px rgba(26, 58, 125, 0.08);
        }

        .form-group input::placeholder {
            color: #bbb;
        }

        .input-icon {
            position: absolute;
            right: 12px;
            cursor: pointer;
            color: #999;
            font-size: 14px;
            display: none;
        }

        .input-icon.show {
            display: block;
        }

        .form-group.has-icon input {
            padding-right: 35px;
        }

        .alert {
            margin-bottom: 12px;
            padding: 8px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn-login {
            width: 100%;
            padding: 8px;
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 6px;
        }

        .btn-login:hover {
            background-color: #059669;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .form-footer {
            margin-top: 10px;
            text-align: center;
            font-size: 11px;
        }

        .form-footer a {
            color: #7a8fa8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: #1a3a7d;
        }

        .forgot-password {
            display: block;
            margin-bottom: 8px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding-top: 8px;
            border-top: 1px solid #eee;
        }

        @media (max-width: 1024px) {
            .login-card {
                max-width: 650px;
            }

            .login-left {
                padding: 30px 25px;
            }

            .login-form-wrapper {
                padding: 30px 25px;
            }
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                max-width: 100%;
            }

            .login-left {
                width: 100%;
                padding: 25px;
            }

            .login-right {
                padding: 25px;
                flex: 1;
            }

            .login-form-wrapper {
                max-width: 100%;
                padding: 25px 20px;
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
                    <h3>CSMCRS</h3>
                    <h4></h4>
                </div>
                <div class="login-bottom">
                    <h5>Powered by:</h5>
                    <img src="{{ asset('frontend/img/adv_soft_logo.png') }}" alt="Adventure Soft">
                </div>
            </div>

            <!-- Right Side -->
            <div class="login-right">
            <div class="login-form-wrapper">
                <div class="login-form-header">
                    <img src="{{ asset('frontend/img/govt-logo.png') }}" alt="Bangladesh Logo">
                    <h4></h4>
                    <h5>Login Panel</h5>
                </div>

                <form method="POST" action="{{ route('login.check') }}">
                    @csrf

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="email">User ID</label>
                        <div class="input-wrapper">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="User ID"
                                class="form-control"
                                required
                                value="{{ old('email') }}"
                            >
                        </div>
                    </div>

                    <div class="form-group has-icon">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Password"
                                class="form-control"
                                required
                            >
                            <span class="input-icon show" id="togglePassword" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>

                <div class="form-footer">
                    <a href="#" class="forgot-password">Forgot password?</a>
                    <div class="footer-links">
                        <a href="#">Terms of use.</a>
                        <a href="#">Privacy policy</a>
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
