<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "kebutuhan_kopi");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM reservasi WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: admin_dashboard.php");
}
?>
