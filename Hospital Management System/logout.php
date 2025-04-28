<?php
session_start();
session_unset();
session_destroy();
header("Location:http://localhost/Hospital%20Management%20System/index.html"); // or your main homepage
exit();
?>
