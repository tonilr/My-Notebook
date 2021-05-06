<?php
//Check if the user has a session started
if (isset($_SESSION["userid"])){
    $userid=$_SESSION["userid"];
}else{
    header ("Location: ../index.php");
    die();
}
include "db/databaseConnection.php";

function getuserTasks($userid){
    //Get connection details
    $conn=databaseConnection();
    //Set the queries
    $sqlTasks="SELECT * FROM tasks where `id_user`=$userid";
    //Get the user elements from the database
    $tasks=$conn->query($sqlTasks);
    $userTasks=[];
    //Check for tasks
    if($tasks->num_rows>0){
        while ($task = $tasks->fetch_assoc()){
            array_push($userTasks,$task);
        }
        /* echo "<pre>";
        print_r($userTasks);
        echo "</pre>"; */
    }
    return $userTasks;
}
function getuserNotes($userid){
    //Get connection details
    $conn=databaseConnection();
    //Set the queries
    $sqlNotes="SELECT * FROM notes where `id_user`=$userid";
    //Get the user elements from the database
    $notes=$conn->query($sqlNotes);
    //Check for notes
    $userNotes=[];
    if($notes->num_rows>0){
        
        while ($note = $notes->fetch_assoc()){
            array_push($userNotes,$note);
        }
        /* echo "<pre>";
        print_r($userNotes);
        echo "</pre>"; */
    }
    return $userNotes;
}
function printNotes($userid){
    $userNotes=getuserNotes($userid);
    if (count($userNotes)>0){
        for($n=0;$n < count($userNotes);$n++){
            $time=date("d-m-Y",strtotime($userNotes[$n]["creation_time"]));
            echo "<div class='userNote' id='note".$n."'>";
            echo "<h2 id='name-".$n."'>".$userNotes[$n]["name"]."</h2>";
            echo "<p id='details-".$n."'>".$userNotes[$n]["details"]."</p>";
            echo "<h6>Note created: ".$time."</h6>";
            echo "<div class='iconsFlex'>";
            echo "<img class='icon' src='img/icons/edit.png' title='Edit' onclick='editNote(".$userNotes[$n]["id"].",".$n.")'>";
            echo "<img class='icon' src='img/icons/delete.png' title='Delete' onclick='deleteNote(".$userNotes[$n]["id"].")'>";
            echo "</div></div>";
        }
    }
}
function printTasks($userid){
    $userTasks=getuserTasks($userid);
    if (count($userTasks)>0){
        for($n=0;$n < count($userTasks);$n++){
            echo "<p>".$userTasks[$n]["name"]."</p>";
            echo "<p>".$userTasks[$n]["details"]."</p>";
            echo "<p>".$userTasks[$n]["creation_time"]."</p>";
            echo "<p>".$userTasks[$n]["limit_date"]."</p>";
        }
    }
}
?>