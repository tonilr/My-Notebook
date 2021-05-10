<?php
session_start();
//Check if the user has filled the fields
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
//Sanitize the fields
$taskName=filter_var($_POST["taskName"],FILTER_SANITIZE_STRING);
$taskDetails=filter_var($_POST["taskDetails"],FILTER_SANITIZE_STRING);
$taskDate=$_POST["taskDate"];
//Check if the fields are valid
if (strlen($taskName)<41 and strlen($taskDetails)<101 and $taskName==$_POST["taskName"] and $taskDetails==$_POST["taskDetails"]){
    //If the to-do list is not blank
    if ($_POST["todo0"]!=""){
        //Save the number of the list
        $m=$_POST["listNum"];
        //Save the content of the list
        $todoList=[];
        for($n=0;$n<=$m;$n++){
            array_push($todoList,$_POST["todo$n"]);
        }
        //Check if the user has a folder for the lists
        if (!is_dir("../files/$userid")){
            mkdir("../files/$userid");
        }
        //Check the index of the next file list
        $listIndex="../files/$userid/000index.txt";
        //If the file exists
        if (file_exists($listIndex)){
            //Get the number of the list and incrase it's number
            $fpIndex=fopen($listIndex,"r");
            $indexOfList=stream_get_contents($fpIndex);
            $indexOfList++;
            $fpIndex=fopen($listIndex,"w");
            fwrite($fpIndex,$indexOfList);
            //If the file doesn't exists, create it
        }else{
            $fpIndex=fopen($listIndex,"w");
            $indexOfList=0;
            $fpIndex=fopen($listIndex,"w");
            fwrite($fpIndex,$indexOfList);
        }
        //Get the actual number of the list file
        $listFile= "../files/$userid/$indexOfList.txt";
        //Open the file and write the content of the list
        $fp = fopen($listFile,"w");
        for ($n=0;$n<=$m;$n++){
            if ($todoList[$n]!=""){
                fwrite($fp,"<li>");
                fwrite($fp,$todoList[$n]);
                fwrite($fp,"</li>");
            }
        }
        fclose($fp);
    }
    //Query to save the task in the database
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