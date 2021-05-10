<?php
session_start();
//Check if the fields are filled
if (!isset($_POST["noteName"]) or $_POST["noteName"]=="" or !isset($_POST["noteDetails"]) or $_POST["noteDetails"]==""){
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
$noteName=filter_var($_POST["noteName"],FILTER_SANITIZE_STRING);
$noteDetails=filter_var($_POST["noteDetails"],FILTER_SANITIZE_STRING);
//Check if the fields are valid
if (strlen($noteName)<41 and strlen($noteDetails)<501 and $noteName==$_POST["noteName"] and $noteDetails==$_POST["noteDetails"]){
    //Query to save the note in the database
    $sql="INSERT INTO notes VALUES(NULL, '$noteName', '$noteDetails', '$userid', current_timestamp())";
    if ($conn->query($sql)){
        $_SESSION["noteAdded"]=1;
        header ("Location: ../noteList.php");
        die();
    }else{
        $_SESSION["noteAdded"]=0;
        header ("Location: ../noteList.php");
        die();
    }
}else{
    $_SESSION["noteAdded"]=0;
    header ("Location: ../noteList.php");
    die();
}

?>