<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    // 🔹 Ambil semua user + role (tanpa ubah struktur tabel user)
    public function getAll() {
        $sql = "
            SELECT 
                u.iduser, 
                u.nama, 
                u.email, 
                COALESCE(GROUP_CONCAT(r.nama_role SEPARATOR ', '), '-') AS role
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole
            GROUP BY u.iduser, u.nama, u.email
            ORDER BY u.iduser ASC
        ";
        $result = $this->db->query($sql);

        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return ['data' => $data];
    }

    // 🔹 Ambil 1 user berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM user WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 🔹 Tambah user baru
    public function create($nama, $email, $password) {
        $sql = "INSERT INTO user (nama, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $nama, $email, $password);
        return $stmt->execute();
    }

    // 🔹 Update data user
    public function update($id, $nama, $email) {
        $sql = "UPDATE user SET nama = ?, email = ? WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $nama, $email, $id);
        return $stmt->execute();
    }

    // 🔹 Reset password user
    public function resetPassword($id, $password) {
        $sql = "UPDATE user SET password = ? WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $password, $id);
        return $stmt->execute();
    }

    // 🔹 Hapus user
    public function delete($id) {
        $sql = "DELETE FROM user WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    function checkLogin($email, $password) {
        $db = new DBConnection();
        $user = new User($db);

        // 🔹 Validasi input kosong
        if (trim($email) === '' || trim($password) === '') {
            $_SESSION['error'] = "Email dan password wajib diisi!";
            header("Location: ../interface/login.php");
            exit;
        }

        // 🔹 Cek user berdasarkan email
        $conn = $db->getConnection();
        $stmt = $conn->prepare("
            SELECT u.iduser, u.nama, u.email, u.password, r.nama_role 
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole
            WHERE u.email = ?
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // 🔹 Cek password
            if ($row['password'] === $password) {
                $_SESSION['user'] = [
                    'iduser' => $row['iduser'],
                    'nama' => $row['nama'],
                    'email' => $row['email'],
                    'role' => $row['nama_role'],
                    'logged_in' => true
                ];

                // 🔹 Redirect sesuai role
                switch (strtolower($row['nama_role'])) {
                    case 'admin':
                        header("Location: ../interface/dashboard.php");
                        break;
                    case 'resepsionis':
                        header("Location: ../interface/dashboard_resepsionis.php");
                        break;
                    case 'dokter':
                        header("Location: ../interface/dashboard_dokter.php");
                        break;
                    default:
                        header("Location: ../interface/dashboard_perawat.php");
                        break;
                }
                exit;
            } else {
                $_SESSION['error'] = "Password salah!";
                header("Location: ../auth/login_post.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Email tidak ditemukan!";
            header("Location: ../auth/login_post.php");
            exit;
        }
    }
}
?>
