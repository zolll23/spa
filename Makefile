PHP_FPM_IMAGE=spa_php
VUEJS_IMAGE=spa_vuejs

ifeq ($(D_TAG),)
  D_TAG=develop
endif

REGISTRY_PHP_FPM=$(PHP_FPM_IMAGE):$(D_TAG)
REGISTRY_VUEJS=$(VUEJS_IMAGE):$(D_TAG)


# Блок управления приложением
up: docker-up
down: docker-down
stop: docker-stop
start: docker-start
restart: docker-restart
build: docker-build
pull: docker-pull
logs: docker-logs


# Блок команд для разворачивания
init-docker: docker-down-clear docker-pull docker-build-dev docker-up
init-back: composer-install init-main-db tests
init-front: install-front build-front

composer-install:
	docker-compose run --rm --entrypoint sh composer -c 'composer install'

# Блок основных команд
docker-down-clear:
	docker-compose down --volumes --remove-orphans

docker-pull:
	docker-compose pull

docker-build-dev:
	docker-compose build --build-arg ENV=DEV php-fpm

docker-up:
	docker-compose up --detach --remove-orphans

docker-down:
	docker-compose down --remove-orphans

docker-stop:
	docker-compose stop

docker-start:
	docker-compose start

docker-restart:
	docker-compose restart

docker-build:
	docker-compose build

docker-logs:
	docker-compose logs --follow

tests: unit-tests

unit-tests:
	docker-compose exec php-fpm bash -c './vendor/bin/phpunit'

coverage:
	docker-compose exec php-fpm bash -c './vendor/bin/phpunit --coverage-clover clover.xml'


# Backend block

init-main-db:
	docker-compose exec mysql bash -c '/docker-entrypoint-initdb.d/init_db.sh'

# common tests
core-tests:
	docker-compose exec php-fpm bash -c './vendor/bin/codecept run --config=common'

# Frontend block
install-front:
	docker-compose exec nodejs sh -c 'npm install --unsafe-perm=true --allow-root'

build-front:
	docker-compose exec nodejs sh -c 'npm run build'

serve:
	docker-compose exec nodejs sh -c 'npm run serve'

# Docker services management block
build-nginx:
	docker-compose build nginx

build-php-fpm:
	docker-compose build php-fpm

composer:
	docker-compose up --detach composer

up-php-fpm:
	docker-compose up --detach php-fpm

up-nginx:
	docker-compose up --detach nginx

shell-php-fpm:
	docker-compose exec php-fpm bash

shell-nginx:
	docker-compose exec nginx bash

shell-yii:
	docker-compose exec php-fpm php yii shell

log-nginx:
	docker-compose logs --follow nginx

log-php-fpm:
	docker-compose logs --follow php-fpm

log-composer:
	docker-compose logs --follow composer

# запускается перед созданием коммита
git-install-hooks:
	cp backend/pre-commit.sh .git/hooks/pre-commit && chmod +x .git/hooks/pre-commit

cs:
	docker-compose run --rm -v "$(PWD)/backend:/backend" php-fpm vendor/bin/phpcs -n -s --standard=phpcs.xml --ignore=*.json,*.env*,*.yml,*.md,*.lock,*sh,*dist,*.bowerrc,*.bat,*.gitignore,*console/migrations/*,*docker/*,*swagger/*,*Makefile,*.kube/,*vendor/* ../$(FILE)

cbf:
	docker-compose run --rm -v "$(PWD)/backend:/backend" php-fpm vendor/bin/phpcbf -n --standard=phpcs.xml --ignore=*.json,*.env*,*.yml,*.md,*.lock,*sh,*dist,*.bowerrc,*.bat,*.gitignore,*console/migrations/*,*docker/*,*swagger/*,*Makefile,*.kube/,*vendor/* ../$(FILE)

psalm:
	docker-compose exec php-fpm ./vendor/bin/psalm

build-image-php-fpm:
	docker build -t $(REGISTRY_PHP_FPM) -f docker/php/Dockerfile ./docker/php
	docker push $(REGISTRY_PHP_FPM)

build-image-vuejs:
	docker build -t $(REGISTRY_VUEJS) -f docker/vuejs/Dockerfile ./docker/vuejs
	docker push $(REGISTRY_VUEJS)
