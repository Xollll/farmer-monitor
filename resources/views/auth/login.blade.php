<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMS</title>
    <link rel="stylesheet" href="form/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="Form login-form">
            <h2>Login</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-box">
                    <i class='bx bxs-user'></i>
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Enter Your Email*" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="input-box">
                    <i class='bx bxs-envelope'></i>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter Your Password*" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="forgot-section">
                    <span>
                        <input type="checkbox" name="remember" id="checked"> Remember Me
                    </span>
                    <span>
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </span>
                </div>
    
                <button type="submit" class="btn">Login</button>
            </form>
        
            <p class="RegisteBtn RegiBtn">
                <a href="{{ route('register') }}">Register Now</a>
            </p>
        </div>
    </div>
    
</body>
</html>