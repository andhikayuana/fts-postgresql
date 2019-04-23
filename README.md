# PostgreSQL Full Text Search Demo

## Requirements

* PHP
* Composer
* PostgreSQL

## How to use

* Create the database using PostgreSQL and execute sql query in [migration.sql](./sql/migration.sql)
* Clone this repository, set `.env` file, install dependencies

```bash
$ git clone git@github.com:andhikayuana/fts-postgresql.git
$ cd fts-postgresql
$ cp .env.example .env
$ vim .env
$ composer install
```

* Insert Tweets data by executing this in your terminal

```bash
$ make run
```

* Now you can simulate the query for search by using [query.sql][./sql/query.sql] file
* Enjoy