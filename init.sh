#bin/bash
docker-compose up  -d
symfony server:ca:install
symfony console make:migration
symfony console d:m:m
symfony serve  -d --no-tls