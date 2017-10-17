# Symfony blogging platform

#### Deployment on test environment
* `git clone https://github.com/nikola-bodrozic/portfolio.git`
* `cd portfolio/`
* `composer install`
* `mysql -u root -p db_name < database.sql`
* `php app/console server:run 127.0.0.1:8000`
* open browser at `http://localhost:8000`

#### Create admin
in console create user **admin** with password **123** and assign `ROLE_ADMIN`
* `php app/console fos:user:create admin admin@example.com 123`
* `php app/console fos:user:promote admin ROLE_ADMIN`

#### Description
* Admin creates users
* Users create/modify/delete posts
* I created this site with **FOSUser**, **KnpPaginator** and **StofDoctrineExtensions** bundle with **timestampable** and **slugable**.
* I also translated site in 3 languages using **_locale**.