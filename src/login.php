<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);

  $query = "SELECT * FROM member WHERE name = '$username' AND phone_number = '$phone'";
  $result = mysqli_query($mysqli, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Store the user data in the session
    foreach ($row as $key => $value) {
      $_SESSION[$key] = $value;
    }
    // Login successful, start a session and redirect to the home
    header('Location: /');
  } else {
    // Login failed, display an error message
    $error_message = "用戶名稱或是電話號碼錯誤";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>登入</title>
</head>
<body>
  <h1>登入</h1>
  <?php if (isset($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
  <?php endif; ?>
  <form method="post">
    <label for="username">使用者名稱:</label><br>
    <input required type="text" name="username" id="username"><br>
    <label for="phone">電話號碼:</label><br>
    <input required type="phone" name="phone" id="phone"><br><br>
    <input type="submit" value="登入">
  </form>
  <button id="register-button">註冊</button>
</body>
<script>
  document.getElementById("register-button").onclick = function () {
    location.href = "/register"
  }
</script>
</html>
