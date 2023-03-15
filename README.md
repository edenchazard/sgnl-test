# Readme

## Running the project

Important: The instructions below are using Ubuntu.

The project uses docker for development and to separate various microservices into containers. Make sure docker (and docker-compose) are installed.

### Installation

You'll need to install the composer dependencies:

```sh
docker-compose run --rm composer install
```

Once composer's done its magic, use the following command to bring it up locally:

### Run

```sh
docker-compose run --service-ports frontend
```

You should be able to access the API in [your web browser](http://localhost:8080/).

## Testing

For testing, PHPUnit is used. Run the tests using:

```sh
docker-compose run --rm composer test
```

## Development

On first run, there are two init scripts that will run to populate the database with both the tables and the prepared data. These can be found under [here](/docker/mysql/init).

The database uses foreign keys to help ensure integrity.

You can view the database using adminer in [your web browser](http://localhost:8085) using:

```sh
docker-compose run --service-ports --rm adminer
```

### Folder structure

- docker
  - frontend: contains configurations for frontend, such as nginx that proxies php requests to the php service.
  - php: configuration for php service.
  - mysql: configuration for mysql, such as the initialization script.
    - init: mysql initialization scripts.
  - vars.env: contains settings that need to be accessed by multiple services, such as db credentials.
- src: The API code resides here and was skeleton'd using [Slim Skeleton](https://github.com/slimphp/Slim-Skeleton).
