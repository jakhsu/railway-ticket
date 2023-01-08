<!DOCTYPE html>
<html>
<head>
<head>
</head>
<body>

<header>
    <?php include 'header.php';
/**
     * say you wanted a different header for shop
     * if($_GET['page'] === 'shop') {
     *      include 'header-shop.php';
     * } else {
     *      include 'header.php';
     *}         
     */
?>
</header>
<div id="main">
    <?php include 'routes.php'; ?>
</div>
</body>
<style>
    #navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1;
  background-color: white;
  color: black;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
}

#main {
  margin-top: 50px;
}

ul > li {
    margin: 10px;
}
</style>
</html>
