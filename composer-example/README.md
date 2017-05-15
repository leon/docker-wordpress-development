# Develop
Install the docker client
https://www.docker.com/products/docker#/mac

install wordpress via composer
```
php composer.phar self-update
php composer.phar install
```

Name your project in the `.env` file so that docker creates images with that prefix
```
edit .env
```

Start docker
```
docker-compose up -d
```
