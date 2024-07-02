# Web Summer camp 2024 - Testing Symfony applications with Codeception  
## Installation
1. `git clone git@github.com:factoryhr/websc-24.git`
2. `cd websc-24`
3. `docker compose up --build --force-recreate`



## Running tests
1. login to the php:8.3-apache with `docker exec -it php-apache bash`
2. run the tests:
   1. ` vendor/bin/codecept run Acceptance`
   2. ` vendor/bin/codecept run Unit`
   3. ` vendor/bin/codecept run Api`
  

## Help in case of troubles 
`docker-compose down`

Shutting down all containers
`docker stop $(docker ps -q)`

Recreate 
 `docker compose up --build --force-recreate`
