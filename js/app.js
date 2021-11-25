"use strict"

const car = document.querySelector("#list");
let form = document.querySelector(".form-comment").addEventListener('submit', enviarDatos);

const API_URL = `http://localhost/proyectos/web2/TPE_Especial/TPEweb2/api/comments`;

async function getComments()
{
    try{
        let id_car = car.getAttribute('id-car');
        console.log(id_car);
        let response = await fetch(`${API_URL}/car/${id_car}`);
        let comments = await response.json();

        render(comments);
    } catch(e){
        console.log(e);
    }
}

getComments();

function render(comments)
{
    let lista = document.querySelector(".list-comments");
    lista.innerHTML = "";

    let admin = car.getAttribute('admin');
    console.log(admin);

    for (const comment of comments) {
       
        let id = comment.id_comment;
        let score = parseInt(comment.score, 10);

        let html = `<li id="${id}"> ${comment.email} ha comentado: ${comment.email} <br> 
                                    ${comment.email} ha calificado esta pelicula con una puntuacion de: ${score}
                    </li>`;

        if (admin == 1) {
            html += `<button data-id="${comment.id_comment}" class="delete" type="submit">delete</button>`;
        }

        lista.innerHTML += html;
       
    }

   
    if(admin == 1){
        document.querySelectorAll(".delete").forEach(o=>o.addEventListener("click", function () {
            console.log(this.dataset.id)
            deleteComment(this.dataset.id);
        }));
        console.log(comments);
    }else{

    }

}

async function enviarDatos(e){
    e.preventDefault();

    let id_user = car.getAttribute('id-user');

    let commentForm = document.querySelector("#comment").value;
    let scoreForm = document.querySelector("#score").value;
    let id_car = car.getAttribute('id-car');
   
    let comment = { 
        comment: commentForm,
        fk_car: id_car,
        fk_user: id_user, 
        score: scoreForm,  
    }

    try{
        let response = await fetch(API_URL, {
            'method': 'POST',
            'headers': {'Content-Type': 'application/json'},
            'body': JSON.stringify(comment)
        }
        );
        if(response.status === 200){
            console.log("Funciona");
            getComments();
        }
        else{
            console.log(response);
        }
    }
    catch(error){  
        console.log(error);
    }

}

async function deleteComment(data){
    console.log(data);
    
    try{
        let response = await fetch(`${API_URL}/${data}`, {
            'method': 'DELETE',
            'headers': {'Content-Type': 'application/json'}
        });
        if(response.status === 200){
            console.log("Funciona eliminar comment");
            getComments();
        }
        else{   
            console.log(response);
        }
    }
    catch(error){
        console.log(error);
    }
}




