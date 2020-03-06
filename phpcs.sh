#!/usr/bin/env bash
read -p 'Entrez le namespace à etudier:' namespace
rm -rf storage/app/public/phpcs/phpcs.json
rm -rf storage/app/public/phpcs/phpcs.xml

phpcs --report=json --report-file=storage/app/public/phpcs/phpcs.json $namespace
phpcs --report=xml --report-file=storage/app/public/phpcs/phpcs.xml $namespace
