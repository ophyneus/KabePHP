<?php
  require("kabe.php");
  $k1 = new Kabe();
  $k1->useURL();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kabe</title>
</head>
<body>
  <?php
    echo $k1->html();
  ?>
</body>
</html>
