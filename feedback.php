<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?,?,?)");
  $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
  $stmt->execute();
}
$rows = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<h2>Feedback Form</h2>
<form method="POST">
  <input name="name" placeholder="Name" required><br><br>
  <input type="email" name="email" placeholder="Email" required><br><br>
  <textarea name="message" placeholder="Message" required></textarea><br><br>
  <button>Submit</button>
</form>
<h3>Submitted feedback</h3>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Time</th></tr>
  <?php while ($r = $rows->fetch_assoc()) { ?>
  <tr>
    <td><?php echo $r['id']; ?></td>
    <td><?php echo htmlspecialchars($r['name']); ?></td>
    <td><?php echo htmlspecialchars($r['email']); ?></td>
    <td><?php echo htmlspecialchars($r['message']); ?></td>
    <td><?php echo $r['submitted_at']; ?></td>
  </tr>
  <?php } ?>
</table>
