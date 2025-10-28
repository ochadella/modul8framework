<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Daftar akun login (ditambah akun angelyna)
    $accounts = [
        [
            'email' => 'admin@mail.com',
            'password' => '123456',
            'nama' => 'Admin RSHP',
            'role' => 'admin',
            'redirect' => '/interface/dashboard'
        ],
        [
            'email' => 'resepsionis@mail.com',
            'password' => '654321',
            'nama' => 'Resepsionis Angel',
            'role' => 'resepsionis',
            // ✅ Path diperbaiki agar menuju ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_resepsionis'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'azzam@mail.com',
            'password' => '123456',
            'nama' => 'Azzam',
            'role' => 'resepsionis',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_resepsionis'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'angelyna@mail.com',
            'password' => '123456',
            'nama' => 'Angelyna',
            'role' => 'resepsionis',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_resepsionis'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'daffa@mail.com',
            'password' => '123456',
            'nama' => 'Daffa',
            'role' => 'perawat',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_perawat'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'ryan@mail.com',
            'password' => '123456',
            'nama' => 'Ryan',
            'role' => 'perawat',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_perawat'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'ocalucu@mail.com',
            'password' => '123456',
            'nama' => 'ocaa',
            'role' => 'dokter',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_dokter'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'mayshalucu@mail.com',
            'password' => '123456',
            'nama' => 'Maysha',
            'role' => 'dokter',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_dokter'
        ],
        [
            // ✅ Tambahan akun kamu
            'email' => 'ale@mail.com',
            'password' => '123456',
            'nama' => 'Ale',
            'role' => 'dokter',
            // ✅ Arahkan juga ke interface/dashboard_resepsionis.php
            'redirect' => '../interface/dashboard_dokter'

        ]
    ];

    $found = null;
    foreach ($accounts as $acc) {
        if ($email === $acc['email'] && $password === $acc['password']) {
            $found = $acc;
            break;
        }
    }

    if ($found) {
        $_SESSION['user'] = [
            'logged_in' => true,
            'email' => $found['email'],
            'nama' => $found['nama'],
            'role' => $found['role']
        ];
        $_SESSION['nama'] = $found['nama'];
        header("Location: " . $found['redirect']);
        exit;
    } else {
        $error = "Email atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login RSHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #102f76;
        }
        .login-container input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #142a46;
            border-radius: 8px;
            font-size: 14px;
        }
        .login-container button {
            background: linear-gradient(to right, #f9a01b, #ff9554);
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
        }
        .login-container button:hover {
            background: linear-gradient(to right, #ff9554, #f9a01b);
        }
        .error {
            margin-top: 15px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login RSHP</h2>
    <?php if (isset($error)) : ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>

</div>
</body>
</html>
