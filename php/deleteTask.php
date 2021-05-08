<?php
session_start();
if (!isset($_POST["taskid"]) or $_POST["taskid"]==""){
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
$connTask=databaseConnection();
$connList=databaseConnection();
$taskid=$_POST["taskid"];
$sql="DELETE FROM tasks where (`id`=$taskid AND `id_user`=$userid)";
$sqlTask="SELECT id_lists FROM tasks where (`id`=$taskid AND `id_user`=$userid)";
$list=$connList->query($sqlTask);
$id_lists=$list->fetch_assoc();
$thisList=$id_lists["id_lists"];
unlink("../files/$userid/$thisList.txt");

if ($connTask->query($sql)){
        $_SESSION["taskDeleted"]=1;
        header ("Location: ../taskList.php");
        die();
    }else{
            $_SESSION["taskDeleted"]=0;
    header ("Location: ../taskList.php");
    die();
}

?>