# Web Summer camp 2024 - Testing Symfony applications with Codeception  
## Installation
1. `git clone git@github.com:factoryhr/websc-24.git`
2. `cd websc-24`
3. `docker-compose up`



## Running tests
1. login to php:8.3-apache run `docker ps` and copy container id of php:8.3-apache image
2. `docker exec -it c016ec765443 bash` - Replace id with your id
3. ` vendor/bin/codecept run Acceptance|Unit|Api`
