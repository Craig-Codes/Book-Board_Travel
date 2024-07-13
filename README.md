# Book-Board_Travel

Reload containers, removing volumes:

docker-compose down -v  
docker-compose up --build

<!-- After build, we need to install composer to let us run phpUnit tests -->

docker-compose run --rm www composer install

<!-- Command runs our test -->

docker-compose run --rm www vendor/bin/phpunit "Book&Board/tests/" - for phase 1
docker-compose run --rm www vendor/bin/phpunit "Book&Board_extended/tests/" - for phase 2

Useful for debugging php database call objects

```php
php<pre><?php print_r($offer); ?></pre>
```
