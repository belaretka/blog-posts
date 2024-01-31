# blog-posts
Аn application that allows you to view posts and perform basic operations, as well as categorize posts and work with categories.

Categories:
- add / delete / edit categories
- add / delete posts from category
- listing of categories

Posts:
- add / delete / edit categories
- add / delete post in different categories
- listing of posts with pagination

Installation:
- git clone <my-project>
- sudo chmod 777 -R storage/
- cd blog-posts
- docker compose up -d
- docker compose exec php-cli bash
  - composer install
  - cp .env.example .env
  - php artisan key:generate
  - php artisan migrate
- open in browser http://localhost:8080/
