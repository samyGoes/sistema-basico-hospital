function limpa_form()
{
    document.querySelector("#logradouro").value=("");
    document.querySelector("#bairro").value=("");
    document.querySelector("#cidade").value=("");
    document.querySelector("#estado").value=("");
}

function meu_callback(conteudo)
{
    if(!("erro" in conteudo))
    {
        document.querySelector("#nome-logradouro").value=(conteudo.logradouro);
        document.querySelector("#bairro").value=(conteudo.bairro);
        document.querySelector("#cidade").value=(conteudo.cidade);
        document.querySelector("#estado").value=(conteudo.estado);
    }
    else
    {
        alert("CEP não encontrado");
        limpa_form();
    }
}

function pesquisa_cep(valor) 
{
    //Nova variável "cep" somente com dígitos.
    let cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") 
    {
        //Expressão regular para validar o CEP.
        let validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) 
        {
            //Cria um elemento javascript.
            let script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        }
        else
        {
            alert("Formate de CEP inválido");
            limpa_form();
        }
    }
    else { limpa_form(); }

}