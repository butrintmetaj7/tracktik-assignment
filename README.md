# Tracktik Assignment App

----------

## Installation with Docker Sail

Clone the repository

    git clone git@github.com:butrintmetaj7/tracktik-assignment.git

Switch to the repo folder

    cd tracktik-assignment

Install all the dependencies using composer

    composer install --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the below command to start the docker containers

    ./vendor/bin/sail up -d

Generate a new JWT authentication secret key

    php artisan jwt:generate

Generate app secret
    
    ./vendor/bin/sail artisan key:generate

Run migrations

    ./vendor/bin/sail artisan migrate


# Project 

This creates employee providers for each provider a Provider file with the mapping schema rules will be created and a record of the provider on the database with a api_token that the provider will use in order to send data to the our API

Run Create Employee Provider command
    ./vendor/bin/sail artisan make:employee-provider ExampleProvider

You can now access the server at http://localhost:80

----------
