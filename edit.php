<?php

include "model.php";
$database = new Database();
$db = $database->getConnection();
$siswa = new Siswa($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $siswa->readOne($id);
    if ($stmt) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nis = $row['nis'];
        $nama = $row['nama'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $alamat = $row['alamat'];

        if (isset($_POST['edit'])) {
            $nis = $_POST['nis'];
            $nama = $_POST['nama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];
            if ($siswa->update($id, $nis, $nama, $jenis_kelamin, $alamat)) {
                header("Location: index.php");
                exit;
            } else {
                echo "Gagal menyimpan ke database.";
            }
        }
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
</head>

<body>
    <div class="container p-5">
        <h1 class="">Edit Siswa</h1>
        <form action="" method="post" class="mt-3">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan nis" value="<?php echo $nis; ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?php echo $nama; ?>">
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                    <option <?php if ($jenis_kelamin == 'laki-laki') echo 'selected'; ?> value="laki-laki">Laki-laki</option>
                    <option <?php if ($jenis_kelamin == 'perempuan') echo 'selected'; ?> value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat"><?= $alamat ?></textarea>
            </div>
            <button type="submit" name="edit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
</body>

</html>