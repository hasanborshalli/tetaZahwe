<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — Teta Zahwe</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body class="admin-body admin-login-page">

    <div class="login-wrap">

        <div class="login-left">
            <div class="login-left-content">
                <div class="login-logo-en">Teta Zahwe</div>
                <div class="login-logo-ar">تيتا زهوة</div>
                <div class="login-tagline">Catering Admin Panel</div>
            </div>
            <div class="login-decor">طبخات</div>
        </div>

        <div class="login-right">
            <div class="login-form-wrap">
                <h1 class="login-title">Welcome back</h1>
                <p class="login-sub">Sign in to manage your menus and messages</p>

                @if($errors->any())
                <div class="login-error">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf
                    <div class="login-field">
                        <label class="login-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="login-input" value="{{ old('email') }}"
                            placeholder="admin@tetazahwe.com" required autofocus />
                    </div>
                    <div class="login-field">
                        <label class="login-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="login-input"
                            placeholder="••••••••••" required />
                    </div>
                    <button type="submit" class="login-btn">Sign In →</button>
                </form>

                <div class="login-back">
                    <a href="{{ route('home') }}">← Back to website</a>
                </div>
            </div>
        </div>

    </div>
</body>

</html>