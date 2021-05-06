let todoListIndex=0;
function formTask(){
    let checkForm=document.getElementById("taskForm");
    if (checkForm == null){
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        let formTask="<form method='POST' action='php/newTask.php' class='newForm' id='taskForm'><label for='taskName'>Task Name</label><input type='text' name='taskName'><label for='taskDetails'>Details<input type='text' name='taskDetails'></label><div id='todoList'><label for='list'>Tod-do list<img class='icon' src='img/icons/add.png' onclick='addTodo()'><input type='text' name='tod-do0'</label></div><label name='taskDate'>Date<input type='date' name='taskDate'></label><br><input type='submit'><input type='button' value='Cancel' onclick='formTask()'></form>";
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
        todoListIndex=0;
    }
}
function addTodo(){
    let input=document.createElement("input");
    input.type="text";
    n=todoListIndex+1;
    input.name="to-do"+n;
    todoList.appendChild(input);
    todoListIndex++;
}
function formNote(){
    let checkForm=document.getElementById("noteForm");
    if (checkForm == null){
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formNote="<form method='POST' action='php/newNote.php' class='newForm' id='noteForm'><label for='noteName'>Note Name (Max. 40 characters<input type='text' name='noteName'></label><label for='noteDetails'>Details (Max. 500 characters<input type='text' name='noteDetails'></label><input type='submit'><input type='button' value='Cancel' onclick='formNote()'></form>";
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
function editNote($id,$noteid){
    let note=document.getElementById("note"+$noteid);
    let name=document.getElementById("name-"+$noteid).innerHTML;
    let details=document.getElementById("details-"+$noteid).innerHTML;
    let checkForm=document.getElementById("noteForm");
    if (checkForm == null){
        console.log(false);
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formNote="<form method='POST' action='php/editNote.php' class='newForm' id='noteForm'><h3>Edit note</h3><input type='hidden' name='noteid' value='"+$id+"'><br><label for='name'>Name<input type='text' name='name' value='"+name+"'></label><br><label for='details'>Details<input type='text' name='details' value='"+details+"'></label><input type='submit' value='Edit'><input type='button' value='Cancel' onclick='formNote()'></form>";
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