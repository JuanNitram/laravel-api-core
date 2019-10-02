.PHONY: up down log tinker artisan

ART=""
artisan:
	@php artisan $(ART)

storage-link:
	@php artisan storage:link

key-generate:
	@php artisan key:generate

install:
	@composer install
	@npm install

migrate:
	@php artisan migrate

fresh-seed:
	@php artisan migrate:fresh --seed
	@php artisan passport:install

dump-server:
	@php artisan dump-server

test:
	@vendor/bin/phpunit

cache-clear:
	@php artisan cache:clear

config-clear:
	@php artisan config:clear
