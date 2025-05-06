<?php

class Pessoa{

    private $id;
    private $nome;
    private $sexo;
    private $genero;
    private $dataNasc;
    private $rg;
    private $cpf;
    private $pcd;
    private $logradouro;
    private $numLog;
    private $cep;
    private $bairro;
    private $cidade;
    private $estado;
    private $telefone1;
    private $telefone2;
    private $email;
    private $senha;
    private $nomeConvenio;
    private $numCarteiraConvenio;

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    
    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }
    
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setPcd($pcd)
    {
        $this->pcd = $pcd;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function setNumLog($numLog)
    {
        $this->numLog = $numLog;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setNomeConvenio($nomeConvenio)
    {
        $this->nomeConvenio = $nomeConvenio;
    }

    public function setNumCarteiraConvenio($numCarteiraConvenio)
    {
        $this->numCarteiraConvenio = $numCarteiraConvenio;
    }


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function getGenero()
    {
        return $this->genero;
    }
    
    public function getDataNasc()
    {
        return $this->dataNasc;
    }
    
    public function getRg()
    {
        return $this->rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getPcd()
    {
        return $this->pcd;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function getNumLog()
    {
        return $this->numLog;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getTelefone1()
    {
        return $this->telefone1;
    }

    public function getTelefone2()
    {
        return $this->telefone2;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getNomeConvenio()
    {
        return $this->nomeConvenio;
    }

    public function getNumCarteiraConvenio()
    {
        return $this->numCarteiraConvenio;
    }

}


?>