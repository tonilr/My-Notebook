<?php
session_start();
if (!isset($_POST["noteid"]) or $_POST["noteid"]==""){
    header ("Location: ../noteList.php");
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
$noteid=$_POST["noteid"];

$sql="DELETE FROM notes where (`id`=$noteid AND `id_user`=$userid)";
if ($conn->query($sql)){
    $_SESSION["noteDeleted"]=1;
    header ("Location: ../noteList.php");
    die();
}else{
    $_SESSION["noteDeleted"]=0;
    header ("Location: ../noteList.php");
    die();
}

?>