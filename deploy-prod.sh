#!/usr/bin/env bash

# Passage en mode maintenance.
#drush sset system.maintenance_mode 1
drush config-set readonlymode.settings enabled 1 -y
echo Maintenance mode enabled.
drush cr

# Mise à jour config
git pull origin2   master
composer install --no-dev
drush cr

#Mise à jour de base
drush updb
drush cr

# Export des configs de prod.
drush csex prod -y

# import des configs.
drush cim -y
drush cr

#Ajout des config de prod au master
git add config/prod
git commit -m 'Ajout des configs de prod.'
git push origin2 master

# Sortie du mode de Maintenance.
#drush sset system.maintenance_mode 0
drush config-set readonlymode.settings enabled 0 -y
drush cr
echo Site is online.


