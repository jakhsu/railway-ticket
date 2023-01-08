<?php
include_once 'db.php';
if (!isset($_SESSION)) {
  session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = date('Y-m-d H:i:s');

  $start_point = mysqli_real_escape_string($mysqli, $_POST['start_point']);
  $end_point = mysqli_real_escape_string($mysqli, $_POST['end_point']);
  $start_hour = mysqli_real_escape_string($mysqli, $_POST['start_hour']);
  $end_hour = mysqli_real_escape_string($mysqli, $_POST['end_hour']);
  $price = 200 * ($end_hour - $start_hour);

  $sql = "SELECT * FROM rail WHERE start_point = '$start_point' AND end_point = '$end_point' AND start_hour = '$start_hour' AND end_hour = '$end_hour'";
  $result = mysqli_query($mysqli, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $type = $row["rail_type"];
      $rail_id = $row['rail_id'];
    }
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
  }

  $ticket_id = uniqid("", true);

  if (!$_SESSION['current_order_id']) {
    $order_id = uniqid();
    $_SESSION['current_order_id'] = $order_id;
  }
  $order_id = $_SESSION['current_order_id'];

  $total_time = $end_hour - $start_hour;

  $query = "INSERT INTO ticket (orderr_id, ticket_id, rail_id, start_point, end_point, start_hour, end_hour, price, type, date, total_time)
            VALUES ('$order_id','$ticket_id', '$rail_id', '$start_point', '$end_point', '$start_hour', '$end_hour', '$price', '$type', '$date', '$total_time')";

  if (!$_SESSION['ticket']) {
    $_SESSION['ticket'] = [];
  }

  $_SESSION['current_order_price'] += $price;

  array_push($_SESSION['ticket'], $query);
  header('Location: /cart');
}
?>

<html>
<head>
    <title>車票訂單</title>
</head>
<body>
    <h1>車票訂單</h1>
    <form method="post"?>
        <label for="start_point">出發站:</label>
        <select id="start_point" name="start_point">
          <option value="台北">台北</option>
          <option value="高雄">高雄</option>
          <option value="台東">台東</option>
        </select>
        <label for="end_point">抵達站:</label>
        <select id="end_point" name="end_point">
          <option value="高雄">高雄</option>
          <option value="台東">台東</option>
          <option value="台北">台北</option>
        </select><br>
        <label for="start_hour">出發時間:</label><br>
        <select id="start_hour" name="start_hour">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
        </select><br>

        <label for="end_hour">抵達時間:</label><br>
        <select id="end_hour" name="end_hour">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
        </select><br>
                <input type="submit" value="加入購物車">
    </form>
