up:
	docker-compose up --build -d

down:
	docker-compose down

composer-install:
	docker run --rm -v $(PWD):/app composer install

composer-update:
	docker run --rm -v $(PWD):/app composer update

composer-require:
	docker run --rm -v $(PWD):/app composer require ${PACKAGE}

composer-dump-autoload:
	docker run --rm -v $(PWD):/app composer dump-autoload
