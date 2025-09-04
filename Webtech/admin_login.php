<?php
session_start();
if (isset($_POST['login'])) {
    $conn = new mysqli("localhost", "root", "", "kebutuhan_kopi");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="card">
        <h2>Login Admin</h2>

        <?php if (!empty($error)): ?>
            <p class="alert error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
