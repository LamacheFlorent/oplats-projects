# Installation Symfony

Commandes à taper dans le terminal à la racine du projet : 

* `composer create-project symfony/skeleton`
* `mv skeleton/* skeleton/.* .`
* `rmdir skeleton`
* `composer require doctrine/annotations`
* `composer require webapp` -> No (on n'utilise pas Docker)
* `composer require symfony/apache-pack` -> Yes


# Création / connexion à la BDD

Dans le fichier `.env` modifier la ligne de commande : 

#DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"

PAR 

DATABASE_URL="mysql://explorateur:Ereul9Aeng@127.0.0.1:3306/oplats?serverVersion=mariadb-10.3.38&charset=utf8mb4"

`bin/console doctrine:database:create` pour créer la base de données (vide dans un premier temps)

# Créer une entité

`bin/console make:entity` permet de générer une entitée

`bin/console make:migration` permet de migrer les données

`bin/console doctrine:migrations:migrate` valider la migration




