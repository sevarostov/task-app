## REST API for task app

## Technical Requirements
- Git
- Docker
- Docker Compose

## Settings & Installation

### 1. Cloning repo

   ```sh
   git clone git@github.com:sevarostov/task-app.git
   ```

### 2. Copying env file

  ```sh
  scp .env.example .env
  ```

### 3. Building project with docker

   ```sh
    docker build -t php:latest --file ./docker/Dockerfile --target php ./docker
    docker compose exec php composer install
    docker compose up -d
   ```

### 4. Running migrations

    ```sh
    docker exec php php artisan migrate
    ``` 

## 5. Seeding test data

    ```sh
    docker exec php php artisan db:seed
    ```

