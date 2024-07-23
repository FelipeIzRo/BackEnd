// Pon a prueba tus conocimientos sobre JavaScript aqui

const inputText = document.querySelector('#taskInput');
const botonInput = document.querySelector('#addTaskButton');
const taskList = document.querySelector('#taskList');

let ListaTareas = [];

botonInput.addEventListener('click',addNota);

function addNota(){   
    
    let Tarea = crearTareas(inputText.value);
    ListaTareas.push(Tarea);
    taskList.append(PatronDeTarea(inputText.value,Tarea.id));
    inputText.value='';
    
    console.log(ListaTareas.length);
    
    ListaTareasConsola();
}

function PatronDeTarea(textoNota,id){

    let modeloTarea = document.createElement('li');
    let article = document.createElement('article');
    
    let inputCheckBox = document.createElement('input');
    let span = document.createElement('span');
    let trash = document.createElement('i');    

    inputCheckBox.type = 'checkbox';
    span.innerHTML = textoNota;
    
    inputCheckBox.classList.add('task-checkbox');
    span.classList.add('task-text');
    trash.classList.add('fa','fa-trash');
    

    modeloTarea.append(article);
    article.append(inputCheckBox);    
    article.append(span);
    modeloTarea.append(trash);

    trash.addEventListener('click',() => {
        modeloTarea.remove();
        ListaTareas = ListaTareas.filter(Tarea => Tarea.id !== id);
        ListaTareasConsola(); 
    });
    inputCheckBox.addEventListener('change', function(event) {        
        for(let i = 0;i<ListaTareas.length;i++){
            if(ListaTareas[i].id === id){                
                ListaTareas[i].completada =  event.target.checked;         
            }            
        }
        ListaTareasConsola();       
    });

    return modeloTarea;
}

function crearTareas(textoNota){
    let id;
    if(ListaTareas.length > 0){
        let ultimoId = parseInt(ListaTareas[ListaTareas.length-1].id.split('-')[1])
        id = 'task-' + (ultimoId+1);
    }else{
        id = 'task-' + 1;
    }

    let nombre = textoNota;
    let completada = false;    

    let Tarea = {
        'id':id,
        'nombre':nombre,
        'completada':completada
    }
    return Tarea;
    //console.log(id);
}

function ListaTareasConsola(){
    console.clear();
    ListaTareas.forEach((Tarea) =>{
        
        console.log(Tarea.id);
        console.log(Tarea.nombre);
        console.log(Tarea.completada);
    });
}