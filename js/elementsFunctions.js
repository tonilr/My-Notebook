function formTask(){
    let checkForm=document.getElementById("taskForm");
    console.log(checkForm);
    if (checkForm == null){
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        let formTask="<form method='POST' action='php/newTask.php' class='newForm' id='taskForm'><label name='taskName'>Task Name<input type='text' name='taskName'></label><input type='submit'><input type='button' value='Cancel' onclick='formTask()'></form>";
        newTask.innerHTML+=formTask;
        newNote.innerHTML="";
        newTask.style.padding="50px";
        newNote.style.padding="0px";
    }else{
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        newNote.innerHTML="";
        newTask.innerHTML="";
        newTask.style.padding="0px";
    }
}
function formNote(){
    let checkForm=document.getElementById("noteForm");
    console.log(checkForm);
    if (checkForm == null){
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formNote="<form method='POST' action='php/newNote.php' class='newForm' id='noteForm'><label name='noteName'>Note Name<input type='text' name='noteName'></label><label name='noteDetails'>Details<input type='text' name='noteDetails'></label><input type='submit'><input type='button' value='Cancel' onclick='formNote()'></form>";
        newNote.innerHTML+=formNote;
        newTask.innerHTML="";
        newNote.style.padding="50px";
        newTask.style.padding="0px";
    }else{
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        newNote.innerHTML="";
        newTask.innerHTML="";
        newNote.style.padding="0px";
    }
}
function deleteNote($id){
    let checkForm=document.getElementById("noteForm");
    if (checkForm == null){
        console.log(false);
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formNote="<form method='POST' action='php/deleteNote.php' class='newForm' id='noteForm'><h3>Delete note?</h3><input type='hidden' name='noteid' value='"+$id+"'><br><input type='submit' value='Delete'><input type='button' value='Cancel' onclick='formNote()'></form>";
        newNote.innerHTML+=formNote;
        newTask.innerHTML="";
        newNote.style.padding="50px";
        newTask.style.padding="0px";
    }else{
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        newNote.innerHTML="";
        newTask.innerHTML="";
        newNote.style.padding="0px";
    }
}