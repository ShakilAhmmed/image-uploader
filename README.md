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

###   

```shell
   POST /api/v1/auth/login [email:required,password:required]
   POST /api/v1/auth/register [name:required,email:required,password:required]
   POST /api/v1/auth/logout [Bearer `token`]
   POST /api/v1/auth/me [Bearer `token`]
   GET  /api/v1/images [Bearer `token`]
   POST /api/v1/images/download [image_url:required] [Bearer `token`]
```
