<?php
require 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (username, email, full_name, password_hash) VALUES (?,?,?,?)");
  $stmt->bind_param("ssss", $_POST['username'], $_POST['email'], $_POST['full_name'], $hash);
  if ($stmt->execute()) { $msg = "Registered successfully!"; } else { $msg = "Error: username may already exist."; }
}
?>
<h2>Sign Up</h2>
<form method="POST">
  <input name="full_name" placeholder="Full name" required><br><br>
  <input name="username" placeholder="Username" required><br><br>
  <input type="email" name="email" placeholder="Email" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button>Sign up</button>
</form>
<p><?php echo htmlspecialchars($msg); ?></p>
<a href="login.php">Go to login</a>
