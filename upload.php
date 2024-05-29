<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $foto_barang = $_FILES['foto_barang']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto_barang);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $valid_extensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $valid_extensions)) {
        if (move_uploaded_file($_FILES['foto_barang']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO barang (nama_barang, harga_barang, foto_barang) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nama_barang, $harga_barang, $target_file]);

            // Redirect ke halaman generate_pdf.php dengan parameter
            header("Location: generate_pdf.php?nama_barang=$nama_barang&harga_barang=$harga_barang&foto_barang=$target_file");
            exit();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Format file tidak didukung.";
    }
} else {
    echo "Invalid request.";
}
?>
