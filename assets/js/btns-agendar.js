const btnAgendar = document.querySelector("#enviar");
const btnContinuar = document.querySelector("#btn-continuar");

function mudaBtns()
{
    let inputConvenio = document.querySelector("#convenio-consulta");
    let inputParticular = document.querySelector("#particular-consulta");
    
    if(inputConvenio.checked) 
    {
        btnAgendar.style.display = "flex";
        btnContinuar.style.display = "none";
    }
    inputConvenio.addEventListener("click", () =>
    {
        btnAgendar.style.display = "flex";
        btnContinuar.style.display = "none";
    });

    inputParticular.addEventListener("click", () =>
    {
        btnAgendar.style.display = "none";
        btnContinuar.style.display = "flex";
    }); 
}

mudaBtns();