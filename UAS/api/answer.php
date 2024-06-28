<?php
include "connection.php";
function getAnswers($qid){
    global $mysql;
    $result = mysqli_query($mysql,"SELECT a.text,u.username,u.avatar,a.date,a.answer_id,a.likes,a.dislikes FROM answer_data a JOIN users u ON a.user_id=u.user_id WHERE a.quest_id='$qid' ORDER BY a.date DESC");
    $allData = [];
    while($ini=mysqli_fetch_assoc($result)){
        $allData[]=$ini;
    }
    return $allData;
}
function getAllAnswers(){
    global $mysql;
    $result = mysqli_query($mysql,"SELECT * FROM answers ORDER BY date DESC LIMIT 5");
    $allData = [];
    while($ini=mysqli_fetch_assoc($result)){
        $allData[]=$ini;
    }
    return $allData;
}
function postAnswer($text,$qid){
    global $mysql;
    $id = uniqid(6);
    $date = date('Y-m-d H:i:s');
    $userId = $_SESSION["userId"];
    mysqli_query($mysql,"INSERT INTO answers VALUES ('$id','$qid','$userId','$text','$date')");
    vote($id,$userId,0);
}
function deleteAnswer($aid){
    global $mysql;
    mysqli_query($mysql,"DELETE FROM answers WHERE answer_id='$aid'");
}
function vote($aid,$userId,$val){
    global $mysql;
    mysqli_query($mysql,"CALL upsert_vote('$userId', '$aid', '$val')");
}
function getVote($uid,$aid){
    global $mysql;
    $res = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT vote FROM vote WHERE user_id='$uid' AND answer_id='$aid'"));
    if($res==NULL)return 0;
    return (int)$res["vote"];
}