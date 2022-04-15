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
```
