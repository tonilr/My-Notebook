<?php
session_start();
//Check if the fields are filled
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
//Sanitize the fields
$noteid=$_POST["noteid"];
$name=filter_var($_POST["name"],FILTER_SANITIZE_STRING);
$details=filter_var($_POST["details"],FILTER_SANITIZE_STRING);
//Check if the fields are valid
if (strlen($noteName)<41 and strlen($noteDetails)<501 and $name==$_POST["name"] and $details==$_POST["details"]){
    //Query to update the note in the database
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