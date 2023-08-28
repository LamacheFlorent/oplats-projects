
## 1er etape : On se connecte au serveur
## 2eme etape : On check si Apache et les dépendances sont installées
## 3eme etape : On clone le repo ofix
Pour le cloner il faut se positionner dans /var/www/html
Donc on fait :
```bash
cd /var/www/html
```
```bash
git clone git@github.com:O-clock-Vanadium-Vulcain-symfony/oflix-jc-oclock.git
```
Puis on rentre dedans :
```bash
cd cd oflix-jc-oclock/
```
Maintenant on va installer les dépendances du site O'Flix :
```bash
composer install
```
Maintenant que les dépendances sont installés, on va créer la Base de donnée.
Mais avant ça, on va mettre dans le fichier .env les bons accès à la base de donnée.
On fait :
```bash
nano .env
```
on choisy le fichier .env
Puis une fois que le fichier .env est ouvert, on descend jusqu'a ce qu'on trouve la ligne :
```bash
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/vulcanium?serverVersion=mariadb-10.3.3&charset=utf8mb4"
```
Et on remplace 'app:!ChangeMe!' par 'explorateur:Ereul9Aeng'.
Voilà à quoi ça doit ressembler maintenant :
```bash
DATABASE_URL="mysql://explorateur:Ereul9Aeng@127.0.0.1:3306/vulcanium?serverVersion=mariadb-10.3.3&charset=utf8mb4"
```
Si la ligne qui commence par DATABASE_URL= n'existe pas dans votre fichier, ce n'est pas grave, vous n'avez quà rajouter la ligne directement (copier coller).
## 4eme etape : Créer la Base de donnée
On se connecte tout d'abord à mysql.
On quitte nano en tapant ctrl + X
```bash
sudo mysql
```
On nous demande un mot de passe, le voici : par dessus les nuages
Une fois que c'est fait, nous voilà sur notre serveur de base de données.
Maintenant on créer notre utilisateur explorateur (avec son mdp) pour pouvoir se connecter dessus depuis notre applciation symfony (voir le .env)
```bash
# Ci dessous on créer l'utilisateur explorateur avec son mdp Ereul9Aeng
CREATE USER 'explorateur'@'localhost' IDENTIFIED BY 'Ereul9Aeng';
# Ci dessous on lui donne les privilèges
GRANT ALL PRIVILEGES ON *.* TO 'explorateur'@'localhost';
```
Une fois que c'est fait on quitte mysql en tapant cette commande :
```bash
ctrl C  -- exit;
```
## 5eme étape : on lance les migrations
On créer tout d'abord la base de donnée :
```bash
php bin/console doctrine:database:create
```
Puis on lance les migrations
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```
```bash
php bin/console doctrine:fixtures:load
```
Et voilà, le site est déployé !