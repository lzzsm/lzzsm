# 🎓 Perseph

> Sistema desenvolvido como Trabalho de Conclusão de Curso (TCC) para o curso Técnico em Informática.

## 📋 Sobre o Projeto

Sistema gamificado de incentivo à reciclagem e educação ambiental

## 🛠️ Tecnologias Utilizadas

- **Laravel**
- **PHP**
- **MySQL**
- **Tailwind**
- **JavaScript**
- **Node.js**
- **HTML5 / CSS3**

## ⚙️ Como executar o projeto

### Pré-requisitos

- PHP >= 8.2
- Composer
- MySQL
- Node.js / NPM

### Passo a passo

1. Clone o repositório
    ```bash
       git clone https://github.com/lzzsm/Perseph.git
    
2. Acesse a pasta do projeto
    ```bash
       cd nome-do-repo
    
3. Instale as dependências do PHP
    ```bash
       composer install
    
4. Copie o arquivo de ambiente
    ```bash
       cp .env.example .env
    
5. Gere a chave da aplicação
    ```bash
       php artisan key:generate
    
6. Configure o banco de dados no arquivo .env
    ```text
       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=nome_do_banco
       DB_USERNAME=root
       DB_PASSWORD=
    
7. Execute as migrations
    ```bash
       php artisan migrate
    
8. (Opcional) Popule o banco com dados de teste
    ```bash
       php artisan db:seed
    
9. Inicie o servidor
    ```bash
       php artisan serve
    
10. Acesse no navegador: http://localhost:8000
   
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
