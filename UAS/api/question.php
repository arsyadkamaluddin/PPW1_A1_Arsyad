<?php
include "connection.php";
function postQuest($title,$text){
    global $mysql;
    $id = uniqid(6);
    $date = date('Y-m-d H:i:s');
    $userId = $_SESSION["userId"];
    $title = ucwords($title);
    mysqli_query($mysql,"INSERT INTO questions VALUES ('$id','$userId','$title','$text','$date')");
}
function getAllQuestions($page){
    global $mysql;
    $off = ($page-1)*5;
    $result = mysqli_query($mysql,"SELECT * FROM question_data ORDER BY date DESC LIMIT 5 OFFSET $off");
    $allData = [];
    while($ini=mysqli_fetch_assoc($result)){
        $allData[]=$ini;
    }
    return $allData;
}
function getHighQuestions(){
    global $mysql;
    $result = mysqli_query($mysql,"SELECT * FROM question_data ORDER BY date DESC LIMIT 5");
    $allData = [];
    while($ini=mysqli_fetch_assoc($result)){
        $allData[]=$ini;
    }
    return $allData;
}
function getQuestion($qid){
    global $mysql;
    $result = mysqli_query($mysql,"SELECT q.text,q.date,q.quest_id,u.username,q.title FROM questions q JOIN users u ON q.user_id=u.user_id  WHERE q.quest_id='$qid'");
    $allData = [];
    while($ini=mysqli_fetch_assoc($result)){
        $allData[]=$ini;
    }
    return $allData[0];
}
function deleteQuest($qid){
    global $mysql;
    mysqli_query($mysql,"DELETE FROM questions WHERE quest_id='$qid'");
}