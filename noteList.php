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
$noteAdded="";
if (isset($_SESSION["noteAdded"]) and $_SESSION["noteAdded"]==1){
    $noteAdded="<p>Note Added</p>";
    unset($_SESSION["noteAdded"]);
}else if (isset($_SESSION["noteAdded"]) and $_SESSION["noteAdded"]==0){
    $noteAdded="<p>Something went wrong adding Note</p>";
    unset($_SESSION["noteAdded"]);
}
if (isset($_SESSION["noteDeleted"]) and $_SESSION["noteDeleted"]==1){
    $noteAdded="<p>Note Deleted</p>";
    unset($_SESSION["noteDeleted"]);
}else if (isset($_SESSION["noteDeleted"]) and $_SESSION["noteDeleted"]==0){
    $noteAdded="<p>Something went wrong deleting note</p>";
    unset($_SESSION["noteDeleted"]);
}
if (isset($_SESSION["noteEdited"]) and $_SESSION["noteEdited"]==1){
    $noteAdded="<p>Note edited</p>";
    unset($_SESSION["noteEdited"]);
}else if (isset($_SESSION["noteEdited"]) and $_SESSION["noteEdited"]==0){
    $noteAdded="<p>Something went wrong editing note</p>";
    unset($_SESSION["noteEdited"]);
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
        <button class="newElement" onclick="formNote()">New note</button>
    </div>
    <div class="createElementMSG"><?php echo $noteAdded ?> </div>
    <section class="userContent">
        <div id="tasks" class="userElements"><?php echo printNotes($userid);?></div>
    </section>
    <section class="createElement">
            <div id="newTask"></div>
            <div id="newNote"></div>
    </section>
</body>
</html>