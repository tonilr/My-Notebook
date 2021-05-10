<?php
session_start();
//Check if the fields are filled
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
//Get the id of the task and delete from the database
$taskid=$_POST["taskid"];
$sql="DELETE FROM tasks where (`id`=$taskid AND `id_user`=$userid)";
//Query to get the id of the task
$sqlTask="SELECT id_lists FROM tasks where (`id`=$taskid AND `id_user`=$userid)";
$list=$connList->query($sqlTask);
$id_lists=$list->fetch_assoc();
//save the number of the list where the task is saved
$thisList=$id_lists["id_lists"];
//Delete the file
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