# sploder-revival

PHP Backend code used to power the Sploder Revival

## Prerequisites

To run the Sploder Revival, you will need to ensure you have the following installed:

### Docker Installation Method

- [Composer](https://getcomposer.org/download/)
- [Make](https://www.gnu.org/software/make/)
- [Docker](https://www.docker.com/get-started/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Docker Buildx](https://docs.docker.com/reference/cli/docker/buildx/)

### Manual Installation Method

- [Composer](https://getcomposer.org/download/)
- [PHP](https://www.php.net/manual/en/install.php)
- [PHP imagick](https://www.php.net/manual/en/book.imagick.php)
- [PHP mbstring](https://www.php.net/manual/en/book.mbstring.php)
- [PHP gd](https://www.php.net/manual/en/book.image.php)
- [PHP pdo](https://www.php.net/manual/en/book.pdo.php)
- [PHP pdo_pgsql](https://www.php.net/manual/en/ref.pdo-pgsql.php)
- [PHP pdo_sqlite](https://www.php.net/manual/en/ref.pdo-sqlite.php)
- [PHP xml](https://www.php.net/manual/en/simplexml.examples-basic.php)
- [Apache2](https://httpd.apache.org/)

## Running

### Docker

The provided Makefile provides an easy to use interface for running the development docker compose files.

First, you need to build the image. Anytime you make changes to anything in `./src` you will need to rebuild.

```shell
make build # build the sploder-image
```

After this, you will want to make sure you bootstrap the database for local development. This only needs to be ran once, or can be re-ran if you manually delete the database information.

```shell
make dev.bootstrap # RUN ONCE - bootstraps the backup database
```

For development, the following commands will let you run the instance locally
```shell
make dev # Runs the dev docker compose, detaching the container
make dev.watch # Runs the dev docker compose
```

TODO - Production docker-compose file does not yet exist

### Manual

If executing a manual deployment, be sure to copy `./src/.env.example` to `./src/.env` and populate the values with the specified configuration.
