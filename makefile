install:
	composer install

gendiff:
	./bin/gendiff

validate:
	composer validate

autoload:
	composer dump-autoload

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

test:
	composer exec --verbose phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text

gendiff-test:
	./bin/gendiff files/file1.json files/file2.json

gendiff-test-nested:
	./bin/gendiff files/file3.json files/file4.json

gendiff-test-plainformat:
	./bin/gendiff --format plain files/file3.json files/file4.json