CREATE DATABASE bd_hospital;
USE bd_hospital;

CREATE TABLE tb_pessoa(
	id_pessoa INT PRIMARY KEY AUTO_INCREMENT,
	nome_pessoa VARCHAR(50),
	rg_pessoa CHAR(12),
	cpf_pessoa CHAR(14),
	sexo_pessoa VARCHAR(30),
	genero_pessoa VARCHAR(30),
	data_nasc_pessoa DATE,
	logradouro_pessoa VARCHAR(50),
	num_log_pessoa VARCHAR(10),
	cep_pessoa CHAR(9),
	bairro_pessoa VARCHAR(50),
	cidade_pessoa VARCHAR(50),
	estado_pessoa VARCHAR(50),
	email_pessoa VARCHAR(50),
	nome_convenio_pessoa VARCHAR(40),
	numero_convenio_pessoa VARCHAR(10),
	status_pessoa VARCHAR(10)
);

CREATE TABLE tb_telefone(
	
	id_telefone INT PRIMARY KEY AUTO_INCREMENT,
	num_telefone VARCHAR(16),
	id_pessoa INT,

	CONSTRAINT fk_pessoaTelefone FOREIGN KEY (id_pessoa) REFERENCES tb_pessoa(id_pessoa)
);

CREATE TABLE tb_paciente(

	id_paciente INT PRIMARY KEY AUTO_INCREMENT,
	status_paciente VARCHAR(30),
	id_pessoa INT,

	CONSTRAINT fk_pessoaPaciente FOREIGN KEY (id_pessoa) REFERENCES tb_pessoa(id_pessoa)
);

CREATE TABLE tb_especialidade(

	id_especialidade INT PRIMARY KEY AUTO_INCREMENT,
	desc_especialidade VARCHAR(100)
);

CREATE TABLE tb_medico(

	id_medico INT PRIMARY KEY AUTO_INCREMENT,
	crm_medico VARCHAR(30),
	data_admissao DATE,
	data_demissao DATE,
	id_especialidade INT,
	id_pessoa INT,

	CONSTRAINT fk_especialidadeMedico FOREIGN KEY (id_especialidade) REFERENCES tb_especialidade(id_especialidade),
	CONSTRAINT fk_pessoaMedico FOREIGN KEY (id_pessoa) REFERENCES tb_pessoa(id_pessoa)
);

CREATE TABLE tb_consulta(
	
	id_consulta INT PRIMARY KEY AUTO_INCREMENT,
	data_retorno_consulta DATE,
	presenca_consulta VARCHAR(10),
	data_consulta DATE,
	preco_consulta FLOAT(5),
	id_paciente INT,
	id_medico INT,

	CONSTRAINT fk_pacienteConsulta FOREIGN KEY (id_paciente) REFERENCES tb_paciente(id_paciente),
	CONSTRAINT fk_medicoConsulta FOREIGN KEY (id_medico) REFERENCES tb_medico(id_medico)	
);

CREATE TABLE tb_agenda(
	
	id_agenda INT PRIMARY KEY AUTO_INCREMENT,
	id_consulta INT,

	CONSTRAINT fk_consultaAgenda FOREIGN KEY (id_consulta) REFERENCES tb_consulta(id_consulta)
);

CREATE TABLE tb_horariosMedico
(
	id_hm INT PRIMARY KEY AUTO_INCREMENT,
	horario_hm TIME,
	id_medico INT,

	CONSTRAINT fk_medicoHorario FOREIGN KEY (id_medico) REFERENCES tb_medico(id_medico)
);

