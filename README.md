# Sistema Academia

Sistema web para apoiar a rotina de um estúdio ou academia, com formulários de avaliação, acompanhamento de dados físicos e ferramentas para gerar sugestões de treino e dieta. A interface é responsiva e usa PHP e MySQL para as páginas que salvam e consultam registros.

🌐 **Site publicado:** [sistema-academia.freedev.app](https://sistema-academia.freedev.app/dados.html)

## Projeto e autoria

Sistema desenvolvido por **Pedro Santos** como prestação de serviço para uma academia local do bairro Primavera, em Jaguariúna, SP.

**Endereço da academia:** Rua Odivor Fontanella, bairro Primavera, Jaguariúna - SP, CEP 13910-336.

![Logo do sistema](imagens/logo.png)

## Funcionalidades

- Painel inicial com acesso às áreas do sistema.
- Formulários de avaliação corporal, bioimpedância e anamnese.
- Listagem e consulta de avaliações e registros salvos.
- Edição e exclusão de avaliações corporais.
- Gráficos de acompanhamento de medidas e composição corporal.
- Geração de sugestões de dieta e treino.
- Layout adaptado para dispositivos móveis.

## Tecnologias

- PHP e MySQL/MariaDB
- HTML, CSS e JavaScript
- Bootstrap, Boxicons, Font Awesome e Chart.js

As bibliotecas visuais são carregadas por CDN. O projeto não usa Composer ou npm.

## Estrutura do projeto

```text
.
├── acoes/          # Salvamento, edição e exclusão de registros
├── css/            # Estilos das páginas
├── forms/          # Formulários e ferramentas de dieta/treino
├── imagens/        # Logo e imagens
├── js/             # Scripts do navegador
├── src/config.php  # Leitura do .env e conexão MySQL
├── .env.example    # Modelo de configuração local
└── database/       # Estrutura SQL das tabelas
```

## Requisitos

- PHP 8 ou superior, com a extensão MySQLi habilitada.
- MySQL ou MariaDB.
- Apache (por exemplo, XAMPP).

## Instalação local com XAMPP

1. Clone o repositório para a pasta `htdocs` do XAMPP.
2. Inicie Apache e MySQL pelo painel do XAMPP.
3. No phpMyAdmin, crie um banco chamado `academia` e selecione-o.
4. Importe [`database/schema.sql`](database/schema.sql) pela aba **Importar**.
5. Copie `.env.example` para `.env` e ajuste os dados locais:

   ```dotenv
   DB_HOST=localhost
   DB_USERNAME=root
   DB_DATABASE=academia
   DB_PASSWORD=""
   ```

6. Acesse `http://localhost/Sistema-Academia-main/`.

## Publicação no InfinityFree

1. Crie o banco pela área **MySQL Databases** do painel InfinityFree.
2. Abra o phpMyAdmin, selecione o banco criado e importe `database/schema.sql`. O arquivo contém os comandos `CREATE TABLE`; não execute `CREATE DATABASE` ou `USE`, pois o banco é criado pelo painel.
3. Configure `.env` com os valores que o painel mostra:

   ```dotenv
   DB_HOST=host_mysql_do_painel
   DB_USERNAME=usuario_mysql_do_painel
   DB_DATABASE=nome_completo_do_banco
   DB_PASSWORD="senha_mysql_do_painel"
   ```

4. Envie os arquivos e pastas do projeto diretamente para `htdocs`, incluindo o `.env` real e o `.htaccess`.
5. Abra o domínio e teste as páginas PHP.

O `.htaccess` bloqueia o acesso web ao `.env`. Mantenha esse arquivo no servidor. Não publique nem envie o `.env` para o GitHub: ele contém credenciais. O `.gitignore` já exclui esse arquivo; use `.env.example` como modelo.

## Páginas principais

| Página | Finalidade |
| --- | --- |
| `index.html` | Painel inicial |
| `forms/forms.html` | Seleção de formulários |
| `forms/avaliar.html` | Avaliação corporal |
| `forms/bioimpedância.html` | Cadastro de bioimpedância |
| `forms/anamnese.html` | Cadastro de anamnese |
| `forms/ai.html` | Ferramenta de dieta |
| `forms/treino.html` | Ferramenta de treino |
| `progressos.php` | Lista de avaliações corporais |
| `bioimpedancia.php` | Lista de bioimpedâncias |
| `anamnese.php` | Lista de anamneses |

## Configuração do banco

A conexão é centralizada em `src/config.php`. As credenciais podem vir das variáveis de ambiente do servidor ou do `.env` localizado na raiz do projeto. O arquivo de exemplo documenta os nomes esperados: `DB_HOST`, `DB_USERNAME`, `DB_DATABASE` e `DB_PASSWORD`.

## Licença

Este repositório não possui uma licença pública definida. O sistema foi desenvolvido por **Pedro Santos** como prestação de serviço para a academia indicada acima. A utilização, alteração ou redistribuição do projeto deve respeitar os termos acordados entre o desenvolvedor e a academia contratante. A publicação do código no GitHub, por si só, não concede uma licença de reutilização.
