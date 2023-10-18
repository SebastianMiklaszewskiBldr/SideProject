#INIT .ENV FILE
printf "INIT .ENV"
cp .env.example .env

# BUILD DOCKER CONTAINERS
printf "BUILD CONTAINERS"
docker compose up -d --build
