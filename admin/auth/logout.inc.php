<?php
session_start();
session_unset();
session_destroy();

header("location: /src/login.php");
exit();
