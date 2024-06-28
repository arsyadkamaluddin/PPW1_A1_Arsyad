<?php
session_start();
require("../api/functions.php");
$qid=$_POST["qid"];
postAnswer($_POST['answer'],$qid);
header("Location: ./?qid=$qid");