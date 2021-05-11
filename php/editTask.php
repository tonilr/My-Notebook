<?php
session_start();
//Check if the fields are filled
if (!isset($_POST["taskid"]) or $_POST["taskid"]=="" or $_POST["taskName"]=="" or $_POST["taskDetails"]==""){
    header ("Location: ../taskList.php");
    die();
}
if (!isset($_SESSION["userid"])){
    header ("Location: ../");
    die();
}else{
    $userid=$_SESSION["userid"];
}
/* echo "<pre>";
print_r ($_POST);
echo "</pre>";
 */
include "../db/databaseConnection.php";
$conn=databaseConnection();
//Sanitize the fields
$taskid=$_POST["taskid"];
$taskName=filter_var($_POST["taskName"],FILTER_SANITIZE_STRING);
$taskDetails=filter_var($_POST["taskDetails"],FILTER_SANITIZE_STRING);
$taskDate=$_POST["taskDate"];
//Check if the fields are filled
if (strlen($taskName)<41 and strlen($taskDetails)<101 and $taskName==$_POST["taskName"] and $taskDetails==$_POST["taskDetails"]){
    //Save the number of the list
    $m=$_POST["listNum"];
    $todoList=[];
    for($n=0;$n<=$m;$n++){
        array_push($todoList,$_POST["todo$n"]);
    }
    //Query to get the id of the list
    $sql="SELECT id_lists FROM tasks where (`id`=$taskid AND `id_user`=$userid)";
    $index=$conn->query($sql);
    $indexOfList=$index->fetch_assoc();
    $thisList=$indexOfList["id_lists"];
    //Save the number of the list of the selected task
    $listFile= "../files/$userid/$thisList.txt";
    unlink($listFile);
    //Open the file and save the content of the list that the user has sended
    $fp = fopen($listFile,"w");
    for ($n=0;$n<=$m;$n++){
        if ($todoList[$n]!=""){
            fwrite($fp,"<li>");
            fwrite($fp,$todoList[$n]);
            fwrite($fp,"</li>");
        }
    }
    //Query to update the tasks in the database
    $sql="UPDATE tasks SET name='$taskName',details = '$taskDetails',limit_date='$taskDate' where (`id`=$taskid AND `id_user`=$userid) ";
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