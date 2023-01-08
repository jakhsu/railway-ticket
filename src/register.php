<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $account = mysqli_real_escape_string($mysqli, $_POST['account']);
  $name = mysqli_real_escape_string($mysqli, $_POST['name']);
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
  $birthday = mysqli_real_escape_string($mysqli, $_POST['birthday']);
  $phone_number = mysqli_real_escape_string($mysqli, $_POST['phone_number']);

  $id = uniqid("$name", true);
  $password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO member (id, account, name, email, password, gender, birthday, phone_number) VALUES ('$id', '$account', '$name', '$email', '$password', '$gender', '$birthday', '$phone_number')";

  $result = mysqli_query($mysqli, $sql);

  if ($result) {
    header('Location: /');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>用戶註冊</title>
</head>
<body>
  <h1>用戶註冊</h1>
  <?php if (isset($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
  <?php endif; ?>
  <form method="POST">
  <label for="account">帳號名稱:</label><br>
  <input required type="text" id="account" name="account"><br>
  <label for="name">名字:</label><br>
  <input required type="text" id="name" name="name"><br>
  <label for="email">Email:</label><br>
  <input required type="text" id="email" name="email"><br>
  <label for="password">密碼:</label><br>
  <input required type="password" id="password" name="password"><br>
  <label for="gender">性別:</label><br>
  <select id="gender" name="gender">
  <option value="1">male</option>
  <option value="2">female</option>
  </select>
  <br><label for="birthday">生日:</label><br>
  <input required type="date" id="birthday" name="birthday"><br>
  <label for="phone_number">電話號碼:</label><br>
  <input required type="text" id="phone_number" name="phone_number"><br><br>
  <input type="submit" value="送出">
</form> 
</body>
</html>
