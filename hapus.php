<?php
include 'model.php';
$database = new Database();
$db = $database->getConnection();
$siswa = new Siswa($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($siswa->delete($id)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menghapus data dari database.";
    }
} else {
    header("Location: index.php");
    exit;
}
