#!/usr/bin/env bash

git pull origin production
composer update
composer dumpautoload
