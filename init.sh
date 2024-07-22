cat .env.example > .env
docker-compose -f dev/docker/docker-compose.yml --env-file=.env up -d
