# Gerador de relatório de velocidade de internet
Software utilizado para registrar velocidade de internet, utilizando o site "ESAQ - Entidade de Suporte à Aferição da Qualidade"

## Requisitos 
- Chrome web driver
- PHP
- Composer
- Credenciais de bot do Telegram

### Chrome web driver
Faça o download do [Chrome web driver](https://chromedriver.chromium.org/downloads) e o instale.

Após a instalação, você pode inicializar o driver com o seguinte comando:

```sh
$ chromedriver --port=4444
Starting ChromeDriver 108.0.5359.124 (603c1cb86aff29563721da2a6351c0d08865350d-refs/branch-heads/5359@{#1179}) on port 4444
Only local connections are allowed.
Please see https://chromedriver.chromium.org/security-considerations for suggestions on keeping ChromeDriver safe.
ChromeDriver was started successfully.
```
O parâmetro `--port` determina em que porta o driver irá ser executado.

### Preparando a aplicação

#### Instale as dependencias
A aplicação utiliza composer como gestor de dependencias. Basta executar o comando:

```sh
$ composer install
```

#### Preencha o arquivo `.env`
Você pode utilizar  arquivo `.env.example` como base para gerar o seu `.env`.

```txt
WEBDRIVER_LOCATION=<Endereço do driver do Chrome>
FILE_LOCATION=<caminho para exportar o relatório>
```

## Executando o projeto
Com o webdrive rodando, execute o arquivo `index.php`:

```sh
$ php index.php
```

Você pode adicionar a execução via cron.