<?php

require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $statement = $pdo->prepare('DELETE FROM dosen WHERE id = ?');

    $statement->execute([$id]);

    header('Location: index.php');
    exit;
} else {
    echo 'Data ID tidak ditemukan.';
}
