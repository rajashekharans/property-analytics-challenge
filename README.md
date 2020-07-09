## Requirements
- Docker

## Build
- `cp .env.example .env`
- Make sure port 4080 (`HTTP_PORT` in `.env` file) is not being used. If it is being used by another application you will
need to change to a different one.
- Make sure `HOST_DB_PORT` in `.env` file is not being used. If it is being used, change it to a different port. This will allow you to access MySQL from host machine.
- Ensure `make` is installed in your machine, it will help in running the commands
- To run the application, follow below steps:
- Build and start the container, run `make up`
- Install dependent packages run `make composer-install`
- Run db migrations `make db-migrate`
- To seed the database run `make db-ssed`

## Development
- To run and generate coverage report for unit tests (requires XDebug): `make run-tests`
