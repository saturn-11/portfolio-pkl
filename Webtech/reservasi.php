<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "kebutuhan_kopi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $catatan = $_POST['catatan'] ?? '';

    if ($nama && $email && $tanggal) {
        $stmt = $conn->prepare("INSERT INTO reservasi (nama, email, tanggal, catatan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $tanggal, $catatan);

        if ($stmt->execute()) {
            echo "<script>alert('Reservasi berhasil!'); window.location.href='index.html';</script>";
        } else {
            echo "Query error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Field tidak lengkap.";
    }
}

$conn->close();
?>
