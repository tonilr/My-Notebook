<?php
session_start();
if (!isset($_POST["taskName"]) or $_POST["taskName"]=="" or !isset($_POST["taskDetails"]) or $_POST["taskDetails"]=="" or !isset($_POST["taskDate"]) or $_POST["taskDate"]==""){
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
$taskName=filter_var($_POST["taskName"],FILTER_SANITIZE_STRING);
$taskDetails=filter_var($_POST["taskDetails"],FILTER_SANITIZE_STRING);
$taskDate=$_POST["taskDate"];
if (strlen($taskName)<41 and strlen($taskDetails)<101 and $taskName==$_POST["taskName"] and $taskDetails==$_POST["taskDetails"]){
    if ($_POST["todo0"]!=""){
        $m=$_POST["listNum"];
        $todoList=[];
        for($n=0;$n<=$m;$n++){
            array_push($todoList,$_POST["todo$n"]);
        }
        $listIndex="../files/$userid/000index.txt";
        if (file_exists($listIndex)){
            $fpIndex=fopen($listIndex,"r");
            $indexOfList=stream_get_contents($fpIndex);
            $indexOfList++;
            $fpIndex=fopen($listIndex,"w");
            fwrite($fpIndex,$indexOfList);
        }else{
            $fpIndex=fopen($listIndex,"w");
            $indexOfList=0;
            $fpIndex=fopen($listIndex,"w");
            fwrite($fpIndex,$indexOfList);
        }
        $listFile= "../files/$userid/$indexOfList.txt";
        $fp = fopen($listFile,"w");
        for ($n=0;$n<=$m;$n++){
            fwrite($fp,"<li>");
            fwrite($fp,$todoList[$n]);
            fwrite($fp,"</li>");
        }
        $fp = fopen($listFile,"r");
        fclose($fp);
    }
    $sql="INSERT INTO tasks VALUES(NULL, '$taskName', '$taskDetails', '$indexOfList','$userid', current_timestamp(),'$taskDate')";
    if ($conn->query($sql)){
        $_SESSION["taskAdded"]=1;
        header ("Location: ../taskList.php");
        die();
    }else{
        $_SESSION["taskAdded"]=0;
        header ("Location: ../taskList.php");
        die();
    }
}else{
    $_SESSION["taskAdded"]=0;
    header ("Location: ../taskList.php");
    die();
}

?>