<?php
class Database
{
    private $host = "localhost";
    private $db_name = "db_siswa";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8mb4");
        } catch (PDOException $exception) {
            echo "Koneksi Error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

class Siswa
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM siswa ORDER BY nama DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($nis, $nama, $jenis_kelamin, $alamat)
    {
        $query = "INSERT INTO siswa (nis, nama, jenis_kelamin,alamat) VALUES (:nis, :nama, :jenis_kelamin, :alamat)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nis", $nis);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
        $stmt->bindParam(":alamat", $alamat);
        return $stmt->execute();
    }

    public function readOne($id)
    {
        $query = "SELECT * FROM siswa WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function update($id, $nis, $nama, $jenis_kelamin, $alamat)
    {
        $query = "UPDATE siswa SET nis = :nis, nama = :nama, jenis_kelamin = :jenis_kelamin, alamat = :alamat WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nis", $nis);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
        $stmt->bindParam(":alamat", $alamat);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM siswa WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
