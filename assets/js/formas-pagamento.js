const btn_pix = document.querySelector("#pix");
const btn_boleto = document.querySelector("#boleto");
const btn_cartao_cre = document.querySelector("#cartao-credito");
const btn_cartao_deb = document.querySelector("#cartao-debito");

const form_pix = document.querySelector("#form-pix");
const form_boleto = document.querySelector("#form-boleto");
const form_cartao_cre = document.querySelector("#form-cartao-credito");
const form_cartao_deb = document.querySelector("#form-cartao-debito");


function btnPagamento()
{
    btn_pix.addEventListener("click", () =>
    {
        btn_pix.style.backgroundColor = "#f0eaf1";
        btn_boleto.style.backgroundColor = "#fff";
        btn_cartao_cre.style.backgroundColor = "#fff";
        btn_cartao_deb.style.backgroundColor = "#fff";

        form_pix.style.display = "flex";
        form_boleto.style.display = "none";
        form_cartao_cre.style.display = "none";
        form_cartao_deb.style.display = "none";
    });

    btn_boleto.addEventListener("click", () =>
    {
        btn_pix.style.backgroundColor = "#fff";
        btn_boleto.style.backgroundColor = "#f0eaf1";
        btn_cartao_cre.style.backgroundColor = "#fff";
        btn_cartao_deb.style.backgroundColor = "#fff";

        form_pix.style.display = "none";
        form_boleto.style.display = "flex";
        form_cartao_cre.style.display = "none";
        form_cartao_deb.style.display = "none";
    });

    btn_cartao_cre.addEventListener("click", () =>
    {
        btn_pix.style.backgroundColor = "#fff";
        btn_boleto.style.backgroundColor = "#fff";
        btn_cartao_cre.style.backgroundColor = "#f0eaf1";
        btn_cartao_deb.style.backgroundColor = "#fff";

        form_pix.style.display = "none";
        form_boleto.style.display = "none";
        form_cartao_cre.style.display = "flex";
        form_cartao_deb.style.display = "none";
    });

    btn_cartao_deb.addEventListener("click", () =>
    {
        btn_pix.style.backgroundColor = "#fff";
        btn_boleto.style.backgroundColor = "#fff";
        btn_cartao_cre.style.backgroundColor = "#fff";
        btn_cartao_deb.style.backgroundColor = "#f0eaf1";

        form_pix.style.display = "none";
        form_boleto.style.display = "none";
        form_cartao_cre.style.display = "none";
        form_cartao_deb.style.display = "flex";
    });
}

btnPagamento();