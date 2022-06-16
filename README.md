# FitnessK
***
Projet de fin d'étude de formation 3WA fullstack developper


## Installation du projet
***
Télécharger le projet est effectué les commandes suivante : 
```
$ git clone https://github.com/emilixndev/fitnessk.git
$ cd ../path/to/the/file
$ composer install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:make:migration
$ php bin/console doctrine:s:u --force
```
N'oublier pas de changer la l'adresse de la base dans le ``.env``

Pour un accès admin il vous faudra créer un utilsateur avec le role ```['ROLE_ADMIN']```


***
Emilien Muckensturm FSD12
