<?php
require_once 'koneksi.php';

$dosens = $pdo->query('SELECT * FROM dosen');

$i = 1;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Data dosen</title>
    </head>
    <style>
        table tr th {
            text-align: center;
        }
    </style>
    <body>
        <p><a href="tambah_dosen.php">Tambah dosen baru</a></p>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Nama dosen</th>
                <th>NIDN</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
                <?php
                foreach ($dosens as $dosen) { ?>
            <tr>
                <td style="text-align: center;"><?php echo $i++; ?></td>
                <td><?php echo $dosen['nama']; ?></td>
                <td><?php echo $dosen['nidn']; ?></td>
                <td><img src="<?php echo $dosen['gambar']; ?>" width="50"></td>
                <td style="text-align: center;">
                    <a href="ubah.php?id=<?php echo $dosen['id']; ?>">ubah</a> |
                    <a href="hapus.php?id=<?php echo $dosen['id']; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
