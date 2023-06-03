
![Logo](https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Logo.min.svg/2560px-Logo.min.svg.png)


# Elastic Test

This project was created at the request of Datak company for my testing purposes.
I used Laravel Sail in this project to make it easily testable in an isolated Docker environment.

First, get the project from Git

Then run the following commands in the project path

\* Make sure Docker is up to date on your system





## Installation

Install my-project with npm

```bash
  cd my-project

  composer install

  cp .env.example .env

  php artisan key:generate

  ./vendor/bin/sail up
```

Wait for your Docker to install then

```bash
  ./vendor/bin/sail artisan migrate --seed

  ./vendor/bin/sail artisan horizon

  ./vendor/bin/sail artisan schedule:work
```
## Running Tests

To run tests, run the following command

```bash
   ./vendor/bin/sail test
```


## Demo

you can see work project in

http://0.0.0.0/horizon

http://0.0.0.0/telescope

and

http://localhost:8025/

## Support

For support, email meysamhosseini1995@gmail.com or join our Slack channel.

