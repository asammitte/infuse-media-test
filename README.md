# INFUSEmedia TEST

Simple test app based on **Laravel 10.x** and **Vue 3.3.x**

<!-- GETTING STARTED -->
## Getting Started

Following steps will help you to run this project locally.

### Prerequisites
* [Docker] (https://docs.docker.com/engine/install/)
* [docker-compose] (https://docs.docker.com/compose/install/)

Since one of the requests for test task is to preferably use docker, we asume they are already installed.  

## Installation

### API
1. Clone the repo
   ```sh
   git clone git@github.com:asammitte/infuse-media-test.git
   ```
2. Navigate to `api` directory.
3. Build, create, start and attache to containers for a service.
   ```sh
   docker-compose up -d
   ```
4. _This step optional and only required if you do not have already installed `composer`._

   Open `infuse-laravel` container shell. (Container names are predefined in `./api/docker-compose.yml` file.)
   ```sh
   docker exec -it infuse-laravel bash
   ```
5. Install composer dependencies in container's shell. Alternatevly if you have preinstalled `composer`, you can run it from your terminal.
   ```sh
   composer install
   ```
6. Ok, now we can close docker shell and continue with our termianl. Be sure that you are running commands from `./api` directory.
7. We are using [Laravel sail](https://laravel.com/docs/10.x/sail). Now let's run initial DB migrations.
   ```sh
   ./vendor/bin/sail php artisan migrate
   ```
8. Populate DB with initial test records. It's optional, but since it was one of test task requirement:
   ```sh
   ./vendor/bin/sail php artisan db:seed --class=DatabaseSeeder
   ```
9. Finally run our api application
   ```sh
   ./vendor/bin/sail up
   ```

### Access local environment
**MySQL**

You can access to MySQL DB via any of your DB app by providing default credentials.

* Port: **3319** (defined in `./api/docker-compose.yml` file under mysql service)

* Username: **sail** (defined in `./api/.env` file `DB_USERNAME`)

* Username: **password** (defined in `./api/.env` file `DB_PASSWORD`)

**API**

Unfortunately I did not have time to provide generated ApiDoc, so here I'll list three endpoints, used in our app:

* Host: **http://127.0.0.1:89**

- GET http://127.0.0.1:89/api/users - to fetch list of users.

- POST http://127.0.0.1:89/api/users - to create new user.

- DELETE http://127.0.0.1:89/api/users/{id} - to delete user by id.

### UI

It's 2:00AM, unfortunately I didn't have time to make docker-compose for UI, hopefully you have preinstalled `npm`

1. Navigate to `ui` directory from root of the repo.
2. Install dependencies:
   ```sh
   npm install
   ```
3. Run UI app.
   ```sh
   npm run dev
   ```
## Motivation for splitting projects

So main motivation, that our API can be used by other clients, not only our SPA app, so the as result our api project will be much more straitforeward. Plus no need in additional dependencies to get run together API and UI.

## Known issues

- Under docker **API** works slow, but natively it's quite fast.

- If fill form and move with tab, **SUBMIT** button is not become active, only after mouse click, looks like [Vuetify](https://vuetifyjs.com/en/) bug or expected behavior.
