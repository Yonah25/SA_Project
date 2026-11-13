<?php
session_start();
require 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username=?");
  $stmt->bind_param("s", $_POST['username']);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  if ($row && password_verify($_POST['password'], $row['password_hash'])) {
    $_SESSION['user'] = $_POST['username'];
    header("Location: dashboard.php");
    exit;
  }
  $msg = "Wrong username or password";
}
?>
<h2>Student Portal</h2>
<form method="POST">
  <input name="username" placeholder="Username" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button>Login</button>
</form>
<p><?php echo htmlspecialchars($msg); ?></p>
<a href="signup.php">Create an account</a>
