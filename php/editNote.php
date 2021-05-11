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
$noteName=filter_var($_POST["name"],FILTER_SANITIZE_STRING);
$noteDetails=filter_var($_POST["details"],FILTER_SANITIZE_STRING);
if (strlen($noteName)<41 and strlen($noteDetails)<501 and $noteName==$_POST["name"] and $noteDetails==$_POST["details"]){
    $sql="UPDATE notes SET name='$noteName',details = '$noteDetails' where (`id`=$noteid AND `id_user`=$userid) ";
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