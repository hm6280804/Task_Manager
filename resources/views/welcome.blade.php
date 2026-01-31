<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            font-family: "Segoe UI", sans-serif;
        }

        .auth-card {
            max-width: 400px;
            margin: 80px auto;
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .auth-card h2 {
            color: #023B7E;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }

        .btn-primary {
            background: #023B7E;
            border: none;
        }

        .btn-primary:hover {
            background: #012f63;
        }

        .links {
            text-align: center;
            margin-top: 15px;
        }

        .links a {
            text-decoration: none;
            color: #023B7E;
            margin: 0 5px;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <h2>Login</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('email'))
        <div class="alert alert-danger">{{ $errors->first('email')}}</div>
    @endif

    <form method="POST" action="{{ route("auth.processLogin") }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="links mt-3">
        <span>Don't have an account? <a href="{{ route("auth.register") }}">Sign Up</a></span><br>
        <span><a href="">Forgot Password?</a></span>
    </div>
</div>

</body>
</html>
