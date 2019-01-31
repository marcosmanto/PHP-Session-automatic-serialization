<?php
require '../../vendor/autoload.php';
use Kint\Kint;
session_save_path('.');
include_once "Log.php";
session_start();
?>
<html>

<head>
  <title>Next Page</title>
</head>

<body>
  <?php

$now = strftime("%c");
$logger = $_SESSION['logger'];

Kint::dump($logger);

$logger->write("Viewed page 2 at {$now}");
echo "<p>The log contains:";
echo nl2br($logger->read());
echo "</p>";
echo "<p>" . $logger->teste . "</p>";
?>
</body>

</html>