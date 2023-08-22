# Installation Symfony

- on clone le projet Github du challenge
- on se déplace dns le dossier cloné
- `composer create-project symfony/skeleton`
- `mv skeleton/* skeleton/.* .`
- `rmdir skeleton`
- `composer require doctrine/annotations`
- `composer require webapp`
  - `n` 
- `composer require symfony/apache-pack`
  - `y`

# Installation Doctrine 

Modifier le `DATABASE_URL` dans le `.env` et utiliser la commande `bin/console doctrine:database:create` pour créer la base de donnée dans mySql

## Création des entités

Avec la commande:
`bin/console make:entity <nomdelatable>`
On crée les tables et ses propriétés

| tables | propriétés |
| ------ | ---------- |
| recipe | codeApi |
| review | comment, rate |

La commande `bin/console make:user` va permettre de créer la table user avec les propriétés email, password (haché), role. Il met a jour le fichier `security.yml`
Pour notre projet on y a ajouté la propriété username (avec la commande `bin/console make:entity <nomdelatable>`)

## Relation avec les entités

On effectue la relation avec les entités avec la commande `bin/console make:entity <Nomdelabranche>`

# Création des interactions avec l'entité User

## Création de la page d'enregistrement

Avec la commande `bin/console make:registration-form`:
- création du formulaire d'enregistrement `RegistrationFormType.php` dans le dossier "Form"
- création du controller `RegistrationController` qui va enregistrer les données dans la BDD.
- création du template `register.html.twig` 

On ajoute à ces 3 fichiers la demande d'un "username"

## Création de la page de connexion

Avec la commande `bin/console make:auth`. 
Le fichier `security.yml` est mis à jour, création d'un controller `SecurityController` et du template `login.html.twig`.
Dans le dossier "Security" est crée un fichier `LoginFormAuthentificator.php` qui permet de faire les redirections.
