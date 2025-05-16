const modal = document.querySelector(".modal-fundo");

function abreModal(event, valor)
{   
    console.log(valor);
    event.preventDefault();
    modal.style.display = "flex";
    document.querySelector("#id-medico-desativar").value=(valor);
 
}

function fechaModal()
{
    modal.style.display = "none"; 
}
