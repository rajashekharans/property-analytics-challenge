## Requirements
- Docker

## Build
- `cp .env.example .env`
- Make sure port 4080 (`HTTP_PORT` in `.env` file) is not being used. If it is being used by another application you will
need to change to a different one.
- Make sure `HOST_DB_PORT` in `.env` file is not being used. If it is being used, change it to a different port. This will allow you to access MySQL from host machine.
- Ensure `make` is installed in your machine, it will help in running the commands
- To run the application, follow below steps:

    Build and start the container, run 
    ```
    make up
    ```
    Install dependent packages run 
    ```
    make composer-install
    ```
    Run db migrations 
    ```
    make db-migrate
    ```
    To seed the database run 
    ```
    make db-seed
    ```

## Development
- To run and generate coverage report for unit tests (requires XDebug):
 
    ```
    make run-tests
    ```

## Api routes
- Add a new property

    ```
    [POST] \api\properties
    ```
- Add/Update an analytic to a property

    ```
    [PUT] \api\properties\{property_id}\property-analytics
    ```
- Get all analytics for an inputted property

    ```
    [GET] \api\properties\{property_id}\property-analytics
    ```
- Get a summary of all property analytics for an inputted suburb (min value, max value, median value, percentage properties with a value, percentage properties without a value)

    ```
    [GET] \api\properties\property-analytics?suburb={suburb_name}&analytic_type_id={analytic_type_id}
    ```
- Get a summary of all property analytics for an inputted state (min value, max value, median value, percentage properties with a value, percentage properties without a value)

    ```
    [GET] \api\properties\property-analytics?state={state_name}&analytic_type_id={analytic_type_id}
    ```
- Get a summary of all property analytics for an inputted country (min value, max value, median value, percentage properties with a value, percentage properties without a value)

    ```
    [GET] \api\properties\property-analytics?country={country_name}&analytic_type_id={analytic_type_id}
    ```
