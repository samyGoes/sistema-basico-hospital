<?php

require_once("Conexao.php");
require_once("Especialidade.php");

class Medico extends Pessoa{

    private $id;
    private $matricula;
    private $crm;
    private $dataAdmissao;
    private $dataDemissao;
    private $especialidade;

    public function __construct(){
        new Pessoa();
        $especialidade = new Especialidade();
    }

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function setCrm($crm)
    {
        $this->crm = $crm;
    }

    public function setDataAdmissao($dataAdmissao)
    {
        $this->dataAdmissao = $dataAdmissao;
    }

    public function setDataDemissao($dataDemissao)
    {
        $this->dataDemissao = $dataDemissao;
    }

    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function getCrm()
    {
        return $this->crm;
    }

    public function getDataAdmissao()
    {
        return $this->dataAdmissao;
    }

    public function getDataDemissao()
    {
        return $this->dataDemissao;
    }

    public function getEspecialidade()
    {
        return $this->especialidade;
    }


    // OUTRAS FUNÇÕES
    public function cadastrar()
    {
        $conexao = Conexao::conexao();

        // CADASTRA APENAS SE O CPF FOR VÁLIDO
        if(parent::validaCpf(parent::getCpf()) == true)
        {
            // CADASTRANDO DADOS NA TABELA PESSOA
            $queryInsertPessoa = $conexao->prepare(
                "INSERT INTO tb_pessoa(nome_pessoa, rg_pessoa, cpf_pessoa, sexo_pessoa, 
                                       genero_pessoa, data_nasc_pessoa, logradouro_pessoa, 
                                       num_log_pessoa, cep_pessoa, bairro_pessoa, cidade_pessoa,
                                       estado_pessoa, email_pessoa, senha_pessoa, nome_convenio_pessoa,
                                       numero_convenio_pessoa) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            
            $queryInsertPessoa->bindValue(1, parent::getNome());
            $queryInsertPessoa->bindValue(2, parent::getCpf());
            $queryInsertPessoa->execute();


            // PUXANDO O ID DO ÚLTIMO REGISTRO DE PESSOA E ATRIBUINDO AO ATRIBUTO ID
            $querySelect = $conexao->query(
                "SELECT LAST_INSERT_ID() FROM tb_pessoa"
            );
            $ultimoID = $querySelect->fetchColumn();
            //print_r($ultimoID);
            parent::setId($ultimoID);
            

            // CADASTRANDO DADOS NA TABELA MÉDICO
            $queryInsertMedico = $conexao->prepare(
                "INSERT INTO tb_medico(crm_medico, id_pessoa, id_especialidade) VALUES (?, ?, ?)"
            );
            $queryInsertMedico->bindValue(1, $this->getCrm());
            $queryInsertMedico->bindValue(2, parent::getId());
            $queryInsertMedico->bindValue(3, $this->getEspecialidade()->getId());
            $queryInsertMedico->execute();

            // CADASTRANDO TELEFONE
            $queryInsertTelefone = $conexao->prepare(
                "INSERT INTO tb_telefone(num_telefone, id_pessoa) VALUES (?, ?)"
            );
            $queryInsertTelefone->bindValue(1, parent::getTelefone1());
            $queryInsertTelefone->bindValue(2, parent::getId());
            $queryInsertTelefone->execute();

            // CADASTRANDO TELEFONE OPCIONAL
            $telefoneOpcional = parent::getTelefone2();
            if($telefoneOpcional != "")
            {
                $queryInsertTelefone2 = $conexao->prepare(
                    "INSERT INTO tb_telefone(num_telefone, id_pessoa) VALUES (?, ?)"
                );
                $queryInsertTelefone2->bindValue(1, parent::getTelefone2());
                $queryInsertTelefone2->bindValue(2, parent::getId());
                $queryInsertTelefone2->execute();
            }

            echo("<script> alert('Cadastro feito com sucesso'); </script>");
            return true;
        }

        echo("<script> alert('Erro ao cadastrar'); </script>");
        return false;
    }

}

?>