# INFUSEmedia TEST

Simple creat, read, delete (no update) test app for INFUSEmedia.

<!-- TABLE OF CONTENTS -->
## Table of Contents
<ol>
 <li>
  <a href="#about-the-project">About The Project</a>
 </li>
 <li>
  <a href="#getting-started">Getting Started</a>
  <ul>
   <li><a href="#prerequisites">Prerequisites</a></li>
   <li>
    <a href="#installation">Installation</a>
    <ul>
     <li><a href="#api">API</a></li>
     <li><a href="#ui">UI</a></li>
    </ul>
   </li>
  </ul>
  <li>
   <a href="#access-local-environment-services">Access local environment services</a>
   <ul>
    <li><a href="#mysql">MySQL</a></li>
    <li><a href="#endpoints">Endpoints</a></li>
   </ul>
  </li>
 </li>
 <li><a href="#motivation-for-splitting-projects">Motivation for splitting projects</a></li>
 <li><a href="#known-issues">Known issues</a></li>
</ol>

## About The Project

Project was build on backend with **[Laravel 10.x](https://laravel.com/)** with some imitation of application layering. On frontend **[Vue 3.3.x](https://vuejs.org/)** with using of **[Vuetify](https://vuetifyjs.com/en/)** as CSS framework.
|![INFUSEmedia test screenshot](example.png?raw=true "App screenshot")
|-

<!-- GETTING STARTED -->
## Getting Started

Following steps will help you to run this project locally.

### Prerequisites
* [Docker](https://docs.docker.com/engine/install/)
* [docker-compose](https://docs.docker.com/compose/install/)
* [Node.js and npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

Since one of the requests for test task is to preferably use docker, we asume they are already installed.

For **Node.js** and **npm**, just did not have time to make UI Dockerized, hope it's not an issue.

### Installation

#### API
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

#### UI

1. Navigate to `ui` directory from root of the repo.
2. Install dependencies:
   ```sh
   npm install
   ```
3. Run UI app.
   ```sh
   npm run dev
   ```

## Access local environment services

Here are all the details needed for accessing our services through local apps, like **Sequel Ace**, **MySQL Workbench** for db and **Postman** for test endpoints.

**MySQL**

You can access to MySQL DB via any of your DB app by providing default credentials.

* Host: **127.0.0.1**

* Port: **3319** (defined in `./api/docker-compose.yml` file under mysql service)

* Username: **sail** (defined in `./api/.env` file `DB_USERNAME`)

* Password: **password** (defined in `./api/.env` file `DB_PASSWORD`)

**Endpoints**

Unfortunately I did not have time to provide generated ApiDoc, so here I'll list three endpoints, used in our app:

* Host: **http://127.0.0.1:89**

- GET http://127.0.0.1:89/api/users - to fetch list of users.

- POST http://127.0.0.1:89/api/users - to create new user.
  ```ts
  // Payload
  {
   name: string
   email: string
   age: number
   gender: boolean
   subscribe: boolean
  }
  ```

- DELETE http://127.0.0.1:89/api/users/{id} - to delete user by id.

## Motivation for splitting projects

So main motivation, that our API can be used by other clients, not only our SPA app, but also Mobile, Desktop etc, so there is no need to keep Vue with additional dependencies in same repo. Additional dependencies won't affect api responce performance, but without UI in API repo it woul be much more clearer.

## Known issues

- Under Dockerized PHP **API** works MUCH slower (~900ms), but natively same users list endpoint response in **Postman** is ~40ms. To run natively you have to change DB connection settings for Laravel and specify manually same local PORT or match existed with UI in `.env`.

- If fill form and move with tab, **SUBMIT** button is not become active, only after mouse click, looks like [Vuetify](https://vuetifyjs.com/en/) bug or expected behavior.

- No UNIT Tests, because of time. On Frontend I'm usually using [Jest](https://jestjs.io/) + [Istanbul](https://istanbul.js.org/)
