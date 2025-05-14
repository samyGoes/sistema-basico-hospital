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
        parent::setStatus("ativo");
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
     
        #region VERIFICANDO SE O CPF JÁ NÃO ESTÁ CADASTRADO
        // $querySelectCpf = $conexao->prepare(
        //     "SELECT cpf_pessoa * FROM tb_pessoa"
        // );
        // $lista = $querySelectCpf->fetchAll();
        // $cpfJaCadastrado = false;

        // foreach($lista as $l)
        // {
        //     if($l["cpf_pessoa"] == parent::getCpf())
        //     {
        //         $cpfJaCadastrado = true;
        //         echo("cade: " . $cpfJaCadastrado);
        //         echo("<script> alert('CPF já cadastrado no sistema.'); </script>");
        //         break;             
        //     }
        // }
        #endregion

        // CADASTRA APENAS SE O CPF E A DATA DE NASCIMENTO FOREM VÁLIDOS
        if(parent::validaCpf(parent::getCpf()) == true)
        {
            if(parent::validarDataNasc(parent::getDataNasc()) == true)
            {
                #region CADASTRANDO DADOS NA TABELA PESSOA
                $queryInsertPessoa = $conexao->prepare(
                    "INSERT INTO tb_pessoa(nome_pessoa, rg_pessoa, cpf_pessoa, sexo_pessoa, 
                                        genero_pessoa, data_nasc_pessoa, logradouro_pessoa, 
                                        num_log_pessoa, cep_pessoa, bairro_pessoa, cidade_pessoa,
                                        estado_pessoa, email_pessoa, nome_convenio_pessoa,
                                        numero_convenio_pessoa, status_pessoa) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                );

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
                $queryInsertPessoa->bindValue(14, parent::getNomeConvenio());
                $queryInsertPessoa->bindValue(15, parent::getNumCarteiraConvenio());
                //echo("Status: " . parent::getStatus());
                $queryInsertPessoa->bindValue(16, parent::getStatus());
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
                return array(true, "iee");
            }
            else { return array(false, "data"); }
        }
        else { return array(false, "cpf"); }
    
    }

    public function listar()
    {
        $conexao = Conexao::conexao();
        $querySelect = $conexao->query(
            "SELECT tb_medico.id_medico, tb_medico.crm_medico, tb_pessoa.nome_pessoa, tb_medico.data_admissao, 
                    tb_especialidade.desc_especialidade, tb_pessoa.cpf_pessoa, tb_pessoa.genero_pessoa, tb_pessoa.cep_pessoa,
                    tb_pessoa.email_pessoa
             FROM tb_medico, tb_pessoa, tb_especialidade
             WHERE tb_medico.id_pessoa = tb_pessoa.id_pessoa
                AND tb_medico.id_especialidade = tb_especialidade.id_especialidade
                AND tb_pessoa.status_pessoa = 'ativo'"
        );
        $lista = $querySelect->fetchAll();
        //print_r($lista);
        return $lista;
    }

    public function listar_por_id($id)
    {
        $conexao = Conexao::conexao();
        $querySelect = $conexao->prepare(
            "SELECT tb_medico.crm_medico, tb_pessoa.nome_pessoa, tb_pessoa.rg_pessoa, tb_pessoa.cpf_pessoa,
                    tb_pessoa.sexo_pessoa, tb_pessoa.genero_pessoa, tb_telefone.num_telefone, tb_telefone.id_telefone,
                    tb_pessoa.data_nasc_pessoa, tb_pessoa.cep_pessoa, tb_pessoa.num_log_pessoa, tb_pessoa.email_pessoa,
                    tb_pessoa.nome_convenio_pessoa, tb_pessoa.numero_convenio_pessoa, tb_medico.id_especialidade
             FROM tb_medico, tb_pessoa, tb_telefone
             WHERE tb_medico.id_pessoa = tb_pessoa.id_pessoa
                AND tb_telefone.id_pessoa = tb_pessoa.id_pessoa
                AND tb_medico.id_medico = :id"
        );
        $querySelect->bindParam(":id", $id);
        $querySelect->execute();
        $lista = $querySelect->fetchAll();
        //print_r($lista);
        return $lista;
    }

    public function atualizar()
    {
        $conexao = Conexao::conexao();
        $queryUpdate = $conexao->prepare(
            "UPDATE tb_medico, tb_pessoa 
             SET tb_medico.crm_medico = ?, tb_pessoa.nome_pessoa = ?, tb_pessoa.rg_pessoa = ?, 
                 tb_pessoa.cpf_pessoa = ?, tb_pessoa.sexo_pessoa = ?, tb_pessoa.genero_pessoa = ?, 
                 tb_pessoa.logradouro_pessoa = ?, tb_pessoa.bairro_pessoa = ?, 
                 tb_pessoa.cidade_pessoa = ?, tb_pessoa.estado_pessoa = ?, tb_pessoa.cep_pessoa = ?, 
                 tb_pessoa.num_log_pessoa = ?, tb_pessoa.data_nasc_pessoa = ?, tb_pessoa.email_pessoa = ?,
                 tb_pessoa.nome_convenio_pessoa = ?, tb_pessoa.numero_convenio_pessoa = ?, 
                 tb_medico.id_especialidade = ?
            WHERE tb_medico.id_pessoa = tb_pessoa.id_pessoa
                AND tb_medico.id_medico = ?"
            );

        $queryUpdate->bindValue(1, $this->getCrm());
        $queryUpdate->bindValue(2, parent::getNome());
        $queryUpdate->bindValue(3, parent::getRg());
        $queryUpdate->bindValue(4, parent::getCpf());
        $queryUpdate->bindValue(5, parent::getSexo());
        $queryUpdate->bindValue(6, parent::getGenero());
        $queryUpdate->bindValue(7, parent::getLogradouro());
        $queryUpdate->bindValue(8, parent::getBairro());
        $queryUpdate->bindValue(9, parent::getCidade());
        $queryUpdate->bindValue(10, parent::getEstado());
        $queryUpdate->bindValue(11, parent::getCep());
        $queryUpdate->bindValue(12, parent::getNumLog());
        $queryUpdate->bindValue(13, parent::getDataNasc());
        $queryUpdate->bindValue(14, parent::getEmail());
        $queryUpdate->bindValue(15, parent::getNomeConvenio());
        $queryUpdate->bindValue(16, parent::getNumCarteiraConvenio());
        $queryUpdate->bindValue(17, $this->getEspecialidade()->getId());
        $queryUpdate->bindValue(18, $this->getId());
        $queryUpdate->execute();

        return true;
    }

    public function atualizarTelefone()
    {
        $conexao = Conexao::conexao();

        #region CONTANDO QUANTOS TELEFONES POSSUI
        $querySelectFoneOp = $conexao->prepare(
            "SELECT COUNT(tb_telefone.id_telefone) 
            FROM tb_telefone, tb_pessoa, tb_medico 
            WHERE tb_telefone.id_pessoa = tb_pessoa.id_pessoa
                AND tb_pessoa.id_pessoa = tb_medico.id_pessoa
                AND tb_medico.id_medico = ?"
        );
        $querySelectFoneOp->bindValue(1, $this->getId());
        $querySelectFoneOp->execute();
        $qtd_tel = $querySelectFoneOp->fetchColumn();
        echo("<br> Qtd de telefones: " . $qtd_tel);
        #endregion

        #region PEGANDO O ID DO PRIMEIRO TELEFONE
        $querySelectPrimeiroFone = $conexao->prepare(
            "SELECT id_telefone FROM tb_telefone  WHERE id_pessoa = ? LIMIT 1"
        );
        $querySelectPrimeiroFone->bindValue(1, $this->getId());
        $querySelectPrimeiroFone->execute();
        $fone1 = $querySelectPrimeiroFone->fetchColumn();
        echo("<br> ID fone 1: " . $fone1);
        #endregion

        #region UPDATES E CADASTRO
        //se o medico tiver mais de um telefone
        if($qtd_tel > 1)
        {
            // faz update dos dois
            #region UPDATE TELEFONE 1
            $queryUpdateTelefone = $conexao->prepare(
                "UPDATE tb_telefone, tb_medico, tb_pessoa 
                SET tb_telefone.num_telefone = ? 
                WHERE tb_telefone.id_pessoa = tb_pessoa.id_pessoa 
                    AND tb_pessoa.id_pessoa = tb_medico.id_pessoa
                    AND tb_medico.id_medico = ?
                    AND tb_telefone.id_telefone = ?"
            );
            $queryUpdateTelefone->bindValue(1, parent::getTelefone1());
            $queryUpdateTelefone->bindValue(2, $this->getId());
            $queryUpdateTelefone->bindValue(3, $fone1);
            $queryUpdateTelefone->execute();
            #endregion

            #region PEGANDO O ID DO SEGUNDO TELEFONE
            $querySelectSegundoFone = $conexao->prepare(
                "SELECT id_telefone FROM tb_telefone 
                    WHERE id_pessoa = ? ORDER BY id_telefone DESC LIMIT 1"
            );
            $querySelectSegundoFone->bindValue(1, $this->getId());
            $querySelectSegundoFone->execute();
            $fone2 = $querySelectSegundoFone->fetchColumn();
            echo("<br> ID fone 2: " . $fone2);
            #endregion

            #region UPDATE TELEFONE 2
            $queryUpdateTelefone2 = $conexao->prepare(
                "UPDATE tb_telefone, tb_medico, tb_pessoa 
                SET tb_telefone.num_telefone = ? 
                WHERE tb_telefone.id_pessoa = tb_pessoa.id_pessoa 
                    AND tb_pessoa.id_pessoa = tb_medico.id_pessoa
                    AND tb_medico.id_medico = ?
                    AND tb_telefone.id_telefone = ?"
            );
            $queryUpdateTelefone2->bindValue(1, parent::getTelefone2());
            $queryUpdateTelefone2->bindValue(2, $this->getId());
            $queryUpdateTelefone2->bindValue(3, $fone2);
            $queryUpdateTelefone2->execute();
            #endregion
        }
        else // se tiver só um telefone
        {
            #region UPDATE TELEFONE 1
            $queryUpdateTelefone = $conexao->prepare(
                "UPDATE tb_telefone, tb_medico, tb_pessoa 
                SET tb_telefone.num_telefone = ? 
                WHERE tb_telefone.id_pessoa = tb_pessoa.id_pessoa 
                    AND tb_pessoa.id_pessoa = tb_medico.id_pessoa
                    AND tb_medico.id_medico = ?
                    AND tb_telefone.id_telefone = ?"
            );
            $queryUpdateTelefone->bindValue(1, parent::getTelefone1());
            $queryUpdateTelefone->bindValue(2, $this->getId());
            $queryUpdateTelefone->bindValue(3, $fone1);
            $queryUpdateTelefone->execute();
            #endregion

            // se tiver só um telefone porém quer cadastrar um opcional
            #region CADASTRO TELEFONE 2
            $telefoneOpcional = parent::getTelefone2();
            echo("<br> tel op: " . $telefoneOpcional);
            if($telefoneOpcional != "")
            {
                $queryInsertTelefone2 = $conexao->prepare(
                    "INSERT INTO tb_telefone(num_telefone, id_pessoa)
                    VALUES(?, ?)"
                );
                $queryInsertTelefone2->bindValue(1, parent::getTelefone2());
                $queryInsertTelefone2->bindValue(2, $this->getId());
                $queryInsertTelefone2->execute();
            }
            #endregion
        }         
        #endregion
        return true;
    }

    public function desativar()
    {
        $conexao = Conexao::conexao();
        $queryUpdate = $conexao->prepare(
            "UPDATE tb_pessoa, tb_medico 
             SET status_pessoa = ?
             WHERE tb_pessoa.id_pessoa = tb_medico.id_medico
                AND tb_medico.id_medico = ?"
        );
        $queryUpdate->bindValue(1, parent::getStatus());
        $queryUpdate->bindValue(2, $this->getId());
        $queryUpdate->execute();

        return true;
    }
}


?>