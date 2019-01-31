<?php
include_once "Log.php";
require '../../vendor/autoload.php';
use Kint\Kint;
session_save_path('.');
session_start();
//session_unset();
?>
<html>

<head>
  <title>Front Page</title>
</head>

<body>
  <?php
$now = strftime("%c");
if (!isset($_SESSION['logger'])) {
    $logger = new Log("persistent_log");
    Kint::dump($logger);
    $_SESSION['logger'] = $logger;
    $logger->write("Created $now");
    echo("<p>Created session and persistent log object.</p>");
}

$logger = $_SESSION['logger'];
$logger->teste = "**********[TESTE]***********";
Kint::dump($logger);
$logger->write("Viewed first page {$now}");
echo "<p>The log contains:</p>";
echo nl2br($logger->read());
echo "<br>" . session_save_path() . "<br>";
?>
  <a href="next.php">Move to the next page</a>
</body>

</html>