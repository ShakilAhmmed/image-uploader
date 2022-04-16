### IMAGE UPLOADER

## Installation

```shell
   cp .env.example .env
```

#### Put Your Nginx Port and phpmyadmin port in .env and set username and password

```dockerfile
   sudo docker-compose up -d 
   sudo docker exec -it image-uploader-application bash 
   composer install
   npm install
   php artisan key:generate
   php artisan passport:install
   php artisan websocket:serve
```

#### Authentication Source Code in [modules/authentication]

#### Image Processing Source Code in [modules/image-processing]
