<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login RSHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            width: 380px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 25px;
            color: #102f76;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 13px;
            font-weight: 600;
        }
        .login-container input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.3s;
        }
        .login-container input:focus {
            outline: none;
            border-color: #102f76;
        }
        .login-container button {
            background: linear-gradient(to right, #f9a01b, #ff9554);
            color: white;
            padding: 14px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .login-container button:hover {
            background: linear-gradient(to right, #ff9554, #f9a01b);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249,160,27,0.4);
        }
        .error {
            background: #fee;
            border: 1px solid #fcc;
            color: #c33;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: left;
        }
        .success {
            background: #efe;
            border: 1px solid #cfc;
            color: #3c3;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>🏥 Login RSHP</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                • {{ $error }}<br>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   placeholder="Masukkan email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   placeholder="Masukkan password" 
                   required>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>