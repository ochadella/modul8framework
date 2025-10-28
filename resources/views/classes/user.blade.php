<?php
class User {
    private $db;

    // Konstruktor: menerima objek koneksi database
    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    /* ============================================================
       🔹 AMBIL SEMUA USER (TERMASUK ROLE)
       ============================================================ */
    public function getAll() {
        $sql = "
            SELECT 
                u.iduser,
                u.nama,
                u.email,
                COALESCE(r.nama_role, '-') AS role
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole
            ORDER BY u.iduser ASC
        ";

        $result = $this->db->query($sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /* ============================================================
       🔹 AMBIL USER BERDASARKAN ID
       ============================================================ */
    public function getById($id) {
        $sql = "SELECT * FROM user WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /* ============================================================
       🔹 TAMBAH USER BARU
       ============================================================ */
    public function create($nama, $email, $password, $role = null) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (nama, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $nama, $email, $hashed, $role);
        return $stmt->execute();
    }

    /* ============================================================
       🔹 UPDATE DATA USER
       ============================================================ */
    public function update($id, $nama, $email, $role) {
        $sql = "UPDATE user SET nama = ?, email = ?, role = ? WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", $nama, $email, $role, $id);
        return $stmt->execute();
    }

    /* ============================================================
       🔹 RESET PASSWORD
       ============================================================ */
    public function resetPassword($id, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = ? WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $hashed, $id);
        return $stmt->execute();
    }

    /* ============================================================
       🔹 HAPUS USER
       ============================================================ */
    public function delete($id) {
        $sql = "DELETE FROM user WHERE iduser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    /* ============================================================
       🔹 LOGIN VALIDATION
       ============================================================ */
    public function checkLogin($email, $password) {
        session_start();

        // Validasi input kosong
        if (trim($email) === '' || trim($password) === '') {
            $_SESSION['error'] = "Email dan password wajib diisi!";
            header("Location: ../auth/login.php");
            exit;
        }

        $sql = "
            SELECT 
                u.iduser, u.nama, u.email, u.password, 
                COALESCE(r.nama_role, '-') AS nama_role
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole
            WHERE u.email = ?
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = [
                    'iduser' => $row['iduser'],
                    'nama'   => $row['nama'],
                    'email'  => $row['email'],
                    'role'   => $row['nama_role'],
                    'logged_in' => true
                ];

                // Redirect sesuai role
                $role = strtolower($row['nama_role']);
                switch ($role) {
                    case 'administrator':
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
                header("Location: ../auth/login.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Email tidak ditemukan!";
            header("Location: ../auth/login.php");
            exit;
        }
    }
}
?>
