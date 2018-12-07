### Processo necessário para rodar a aplicação no Windows
- Utilizar o XAMPP ( ou outro de sua preferência ) e apontar o localhost para a pasta /public do projeto (no XAMPP alterar o DocumentRoot do arquivo httpd.conf).
- Criar um banco de dados com o nome **grupo_zanon**
- Configurar o banco de dados mysql no arquivo .env que está na raiz do projeto, linhas de 9 a 14. ( esses são login e senha padrões do XAMPP, trocar caso tenha alterado na instalação )
	- DB_CONNECTION=mysql
	- DB_HOST=127.0.0.1 
	- DB_PORT=3306
	- DB_DATABASE=grupo_zanon
	- DB_USERNAME=root
	- DB_PASSWORD=
- Escolher um dos próximos passos para criar a tabela de usuários:
	- Utilizar o phpmyadmin do XAMPP ou programa de sua preferência para rodar o SQL dump que está na raiz do projeto com o nome db-mysql.sql ou;
	- Abrir o CMD na pasta do projeto e rodar o comando **php artisan migrate**
	- Caso preferir, segue o código para criar a tabela:
		- CREATE TABLE `users` (
						`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
						`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
						`last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
						`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
						`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
						`cpf` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
						`created_at` timestamp NULL DEFAULT NULL,
						`updated_at` timestamp NULL DEFAULT NULL,
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

### Instruções básicas de uso dos métodos.
Na raiz do projeto tem um arquivo do Postiman com todas as requisições (Grupo Zanon.postman_collection.json).
Para autenticar utilizar no Headers => Authorization: Basic R3J1cG9aYW5vbg==

- GET http://localhost/api/user/ID
	- Retona os dados de um usuário.
	- **ID** é campo id retornado quando cria um usuário.
- POST http://localhost/api/user
	- Cria um usuário.
	- Enviar os dados no formato JSON.
	- Campos:
		- {
				"name":  "tiago",
				"last_name":  "biage",
				"email": "tiagobiage@gmail.com",
				"password": "102030",
				"password_verified": "102030",
				"cpf": "307.522.118.03"
			}
	- Retona os dados do usuário criado.
- PUT http://localhost/api/user/ID	
	- Altera um usuário.
	- **ID** é campo id retornado quando cria um usuário.
	- Enviar os dados no formato JSON.
	- Campos:
		- {
				"name":  "tiago5",
				"last_name":  "biage5",
				"email": "tiagobiage5@gmail.com",
				"cpf": "507.522.118.03"
			}
	- Retona os dados do usuário alterado.
- DELETE http://localhost/api/user/ID
	- Apaga um usuário.
	- **ID** é campo id retornado quando cria um usuário.

---

# Desafio Desenvolvedor BackEnd

Seja parte de um dos grupos de empresas e franqueadoras que mais cresce no Brasil.

Esse é o nosso desafio para a vaga de desenvolvedor Back-end  no [Grupo Zanon](http://www.grupozanon.com.br/). 
Serão testadas as habilidades e qualidade de código ao transformar requisitos limitados em uma aplicação web.

Procuramos desenvolvedor engajado, versátil em resolver problemas que impactam o negócio de empresas, utilizando conhecimento de desenvolvimento de tecnologias back-end.
Confortável com a responsabilidade de criar, gerir e publicar aplicações.
Ávido por buscar sempre boas práticas para trabalhar com inovação, tecnologias modernas e emergentes.


### O que procuramos?
- Perfil proativo, saber trabalhar em equipe , raciocínio lógico, responsabilidade e comprometimento são imprescindíveis para essa oportunidade.
- Fácil adaptação em projetos experimentais e complexos;
- Aprendizado rápido no uso de tecnologias de desenvolvimento de software
- Experiência em Desenvolvimento de software Web.



### Instruções para o desafio

- **Fork** esse repositório e faça o desafio numa branch com o seu nome (exemplo: `nome-sobrenome`);
- Assim que concluir o seu desafio, abra um **pull request** com suas alterações.

### Tempo gasto
- Recomendamos dispensar aténo máximo 10 horas neste projeto.

### Desafio
- Desenvolver uma aplicação web responsável por gerenciar o cadsatro completo de usuários via API.
- *Soluções parcias serão aceitas.*

- Método API (GET) : Dados do suário
	- Dados do usuário em JSON,
- Método API (POST) : Novo usuário
	- Inserir usuário via API validando Nome completo e CPF, sendo o e-mail compo único.
- Método API (POST) : Edição do usuário
- Método API (DELETE) : Remoção do usuário


Qualquer solução de base de dados ou armazenamento será aceita.

### Escopo do desafio
- Instruções básicas de uso dos métodos.
- Documentar todas suposições realizadas.
- O desenvolvimento do backend deve ser feito em PHP .
- Preferencialmente utilizar Laravel 5.6+ com toda sua stack.
- Preferencialmente utilizar CodeIgniter.
- É aceitável utilizar algumas respostas estáticas em determinadas porções da aplicação.
- Não é necessário submeter uma aplicação que cumpra cada um dos requisitos descritos, mas o que for submetido deve funcionar.


### O que será avaliado
- O código será avaliado seguindo os seguintes critérios: manutenabilidade, clareza e limpeza de código; resultado funcional; entre outros fatores. 
- O histórico no `git` também está avaliado.
- Não esqueça de documentar o processo necessário para rodar a aplicação.
- Se necessário explique as decisões técnicas tomadas, as escolhas por bibliotecas e ferrramentas, o uso de patterns etc.


### Diferenciais
- Criar uma camada de segurança para uso da API.
- Liberação da aplicação utilizando Docker.
- Boa documentação de código e de serviços.
- Testes do código.

---
Em caso de dúvidas, envie um email para [desenvolvimento@seguralta.com.br](mailto:desenvolvimento@seguralta.com.br).


**Um dos nossos pilares é a valorização das pessoas e temos orgulho de dizer que somos uma empresa que apoia a diversidade e inclusão. Sendo assim, consideramos todos os candidatos para as nossas oportunidades, independente de raça, cor, religião, gênero, identidade de gênero, nacionalidade, deficiência, ascendência ou idade.**


**Até breve**
