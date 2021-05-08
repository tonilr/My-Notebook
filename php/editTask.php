<?php
session_start();
if (!isset($_POST["taskid"]) or $_POST["taskid"]=="" or $_POST["todo0"]==""){
    header ("Location: ../taskList.php");
    die();
}
if (!isset($_SESSION["userid"])){
    header ("Location: ../");
    die();
}else{
    $userid=$_SESSION["userid"];
}
include "../db/databaseConnection.php";
$conn=databaseConnection();
$taskid=$_POST["taskid"];
$taskName=filter_var($_POST["taskName"],FILTER_SANITIZE_STRING);
$taskDetails=filter_var($_POST["taskDetails"],FILTER_SANITIZE_STRING);
$taskDate=$_POST["taskDate"];
if (strlen($taskName)<41 and strlen($taskDetails)<101 and $taskName==$_POST["taskName"] and $taskDetails==$_POST["taskDetails"]){
    $m=$_POST["listNum"];
    $todoList=[];
    for($n=0;$n<=$m;$n++){
        array_push($todoList,$_POST["todo$n"]);
    }
    $sql="SELECT id_lists FROM tasks where (`id`=$taskid AND `id_user`=$userid)";
    $index=$conn->query($sql);
    $indexOfList=$index->fetch_assoc();
    $thisList=$indexOfList["id_lists"];
    // echo $thisList;
    $listFile= "../files/$userid/$thisList.txt";
    unlink($listFile);
    $fp = fopen($listFile,"w");
    for ($n=0;$n<=$m;$n++){
        if ($todoList[$n]!=""){
            fwrite($fp,"<li>");
            fwrite($fp,$todoList[$n]);
            fwrite($fp,"</li>");
        }
    }
    $sql="UPDATE tasks SET name='$taskName',details = '$taskDetails',limit_date='$taskDate' where (`id`=$taskid AND `id_user`=$userid) ";
    // $sql="INSERT INTO tasks VALUES(NULL, '$taskName', '$taskDetails', '$thisList','$userid', current_timestamp(),'$taskDate')";
    if ($conn->query($sql)){
        $_SESSION["taskEdited"]=1;
        header ("Location: ../taskList.php");
        die();
    }else{
        $_SESSION["taskEdited"]=0;
        header ("Location: ../taskList.php");
        die();
    }
}else{
    $_SESSION["taskEdited"]=0;
    header ("Location: ../taskList.php");
    die();
}
    ?>