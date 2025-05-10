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
     
        // VERIFICANDO SE O CPF JÁ NÃO ESTÁ CADASTRADO
        $querySelectCpf = $conexao->prepare(
            "SELECT cpf_pessoa * FROM tb_pessoa"
        );
        $lista = $querySelectCpf->fetchAll();
        $cpfJaCadastrado = false;

        foreach($lista as $l)
        {
            if($l["cpf_pessoa"] == parent::getCpf())
            {
                $cpfJaCadastrado = true;
                echo("cade: " . $cpfJaCadastrado);
                echo("<script> alert('CPF já cadastrado no sistema.'); </script>");
                break;             
            }
        }

        // CADASTRA APENAS SE O CPF FOR VÁLIDO
        if(parent::validaCpf(parent::getCpf()) == true)
        {
            #region CADASTRANDO DADOS NA TABELA PESSOA
            $queryInsertPessoa = $conexao->prepare(
                "INSERT INTO tb_pessoa(nome_pessoa, rg_pessoa, cpf_pessoa, sexo_pessoa, 
                                       genero_pessoa, data_nasc_pessoa, logradouro_pessoa, 
                                       num_log_pessoa, cep_pessoa, bairro_pessoa, cidade_pessoa,
                                       estado_pessoa, email_pessoa, senha_pessoa, nome_convenio_pessoa,
                                       numero_convenio_pessoa) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            // $queryInsertPessoa = $conexao->prepare(
            //     "INSERT INTO tb_pessoa(nome_pessoa, cpf_pessoa, data_nasc_pessoa, logradouro_pessoa, 
            //                            cep_pessoa) 
            //     VALUES (?, ?, ?, ?, ?)"
            // );
            
            $queryInsertPessoa->bindValue(1, parent::getNome());
            $queryInsertPessoa->bindValue(2, parent::getRg());
            $queryInsertPessoa->bindValue(3, parent::getCpf());
            $queryInsertPessoa->bindValue(4, parent::getSexo());
            $queryInsertPessoa->bindValue(5, parent::getGenero());
            $queryInsertPessoa->bindValue(6, parent::getDataNasc());
            $queryInsertPessoa->bindValue(7, parent::getLogradouro());
            $queryInsertPessoa->bindValue(8, parent::getNumLog());
            $queryInsertPessoa->bindValue(9, parent::getCep());
            $queryInsertPessoa->bindValue(10, parent::getBairro());
            $queryInsertPessoa->bindValue(11, parent::getCidade());
            $queryInsertPessoa->bindValue(12, parent::getEstado());
            $queryInsertPessoa->bindValue(13, parent::getEmail());
            $queryInsertPessoa->bindValue(14, parent::getSenha());
            $queryInsertPessoa->bindValue(15, parent::getNomeConvenio());
            $queryInsertPessoa->bindValue(16, parent::getNumCarteiraConvenio());
            $queryInsertPessoa->execute();
            #endregion

            #region PUXANDO O ID DO ÚLTIMO REGISTRO DE PESSOA E ATRIBUINDO AO ATRIBUTO ID
            $querySelect = $conexao->query(
                "SELECT LAST_INSERT_ID() FROM tb_pessoa"
            );
            $ultimoID = $querySelect->fetchColumn();
            //print_r($ultimoID);
            parent::setId($ultimoID);
            #endregion

            #region CADASTRANDO DADOS NA TABELA MÉDICO
            $queryInsertMedico = $conexao->prepare(
                "INSERT INTO tb_medico(crm_medico, id_pessoa, id_especialidade, data_admissao) VALUES (?, ?, ?, ?)"
            );
            $queryInsertMedico->bindValue(1, $this->getCrm());
            $queryInsertMedico->bindValue(2, parent::getId());
            $queryInsertMedico->bindValue(3, $this->getEspecialidade()->getId());
            date_default_timezone_set('America/Sao_Paulo');
            $queryInsertMedico->bindValue(4, date('Y-m-d'));
            $queryInsertMedico->execute();
            #endregion

            #region CADASTRANDO TELEFONE
            $queryInsertTelefone = $conexao->prepare(
                "INSERT INTO tb_telefone(num_telefone, id_pessoa) VALUES (?, ?)"
            );
            $queryInsertTelefone->bindValue(1, parent::getTelefone1());
            $queryInsertTelefone->bindValue(2, parent::getId());
            $queryInsertTelefone->execute();
            #endregion

            #region CADASTRANDO TELEFONE OPCIONAL
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
            #endregion
            
            echo("<script> alert('Cadastro feito com sucesso!'); </script>");
            return true;
        }

        echo("<script> alert('Erro ao cadastrar.'); </script>");
        return false;
    }

    public function listar()
    {
        $conexao = Conexao::conexao();
        $querySelect = $conexao->query(
            "SELECT tb_medico.id_medico, tb_pessoa.nome_pessoa 
             FROM tb_medico, tb_pessoa
             WHERE tb_medico.id_pessoa = tb_pessoa.id_pessoa"
        );
        $lista = $querySelect->fetchAll();
        print_r($lista);
        return $lista;
    }

}

?>