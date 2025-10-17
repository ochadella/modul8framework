<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard RSHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #fff;
            padding: 15px 30px;
            color: #102f76;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(22, 7, 7, 0.1);
        }
        .navbar span:first-child {
            font-weight: bold;
            font-size: 18px;
            color: #102f76;
        }
        .navbar a {
            color: #102f76;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            transition: 0.3s;
        }
        .navbar a:hover {
            color: #f9a01b;
        }
        .content {
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 80%;
            max-width: 800px;
            text-align: center;
        }
        h2 {
            color: #102f76;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            color: #333;
        }
        b {
            color: #f9a01b;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <span>Dashboard RSHP</span>
        <span>
            <a href="{{ url('/admin/datamaster') }}">Data Master</a>
            <a href="{{ url('/login') }}">Logout</a>
        </span>
    </div>
    <div class="content">
        <h2>Selamat datang dihalaman dashboard</h2>
        <p>Anda login sebagai <b>{{ session('user.role') ?? 'Guest' }}</b>.</p>
    </div>
</body>
</html>
