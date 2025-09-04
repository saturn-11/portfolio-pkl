<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body class="admin-dashboard-body">
    <div class="dashboard-card">
        <h2>Selamat datang, <?php echo $_SESSION['admin_username']; ?>!</h2>
        <a href="admin_logout.php" class="logout">Logout</a>
        <hr style="clear: both; margin-bottom: 1rem;">

        <h3>Daftar Reservasi</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "kebutuhan_kopi");
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM reservasi ORDER BY tanggal DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['tanggal']."</td>";
                    echo "<td>".$row['catatan']."</td>";
                    echo "<td>
                            <a href='admin_delete.php?id=".$row['id']."' 
                               onclick='return confirm(\"Yakin mau hapus?\");'>
                               Hapus
                            </a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada reservasi.</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
