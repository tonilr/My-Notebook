<?php
session_start();
//Check if there's no session initilized
if (!isset($_SESSION["userid"])){
    header ("Location: index.php");
    die();
}else{
    $userid=$_SESSION["userid"];
}
$noteAdded="";
if (isset($_SESSION["noteAdded"]) and $_SESSION["noteAdded"]==1){
    $noteAdded="<p>Note Added</p>";
    unset($_SESSION["noteAdded"]);
}else if (isset($_SESSION["noteAdded"]) and $_SESSION["noteAdded"]==0){
    $noteAdded="<p>Something went wrong adding Note</p>";
    unset($_SESSION["noteAdded"]);
}
// include "db/getUserElements.php";
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
    <aside class="lateralPanel">
        <a href="taskList.php">My tasks</a>
        <a href="noteList.php">My notes</a>
        <a href="userPanel.php">My profile</a>
        <a href="db/logout.php">Logout</a>
    </aside>
    <section class="userContent">
        <div class="tasksContent">
            <button class="newElement" onclick="formTask()">New task</button>
            <button class="newElement" onclick="formNote()">New note</button>
        </div>
        <div id="notes"></div>
        <div id="tasks"></div>
    </section>
    <div class="createElementMSG"><?php echo $noteAdded ?> </div>
    <section class="createElement">
            <div id="newTask"></div>
            <div id="newNote"></div>
    </section>
</body>
</html>