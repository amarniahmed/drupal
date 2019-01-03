wi
#!/usr/bin/env bash

drush sset system.maintennance_mode 1

echo Maintenance mode enabled.

drush cr

git pull origin master

composer install --no-dev

drush cr

drush updb

drush cr

drush csex prod -y

drush cim -y

drush cr

git add config/prod
git commit -m 'Ajout de config'

drush sset system.maintennance_mode 0

drush cr

echo Site is online.
