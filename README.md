# phones
Phone Finder for JUMIA

INSTALL IN THE LOCAL ENVIRONMENT

1) Clone this repository 

    git clone https://github.com/caetanev/phones.git

2) Copy the .env from the .env.example

    cp .env.example .env

3) Edit the .env file and set the database configuration as below, poiting the absolute path of the application:

    DB_CONNECTION=sqlite
    
    DB_DATABASE= [ABSOLUTE PATH HERE] /database/database.sqlite

4) Run the command

    php artisan key:generate
    
5) Run the Composer

    composer install

6) Start the laravel artisan webserver

    php artisan serve --port=8081

7) Access the app at

    http://127.0.0.1:8081
  
INSTALL USING DOCKER

1) Clone this repository

    git clone https://github.com/caetanev/phones.git
  
2) Run the docker build to create the image (May take a while, just relax)

    docker build -t jumia-phone .
  
3) Access the container and configure the .env

    docker run -it jumia-phone bash
   
4) Run the container webserver

    docker run -p 8000:8000 jumia-phone
  
5) Access the app at

    http://localhost:8000
