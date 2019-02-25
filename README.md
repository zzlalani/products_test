# Products Test Webservice
## Laravel 5.7/PHP 7.2/MySQL/Apache

### Installation

- Clone Project
  `git clone https://github.com/zzlalani/products_test.git`
- Docker up the project
  `docker-compose up -d`
  -- Please note it will take some time to build the project for the first time
- Login into the webserver docker container `7.2.x-webserver`
  `docker exec -it 7.2.x-webserver /bin/bash`
- and run the following commands to setup Laravel application
  ```sh
  $ cd /var/www/html
  $ composer install
  $ php artisan key:generate
  $ php artisan migrate
  $ php artisan db:seed
  ```
- check `http://localhost/` to see if the app is up and running
 
### Setup Passport
- Generate Passport Encryption keys for Authorization  
`php artisan passport:install`
--- Copy generated Client ID and Client secret that will be used to authorized clients

### Routes
- Get all products
  `http://localhost/products?max=10&page=1`
- Get a product
  `http://localhost/products/<product_id>`
- Login and get Authentication Token
  `http://localhost/auth/token`
  **username: admin@test.com** 
  **password: admin** 
  **grant_type: password**
  **client_id: 2**
  **client_secret: <generate Client Secret in above passport setup>**
- Post a product
  `http://localhost/products`
  --- Use Header
  `Authorization: Bearer <TOKEN GENERATE>`
## Test
- Exit the Docker container and run following command in app
  ```sh
  $ cd app
  $ composer test
  ```