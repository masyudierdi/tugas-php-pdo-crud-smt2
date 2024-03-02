<?php
require_once 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    header('Location: error.php');
    exit;
}

$dosens = $pdo->prepare('SELECT * FROM dosen WHERE id = ?');
$dosens->execute([$id]);
$dosens = $dosens->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];

    $gambar_path = $dosens['gambar'];
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $gambar_temp = $_FILES['gambar']['tmp_name'];
        $gambar_path = 'img/'.$gambar;

        move_uploaded_file($gambar_temp, $gambar_path);
    }

    $updateStatement = $pdo->prepare('UPDATE dosen SET nama = ?, nidn = ?, gambar = ? WHERE id = ?');
    $updateStatement->execute([$nama, $nidn, $gambar_path, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
</head>
<body>
    <h1>Ubah Data Dosen</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p>ID dosen yang diubah = <?php echo $id; ?></p>
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" maxlength="150" required value="<?php echo htmlspecialchars($dosens['nama']); ?>"/>
            </li>
            <li>
                <label for="nidn">NIDN :</label>
                <input type="text" name="nidn" id="nidn" maxlength="12" required value="<?php echo htmlspecialchars($dosens['nidn']); ?>"/>
            </li>
            <li>
                <label for="gambar">Foto :</label><br>
                <input type="file" name="gambar" id="gambar" />
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>
