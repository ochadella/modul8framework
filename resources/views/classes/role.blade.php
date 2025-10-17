<?php
class Role {
    private $db;

    public function __construct($db) {
        $this->db = $db->getConnection();
    }

    public function getAll() {
        $sql = "SELECT idrole, nama_role FROM role ORDER BY idrole ASC";
        $result = $this->db->query($sql);

        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return ['data' => $data];
    }

    public function getById($id) {
        $sql = "SELECT * FROM user u JOIN role WHERE idrole = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($nama_role) {
        $sql = "INSERT INTO role (nama_role) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $nama_role);
        return $stmt->execute();
    }

    public function update($id, $nama_role) {
        $sql = "UPDATE role SET nama_role = ? WHERE idrole = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $nama_role, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM role WHERE idrole = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    /* ===========================================================
       ✅ BAGIAN TAMBAHAN UNTUK USER-ROLE MANAGEMENT
       =========================================================== */

    // Ambil semua user beserta rolenya (dari tabel role_user)
    public function getAllUserWithRoles() {
        $query = "
            SELECT 
                u.iduser, 
                u.nama, 
                u.email,
                GROUP_CONCAT(DISTINCT r.nama_role SEPARATOR ', ') AS roles,
                MAX(ru.status) AS status
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole
            GROUP BY u.iduser, u.nama, u.email
            ORDER BY u.iduser ASC
        ";

        $result = $this->db->query($query);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return ['data' => $data];
    }

    // Ambil semua role sebagai opsi dropdown
    public function getRoleOptions() {
        $sql = "SELECT idrole, nama_role FROM role ORDER BY idrole ASC";
        $result = $this->db->query($sql);
        $roles = [];

        if ($result && $result->num_rows > 0) {
            while ($r = $result->fetch_assoc()) {
                $roles[] = $r;
            }
        }
        return ['data' => $roles];
    }

    // Tambahkan atau update role user di tabel role_user
    public function addRoleToUser($iduser, $idrole, $status) {
        // ✅ Validasi dasar
        if (empty($iduser) || empty($idrole)) {
            return false;
        }

        // ✅ Pastikan idrole valid (ada di tabel role)
        $checkRole = $this->db->prepare("SELECT idrole FROM role WHERE idrole = ?");
        $checkRole->bind_param("i", $idrole);
        $checkRole->execute();
        $resRole = $checkRole->get_result();
        if ($resRole->num_rows == 0) {
            return false;
        }

        // ✅ Hapus semua role lama sebelum tambahkan role baru
        $deleteOld = $this->db->prepare("DELETE FROM role_user WHERE iduser = ?");
        $deleteOld->bind_param("i", $iduser);
        $deleteOld->execute();

        // ✅ Insert role baru
        $insert = $this->db->prepare("INSERT INTO role_user (iduser, idrole, status) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $iduser, $idrole, $status);
        return $insert->execute();
    }
}
?>
