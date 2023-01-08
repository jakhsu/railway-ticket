<?php

if (!isset($_SESSION)) {
  session_start();
}

echo "this is home";

echo "Username: " . $_SESSION['name'];
echo "Phone: " . $_SESSION['phone_number'];
echo "birthday: " . $_SESSION['birthday'];
