#!/usr/bin/env bash
php vendor/bin/phpunit
php bin/console doctrine:schema:update --force
php bin/console doctrine:schema:validate