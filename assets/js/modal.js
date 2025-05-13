const btn_cancelar = document.querySelector("#btn-cancelar");
const modal = document.querySelector(".modal");
const btn_desativar = document.querySelectorAll(".btn-desativar");

function modalAbreFecha()
{
    
    btn_desativar.forEach(btnD => {
        btnD.addEventListener("click", (e) =>
        {
            e.preventDefault();
            modal.style.display = "flex"; 
            console.log("porra");
        });
    });
   

    btn_cancelar.addEventListener("click", () =>
    {
        modal.style.display = "none"; 
    });
}

modalAbreFecha();

function naoAtualiza(e)
{
    e.preventDefault();
}