<div id="navbar">
    <div>
        <ul style="list-style-type: none; display: flex;">
        <li><a href="/login">登入</a></li>
        <li><a href="/register">註冊</a></li>
        <li><a href="/ticket">購票</a></li>
        <li><a href="/cart">購物車</a></li>
        </ul>
    </div>
    <div>
    <?php if (isset($_SESSION['name'])) { ?>
        <li>Logged in as: <?php echo $_SESSION['name']; ?></li>
      <?php } ?>
    <a href="/logout">登出</a>
    <div>
</div>

<?php
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['name'])) { ?>
   已登入: <?php echo $_SESSION['name']; ?>
   id: <?php echo $_SESSION['id']; ?>
  <?php }


?>
