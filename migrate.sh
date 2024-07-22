docker-compose -f dev/docker/docker-compose.yml --env-file=.env exec app php yii migrate --interactive=0
