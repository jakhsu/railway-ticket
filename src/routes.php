<?php
$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
  case '/':
    include 'home.php';
    break;
  case '/cart':
    include "cart.php";
    break;
  case '/login':
    include "login.php";
    break;
  case '/register':
    include "register.php";
    break;
  case '/ticket':
    include "ticket.php";
    break;
  case '/logout':
    include "logout.php";
    break;
  default:
    include '404.php';
    break;
}
?>
