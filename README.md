# Laravel Project Template

A basic Laravel project template with everything that you need to build your next project.

## Pre-requisites

- [Docker](https://www.docker.com/) installed. This project templates uses [Laravel Sail](https://laravel.com/docs/11.x/sail#main-content), that uses Docker to manage Laravel projects into a docker environment.

## Initializing a new project

- Create a new `.env` file:
  - `cp .env.template .env`
- Install composer dependencies. As you know, this project uses Docker, so you probably wont have PHP or Composer installed on your local machine:
  - `docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs`
- Start project using Sail:
  - `./vendor/bin/sail up` or `./vendor/bin/sail up -d` for detached mode.
- Generate application key:
  - `./vendor/bin/sail artisan key:generate`
- Run migrations (if needed):
  - `./vendor/bin/sail artisan migrate`
- We have some NPM dependencies in this project like [Husky]() for git automations, so we need to install theses NPM dependencies:
  - `./vendor/bin/sail npm install`
  - `./vendor/bin/sail npm run dev`
