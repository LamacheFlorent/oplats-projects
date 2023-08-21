#Installation Symfony

- on clone le projet Github du challenge
- on se déplace dns le dossier cloné
- `cd challenge-cle-meteo-xxx`
- `composer create-project symfony/skeleton`
- `mv skeleton/* skeleton/.* .`
- `rmdir skeleton`
- `composer require doctrine/annotations`
- `composer require webapp`
  - `n` 
- `composer require symfony/apache-pack`
  - `y`

#Installation Doctrine 

A mettre dans le `.env` à la place de `DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"` 
ligne 28 `DATABASE_URL="mysql://explorateur:Ereul9Aeng@127.0.0.1:3306/oplats?serverVersion=mariadb-10.3.38"` 