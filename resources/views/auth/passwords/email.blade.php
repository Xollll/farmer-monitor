<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }
        .card-header {
            font-size: 1.5em;
            margin-bottom: 15px;
            text-align: center;
        }
        .input-box {
            margin-bottom: 15px;
        }
        .input-box label {
            display: block;
            margin-bottom: 5px;
        }
        .input-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .input-box input.is-invalid {
            border-color: #dc3545;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .text-danger {
            color: #dc3545;
            font-size: 0.9em;
        }
        .text-success {
            color: #28a745;
            font-size: 0.9em;
            margin-bottom: 15px;
            text-align: center;
        }
        .registeBtn {
            text-align: center;
            margin-top: 20px;
        }
        .registeBtn a {
            color: #007bff;
            text-decoration: none;
        }
        .registeBtn a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="text-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ secure_url('password.email') }}">
                    @csrf

                    <div class="input-box">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn">Send Password Reset Link</button>
                </form>
                <div class="registeBtn">
                    <p><a href="{{ secure_url('login') }}">Back to Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
