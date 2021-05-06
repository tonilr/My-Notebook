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
$name=filter_var($_POST["name"],FILTER_SANITIZE_STRING);
$details=filter_var($_POST["details"],FILTER_SANITIZE_STRING);
if ($name==$_POST["name"] and $details==$_POST["details"]){
    $sql="UPDATE notes SET name='$name',details = '$details' where (`id`=$noteid AND `id_user`=$userid) ";
    if ($conn->query($sql)){
        $_SESSION["noteEdited"]=1;
        header ("Location: ../noteList.php");
        die();
    }else{
        $_SESSION["noteEdited"]=0;
        header ("Location: ../noteList.php");
        die();
    }   
}else{
    $_SESSION["noteEdited"]=0;
    header ("Location: ../noteList.php");
    die();
}
    ?>