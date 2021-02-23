![release 1.4.0](https://img.shields.io/badge/release-1.4.0-blue.svg)
# Overview
Life system is built to watch your daily life and utilize your time and money wisely.

# Setup Instructions
## Development
1. Copy `.env.example` to `.env` file and update the variables accordingly
```bash
cp .env.example .env
```
2. Run the following command to start the docker services.
If you don't have docker installed, then head to the [docs](https://docs.docker.com/engine/install/) to install Docker.
```bash
docker-compose up -d
```
3. Migrate and seed the database
```bash
docker exec -it mymonitor_app php migrate.php
docker exec -it mymonitor_app php seed.php
```
4. Compile the assets
```bash
docker exec -it mymonitor_app npm run build:css
```
5. Open up the browser and navigate to http://localhost:3000/
6. Run the following to shut down the services on finish
```bash
docker-compose down
```
