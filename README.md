# Products Test Webservice
## Laravel 5.7/PHP 7.2/MySQL/Apache

### Installation

- Clone Project <br>
  `git clone https://github.com/zzlalani/products_test.git`
- Docker up the project<br>
  `docker-compose up -d`<br>
  -- Please note it will take some time to build the project for the first time
- Login into the webserver docker container `7.2.x-webserver` <br>
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
- Generate Passport Encryption keys for Authorization <br> 
`php artisan passport:install`<br>
--- Copy generated Client ID and Client secret that will be used to authorized clients

### Routes
- Get all products<br>
  `http://localhost/products?max=10&page=1`
- Get a product<br>
  `http://localhost/products/< product_id >`
- Login and get Authentication Token<br>
  `http://localhost/auth/token`<br>
  **username: admin@test.com** <br>
  **password: admin** <br>
  **grant_type: password**<br>
  **client_id: 2**<br>
  **client_secret: < generate Client Secret in above passport setup > **<br>
- Post a product<br>
  `http://localhost/products`
  --- Use Header<br>
  `Authorization: Bearer < TOKEN GENERATE >`<br>
## Test
- Exit the Docker container and run following command in app
  ```sh
  $ cd app
  $ composer test
  ```
