# github-api-challenge

### Ferramenta de busca de usuários do Github

Neste desafio, deverá ser implementar uma ferramenta de busca de usuários do GitHub que seja capaz de mostrar informações detalhadas do usuário, persistindo suas informações no banco de dados.

### Ferramentas necessárias para este projeto:

- [Composer](https://getcomposer.org/);
- [Mysql](https://www.mysql.com/downloads/);
- [PHP](https://www.php.net/downloads.php);

### Preparando o ambiente:

- Inicialmente clone o este repositório;

- Na raiz do projeto, copie e cole o arquivo `.env.example`, altere o nome da cópia para `.env` e as informações de usuário e senha do banco de dados;

- Ainda na raiz do projeto execute o seguinte comando para instalar as dependências do projeto:

  ```bash
  composer install
  ```

   ```bash
  npm install
  ```

- Execute este comando para executar as migrations com as Seeds:

  ```bash
  php artisan migrate --seed
  ```

- Por fim, execute estes dois comandos em abas diferentes do terminal para executar o projeto:

  ```bash
  npm run dev
  ```

  ```bash
  php artisan serve
  ```

- Login e senha para acesso a aplicação:
  ```bash
  Login: vinicius@gmail.com
  Senha: 123mudar
  ```
