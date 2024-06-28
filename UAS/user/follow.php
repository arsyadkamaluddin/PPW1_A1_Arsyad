<?php
include_once "../api/user.php";
follow($_GET["id"]);
header("Location: " . $_SERVER["HTTP_REFERER"]);