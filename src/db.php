<?php
ini_set('display_errors', 0);

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$hostname = $_ENV['HOST'];
$dbName = $_ENV['DATABASE'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$ssl = $_ENV['MYSQL_ATTR_SSL_CA'];

// Set SSL cert and open connection to the MySQL E$_ENV
$mysqli = mysqli_init();
$mysqli->ssl_set(null, null, $ssl, null, null);
$mysqli->real_connect(
  $_ENV["HOST"],
  $_ENV["USERNAME"],
  $_ENV["PASSWORD"],
  $_ENV["DATABASE"]
);

if ($mysqli->connect_error) {
  echo $mysqli->connect_error;
  die();
} else {
}
