# Sistema básico para um hospital
![image](https://github.com/user-attachments/assets/2ff3e051-5fd7-4a2b-928f-7e9fb3c3ed4d)

## Sobre o Sistema
### Funcionalidades
- CRUD do médico;
- Cadastro de especialidades;
- Cadastro dos horários dos médicos;
- Parte da gestão de horários.

### Telas Estáticas (apenas front-end)
- Cadastro de pacientes;
- Agendamento de consultas;
- Pagamento de consultas.

> [!NOTE]
> O site e o banco de dados não estão hospedados em nenhum servidor.

## Como testar?
- Simule um servidor local, caso queira baixe o [xampp](https://www.apachefriends.org/pt_br/index.html) (ele já contém o `apache` e `mysql`);
- Entre na pasta `xampp/htdocs/` pelo terminal e execute o comando para clonar o repositório:
~~~cmd
git clone https://github.com/samyGoes/sistema-basico-hospital.git
~~~
> Você precisa ter o [GIT](https://git-scm.com/downloads) instalado para executar o comando acima.

- Entre na pasta `xampp/mysql/bin/` e execute o comando no terminal para importar o banco:
~~~cmd
mysql -u root -p < "caminho-até-a-pasta/xampp/htdocs/sistema-basico-hospital/bd_hospital.sql"
~~~
- Acesse `localhost/sistema-basico-hospital` no navegador :)
