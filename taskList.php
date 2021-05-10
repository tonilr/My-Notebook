<?php
session_start();
//Check if the user has a session started
if (isset($_SESSION["userid"])){
    $userid=$_SESSION["userid"];
}else{
    header ("Location: ../index.php");
    die();
}
include "db/getUserElements.php";
//Some check to show messages
$taskAdded="";
if (isset($_SESSION["taskAdded"]) and $_SESSION["taskAdded"]==1){
    $taskAdded="<p>Task Added</p>";
    unset($_SESSION["taskAdded"]);
}else if (isset($_SESSION["taskAdded"]) and $_SESSION["taskAdded"]==0){
    $taskAdded="<p>Something went wrong adding Task</p>";
    unset($_SESSION["taskAdded"]);
}
if (isset($_SESSION["taskDeleted"]) and $_SESSION["taskDeleted"]==1){
    $taskAdded="<p>Task Deleted</p>";
    unset($_SESSION["taskDeleted"]);
}else if (isset($_SESSION["taskDeleted"]) and $_SESSION["taskDeleted"]==0){
    $taskAdded="<p>Something went wrong deleting Task</p>";
    unset($_SESSION["taskDeleted"]);
}
if (isset($_SESSION["taskEdited"]) and $_SESSION["taskEdited"]==1){
    $taskAdded="<p>Task edited</p>";
    unset($_SESSION["taskEdited"]);
}else if (isset($_SESSION["taskEdited"]) and $_SESSION["taskEdited"]==0){
    $taskAdded="<p>Something went wrong editing Task</p>";
    unset($_SESSION["taskEdited"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/favicon.png" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tasksPanel.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="js/elementsFunctions.js"></script>
    <title>Task List</title>
</head>
<body>
    <?php include "elements/topBar.html";?>
    <div class="tasksContent">
        <button class="newElement" onclick="formTask()">New task</button>
    </div>
    <div class="createElementMSG"><?php echo $taskAdded ?> </div>
    <section class="userContent">
        <div id="tasks" class="userElements"><?php echo printTasks($userid);?></div>
    </section>
    <section class="createElement">
            <div id="newTask"></div>
            <div id="newNote"></div>
    </section>
</body>
</html>