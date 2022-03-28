## Sobre o VacinaMe - Notificações inteligentes

### Missão

Existimos para favorecer o aumento da cobertura vacinal da população.
### Visão

VacinaMe almeja contribuir com a diminuição da incidência de doenças imunopreveníveis
### Valores

Integridade, Honestidade, Respeito, Responsabilidade e Compromisso Social

### Serviços

VacinaMe funciona como uma solução digital para o envio de notificações com alertas para vacinação.

### Propósito

VacinaMe busca contribuir com o aumento da cobertura vacinal da população através desta ferramenta, dimunuindo assim a incidência de doenças e imunopreveniveis.

### Benefícios

VacinaMe funciona através de lembretes por mensagens para telefones móveis, que podem alcançar escalabilidade e diminuir o custo por lembrete enviado.
As pesquisas atuais indicam que o uso de notificações podem ajudar no aumento da cobertura vacinal.

### Alcance

VacinaMe pode se comunicar com qualquer pessoa que possui um telefone móvel, e já em 2019 de acordo com o IBGE, mais de 80% das pessoas acima de 10 anos possuia pelo menos um telefone móvel do Brasil.



## [Software] Requisitos para Instalação

Lista dos principais softwares que compõe e aplicação. 

- **PHP-FPM 8.1**: FPM (FastCGI Process Manager) é uma alternativa para a implementação PHP FastCGI com algumas features adicionais (principalmente) usado em sites pesados. [PHP FPM documentação](https://www.php.net/manual/pt_BR/install.fpm.php)

- **MySQL 8.0**: O MySQL é um sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL como interface. É atualmente um dos sistemas de gerenciamento de bancos de dados mais populares da Oracle Corporation, com mais de 10 milhões de instalações pelo mundo. [MySQL documentação](https://dev.mysql.com/doc/)

- **JavaScript**: JavaScript é uma linguagem de programação interpretada estruturada, de script em alto nível com tipagem dinâmica fraca e multiparadigma. Juntamente com HTML e CSS, o JavaScript é uma das três principais tecnologias da World Wide Web.

- **Docker e Docker compose** - Docker é um conjunto de produtos de plataforma como serviço que usam virtualização de nível de sistema operacional para entregar software em pacotes chamados contêineres. Os contêineres são isolados uns dos outros e agrupam seus próprios softwares, bibliotecas e arquivos de configuração. [Docker documentação](https://www.docker.com/)

- **Framework Laravel 8.x** : Laravel é um framework PHP livre e open-source criado por Taylor B. Otwell para o desenvolvimento de sistemas web que utilizam o padrão MVC. [Laravel documentação](https://laravel.com/docs)

- **Laravel Sail**: é uma interface de linha de comando leve para interagir com o ambiente de desenvolvimento Docker padrão do Laravel. O Sail fornece um ótimo ponto de partida para criar um aplicativo Laravel usando PHP, MySQL e Redis sem exigir experiência prévia do Docker. [Laravel Sail documentação](https://laravel.com/docs/8.x/sail)

- **Composer**: O Composer é um gerenciador de pacotes no nível do aplicativo para a linguagem de programação PHP que fornece um formato padrão para gerenciar dependências do software PHP e bibliotecas necessárias. Foi desenvolvido por Nils Adermann e Jordi Boggiano, que continuam a gerenciar o projeto. [Composer documentação](https://getcomposer.org/doc/)

- **Eloquent**: O Laravel inclui o Eloquent, um mapeador objeto-relacional (ORM) que torna agradável interagir com seu banco de dados. Ao usar o Eloquent, cada tabela do banco de dados possui um "Modelo" correspondente que é usado para interagir com essa tabela. Além de recuperar registros da tabela do banco de dados, os modelos do Eloquent também permitem inserir, atualizar e excluir registros da tabela. [Eloquent documentação](https://laravel.com/docs/8.x/eloquent)

- **Plataforma de envio de notificações**: Twilio é uma empresa americana com sede em San Francisco, Califórnia, que fornece ferramentas de comunicação programáveis ​​para fazer e receber chamadas telefônicas, enviar e receber mensagens de texto e realizar outras funções de comunicação usando suas APIs de serviço da web. [Twilio documentação](https://www.twilio.com/pt-br/)

- **AdminLTE 3**: Painel de administração de código aberto e tema do painel de controle. Construído sobre o Bootstrap, o AdminLTE fornece uma variedade de componentes responsivos, reutilizáveis ​​e comumente usados.

- **Arquitetura MVC** - O MVC funciona como um padrão de arquitetura de software que melhora a conexão entre as camadas de dados, lógica de negócio e interação com usuário. Através da sua divisão em três componentes, o processo de programação se torna algo mais simples e dinâmico.

## [Software] Passos para instalação

1. Clonar o repositório 
```bash
    git clone https://github.com/victorMagalhaesPacheco/notifications-vaccines.git
```
2. Entrar no diretório
```bash
    cd notifications-vaccines/
```
3. Executar o seguinte comando para iniciar a aplicação
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
4. Acessar o container em execução através do comando
```bash
docker exec -it [HASH CONTAINER AQUI] bash
```
5. Em seguida criar o arquivo de configuração .env adicionando informações do banco de dados e as chaves de integração com o serviço de envio de notificações (Twilio e Email)
```bash
cp .env.example .env
```
6. Executar as Migrations e Seeds
```bash
php artisan migrate && php artisan db:seed
```
7. Permissão para o storage (escrita de logs e cache)
```bash
chmod -R 777 storage/
```
8. Acessar a aplicação [localhost](http://localhost)
