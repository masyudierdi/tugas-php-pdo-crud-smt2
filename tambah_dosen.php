<?php
if (empty($_POST['nidn']) || empty($_POST['nama'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Dosen</title>
    </head>
    <body>
        <h2>Tambah dosen</h2>
        <form method="post" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" maxlength="150" required/>
                </li>
                <li>
                    <label for="nidn">NIDN :</label>
                    <input type="text" name="nidn" maxlength="12" required/>
                </li>
                <li>
                    <label for="gambar">Foto :</label>
                    <input type="file" name="gambar" accept="image/*" />
                </li>
                <li>
                    <button type="submit" name="submit">Tambah dosen</button>
                </li>
            </ul>
        </form>
    </body>
    </html>
    <?php
} else {
    require_once 'koneksi.php';

    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_temp = $_FILES['gambar']['tmp_name'];
    $gambar_path = 'img/'.$gambar;

    move_uploaded_file($gambar_temp, $gambar_path);

    $dosens = $pdo->prepare('INSERT INTO dosen (nidn, nama, gambar) VALUES (?, ?, ?)');
    $dosens->execute([$nidn, $nama, $gambar_path]);

    header('Location: index.php');
}
?>
