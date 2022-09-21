# EasyParking

---

Sistema fácil de gestão de estacionamentos.

## Tecnologias

- [TALL Stack](https://tallstack.dev/) ❤️ *(TailWindCSS, Alpine.js, Laravel & Livewire)*

## Instalação

1. Clone o repositório:

```bash
git clone git@github.com:euseiphp/easyparking.git
```

2. Instale as dependências **(PHP)**:

```bash
composer install
```

3. Instale as dependências **(Node)**:

```bash
npm install && npm run build
```

3. Prepare o `.env`

```
APP_NAME="Easy Parking"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=<URL_AQUI>

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<DATABASE>
DB_USERNAME=<USUARIO>
DB_PASSWORD=<SENHA>
```

4. Gere a chave da aplicação:

```bash
php artisan key:generate
```

5. Execute as migrations:

```bash
php artisan migrate
```

Acesse a aplicação na URL definida em `APP_URL`