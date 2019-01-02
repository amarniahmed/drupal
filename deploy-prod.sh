#!/usr/bin/env bash
git pull origin master

composer install --no-dev

drush updb

drush cr

drush csex prod