<?php
include_once 'db.php';
if (!isset($_SESSION)) {
  session_start();
}

echo "購物車內容" . "<br>\n";

if ($_SESSION['ticket']) {
  // echo implode("", $_SESSION['ticket']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'clear_cart') {
    $_SESSION['ticket'] = [];
    unset($_SESSION['current_order_id']);
    unset($_SESSION['current_order_price']);
    header('Location: /cart');
  } elseif ($_POST['action'] == 'checkout') {
    $queries = implode(";", $_SESSION['ticket']);

    $build_time = date('Y-m-d H:i:s');
    $orderr_id = $_SESSION['current_order_id'];
    $pay_time = $build_time;
    $member_id = $_SESSION['id'];
    $total_price = $_SESSION['current_order_price'];
    $total_ticket = count($_SESSION['ticket']);

    $sql = "INSERT INTO orderr (build_time, orderr_id, pay_time, total_price, total_ticket, member_id)
VALUES ('$build_time', '$orderr_id', '$pay_time', '$total_price', '$total_ticket', '$member_id')";

    $queries .= ";" . $sql;

    if (mysqli_multi_query($mysqli, $queries)) {
      $_SESSION['ticket'] = [];
      unset($_SESSION['current_order_id']);
      unset($_SESSION['current_order_price']);
      header('Location: /cart');
    } else {
      echo "Error: " . $queries . "<br>" . mysqli_error($mysqli);
    }
  } elseif ($_POST['action'] == 'test') {
    echo $_SESSION['current_order_price'];
  }
}

$regex = "/(?<=VALUES\s\()(.*)(?=\))/";

// Loop over the array of ticket queries
foreach ($_SESSION['ticket'] as $query) {
  // Extract the values from the query string
  preg_match($regex, $query, $matches);

  $values = explode(",", $matches[0]);
  // Print the values
  echo "<div class='ticket'>
  <p>訂單號碼: $values[0]</p>
  <p>車票號碼: $values[1]</p>
  <p>列車號碼: $values[2]</p>
  <p>起站: $values[3]</p>
  <p>目標站: $values[4]</p>
  <p>出發時間: $values[5]</p>
  <p>抵達時間: $values[6]</p>
  <p>價錢: $values[7]</p>
  <p>票種: $values[8]</p>
  <p>日期: $values[9]</p>
  <p>乘坐時間: $values[10]</p>
  </div>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>購物車</title>
</head>
<body>
  <h1>購物車</h1>
  <form method="post">
    <input type="hidden" name="action" value="clear_cart">
    <input type="submit" value="清空購物車">
  </form>
  <form method="post">
    <input type="hidden" name="action" value="checkout">
    <input type="submit" value="結帳">
  </form>
  <form method="post">
    <input type="hidden" name="action" value="test">
    <input type="submit" value="看總金額">
  </form>
</body>
<style>
  .ticket {
    box-sizing: border-box;
    border-style: dotted;
    display: flex;
    margin: 10px;
  }
  .ticket > p {
    margin: 5px;
  }
</style>
</html>