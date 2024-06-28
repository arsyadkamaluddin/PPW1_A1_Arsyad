<?php
include "connection.php";
function addUser($data){
    global $mysql;
    $id = uniqid(6);
    $uname = strtolower(str_replace(" ","",$data["nickname"]));
    $email = $data["email"];
    $pass = $data["password"];
    $name = ucwords($data["nickname"]);

    try{
        mysqli_query($mysql,"INSERT INTO users VALUES ('$id','$uname','$name','$email','$pass','','','')");
        return true;
    }catch(Exception $e){
        return false;
    }
}
function login($uname,$pass){
    global $mysql;
    $res = mysqli_query($mysql,"SELECT password FROM users WHERE username='$uname' OR email='$uname'");
    $res = mysqli_fetch_assoc($res)["password"];
    setcookie("nickname",$uname,time()+3600,"/");
    return password_verify($pass,$res);
}
function getId($uname){
    global $mysql;
    $res = mysqli_query($mysql,"SELECT user_id FROM users WHERE username='$uname' OR email='$uname'");
    $res = mysqli_fetch_assoc($res)["user_id"];
    return $res;
}
function getUserName($uid){
    global $mysql;
    $res = mysqli_query($mysql,"SELECT username FROM users WHERE user_id='$uid'");
    $res = mysqli_fetch_assoc($res)["username"];
    return $res;
}
function changePassword($uId,$password){
    global $mysql;
    mysqli_query($mysql,"UPDATE users SET password='$password' WHERE user_id='$uId'");
}
function getAllData($uname){
    global $mysql;
    $userId = getId($uname);
    $res = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT * FROM users WHERE user_id='$userId'"));
    $count = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT COUNT(user_id) AS 'answer' FROM answers WHERE user_id='$userId'"))['answer'];
    $res['answers_count'] = $count;
    $count = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT COUNT(user_id) AS 'quest' FROM questions WHERE user_id='$userId'"))['quest'];
    $res['questions_count'] = $count;
    $count = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT COUNT(user_id) AS 'likes' FROM vote WHERE user_id='$userId' AND vote='1'"))['likes'];
    $res['likes_count'] = $count;
    $count = mysqli_fetch_assoc(mysqli_query($mysql,"SELECT COUNT(user_id) AS 'dislikes' FROM vote WHERE user_id='$userId' AND vote='-1'"))['dislikes'];
    $res['dislikes_count'] = $count;
    
    return $res;
}
function updateUser($uid,$data){
    global $mysql;
    $uname = $data["username"];
    $name = $data["nama"];
    $bio = $data["bio"];
    $avatar = $data["avatar"];
    $email = $data["email"];
    $query = "";
    if($data["avatar"]==""){
        $query = "UPDATE users SET username='$uname',email='$email',name='$name',bio='$bio' WHERE user_id='$uid'";
    }else{
        $query = "UPDATE users SET username='$uname',email='$email',name='$name',bio='$bio',avatar='$avatar' WHERE user_id='$uid'";
    }
    try{
        mysqli_query($mysql,$query);
        return true;
    }catch(Exception $e){
        return false;
    }
}

function follow($userId){
    global $mysql;
    $from = getId($_COOKIE["username"]);
    $query = "INSERT INTO following (target_id,source_id) VALUES ('$userId','$from')";
    try{
        
        mysqli_query($mysql,$query);    
    }catch(Exception $e){
        $query = "DELETE FROM following WHERE target_id='$userId' AND source_id ='$from'";
        mysqli_query($mysql,$query);    
    }
}
function getFollower($userId){
    global $mysql;
    $allData = [];
    $query = "SELECT source_id FROM following WHERE target_id='$userId'";
    $res = mysqli_query($mysql,$query);
    while($row=mysqli_fetch_row($res)){
        $allData[]=$row[0];
    }
    return $allData;
}
function getFollowed($userId){
    global $mysql;
    $allData = [];
    $query = "SELECT target_id FROM following WHERE source_id='$userId'";
    $res = mysqli_query($mysql,$query);
    while($row=mysqli_fetch_row($res)){
        $allData[]=$row[0];
    }
    return $allData;
}

function getAnswersBy($userId){
    global $mysql;
    $allData = [];
    $query = "SELECT q.title,a.text,q.quest_id FROM answers a JOIN questions q ON q.quest_id=a.quest_id WHERE a.user_id='$userId'";
    $res = mysqli_query($mysql,$query);
    while($row=mysqli_fetch_assoc($res)){
        $allData[]=$row;
    }
    return $allData;
}
function getQuestionsBy($userId){
    global $mysql;
    $allData = [];
    $query = "SELECT title,text,quest_id FROM questions WHERE user_id='$userId'";
    $res = mysqli_query($mysql,$query);
    while($row=mysqli_fetch_assoc($res)){
        $allData[]=$row;
    }
    return $allData;
}