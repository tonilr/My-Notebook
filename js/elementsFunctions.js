let todoListIndex=0;
//Print the form to enter the task
function formTask(){
    let checkForm=document.getElementById("taskForm");
    if (checkForm == null){
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        let formTask="<form method='POST' action='php/newTask.php' class='newForm' id='taskForm'><label for='taskName'>Task Name (Max. 40 characters)</label><input type='text' name='taskName'><label for='taskDetails'>Details (Max. 300 characters)<input type='text' name='taskDetails'></label><div><label for='todoList' id='todoList'>Tod-do list<img class='icon' src='img/icons/add.png' onclick='addTodo()'><input type='hidden' id='listNum' name='listNum' value='0'><input type='text' name='todo0'</label></div><label name='taskDate'>Date<br><input type='date' name='taskDate'></label><br><input type='submit'><input type='button' value='Cancel' onclick='formTask()'></form>";
        newTask.innerHTML+=formTask;
        newNote.innerHTML="";
        newTask.style.padding="50px";
        newNote.style.padding="0px";
        todoListIndex=0;
    }else{
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        newNote.innerHTML="";
        newTask.innerHTML="";
        newTask.style.padding="0px";
        todoListIndex=0;
    }
}
//Adds a new todo field to the task form
function addTodo(){
    let input=document.createElement("input");
    input.type="text";
    todoListIndex++;
    listNum.value++;
    input.name="todo"+todoListIndex;
    todoList.appendChild(input);
}
//Print the form to add a note
function formNote(){
    let checkForm=document.getElementById("noteForm");
    if (checkForm == null){
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formNote="<form method='POST' action='php/newNote.php' class='newForm' id='noteForm'><label for='noteName'>Note Name (Max. 40 characters)<input type='text' name='noteName'></label><label for='noteDetails'>Details (Max. 500 characters)<input type='text' name='noteDetails'></label><input type='submit'><input type='button' value='Cancel' onclick='formNote()'></form>";
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
//Print the form to delete a note
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
//Print the form to edit a note
function editNote($id,$noteNumber){
    let name=document.getElementById("name-"+$noteNumber).innerHTML;
    let details=document.getElementById("details-"+$noteNumber).innerHTML;
    let checkForm=document.getElementById("noteForm");
    if (checkForm == null){
        console.log(false);
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formNote="<form method='POST' action='php/editNote.php' class='newForm' id='noteForm'><h3>Edit note</h3><input type='hidden' name='noteid' value='"+$id+"'><br><label for='name'>Name (Max. 40 characters)<input type='text' name='name' value='"+name+"'></label><br><label for='details'>Details (Max. 500 characters)<input type='text' name='details' value='"+details+"'></label><input type='submit' value='Edit'><input type='button' value='Cancel' onclick='formNote()'></form>";
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
//Print the form to delete a task
function deleteTask($id){
    let checkForm=document.getElementById("taskForm");
    if (checkForm == null){
        console.log(false);
        let newTask=document.getElementById("newTask");
        let newNote=document.getElementById("newNote");
        let formTask="<form method='POST' action='php/deleteTask.php' class='newForm' id='taskForm'><h3>Delete task?</h3><input type='hidden' name='taskid' value='"+$id+"'><br><input type='submit' value='Delete'><input type='button' value='Cancel' onclick='formTask()'></form>";
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
//Print the form to edit a task
function editTask($id,$taskNumber,$listid){
    let name=document.getElementById("name-"+$taskNumber).innerHTML;
    let details=document.getElementById("details-"+$taskNumber).innerHTML;
    let todoList=document.getElementById("list-"+$taskNumber).getElementsByTagName("li");
    let taskList="";
    for (i=0;i<todoList.length;i++){
        taskList+="<input type='text' name='todo"+i+"' value='"+todoList[i].innerHTML+"'>";
    }
    todoListIndex=todoList.length-1;
    let date=document.getElementById("date-"+$taskNumber).getAttribute("value");
    let checkForm=document.getElementById("noteForm");
    if (checkForm == null){
        console.log(false);
        let newNote=document.getElementById("newNote");
        let newTask=document.getElementById("newTask");
        let formTask="<form method='POST' action='php/editTask.php' class='newForm' id='taskForm'><h3>Edit task</h3><input type='hidden' name='taskid' value='"+$id+"'><br><label for='taskName'>Name (Max. 40 characters)<input type='text' name='taskName' value='"+name+"'></label><br><label for='taskDetails'>Details (Max. 300 characters)<input type='text' name='taskDetails' value='"+details+"'></label><input type='hidden' name='listid' value='"+$listid+"'><label for='todoList' id='todoList'>To-do List<img class='icon' src='img/icons/add.png' onclick='addTodo()'><input type='hidden' id='listNum' name='listNum' value='"+(todoList.length-1)+"'>"+taskList+"</label><label for='taskDate'>Limit date<br><input type='date' name='taskDate' value='"+date+"'></label><br><input type='submit' value='Edit'><input type='button' value='Cancel' onclick='formTask()'></form>";
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