Symfony portfolio
==============

## Description
* Visitors can register or view posts
* Registered visitors can modify or create new posts
* I created this site with **FOSUser**, **KnpPaginator** and **StofDoctrineExtensions** bundle with **timestampable** and **slugable**.
* I also translated site in 3 languages using **_locale**.

## Deployment on test environment
* `cd portfolio/`
* `composer install`
* `php app/console doctrine:schema:create --dump-sql`
* `php app/console server:run 0.0.0.0:8000`
* open browser at `localhost:8000`

create `testuser` with password `123` in console
* `php app/console fos:user:create testuser test@example.com 123`