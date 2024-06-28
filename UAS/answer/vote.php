<?php
require("../api/functions.php");
vote($_GET['aid'],$_GET['uid'],$_GET['val']);
header("Location: " . $_SERVER["HTTP_REFERER"]);