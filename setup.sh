#INIT .ENV FILE
cp .env.example .env

# BUILD DOCKER CONTAINERS
docker compose up -d --build