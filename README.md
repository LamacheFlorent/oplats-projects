<h1 align="center">O'Plats</h1>
<h2 align="center">Une application pour tous les goûts et les saveurs</h2>

<h3 align="center">La partie back du projet </h3>

<h4> Etape 1 Installations<h4>

-   Symfony
-   Doctrine
-   Composer

- HttpKernel
- Security-bundle
- Http-client
- lexik/jwt-authentication-bundle

<h4> Etape 2 Création de la BDD<h4>

- Mise en place des entités (Recipe, Review, User)
- Ajouter l'url de la BDD dans le fichier .env.local
- Créer les relations entre les entités
- Créer la base de données
- Faire les migrations

<h4> Etape 3 Création des routes<h4>

- Créer les contrôleurs
- Créer les routes
- Créer les écouteurs d'évènement pour l'authentification

<h4> Etape 4 Premiers tests<h4>

- Tester les différentes routes
- Ajouter des données à la BDD via les routes
- Connecter les routes au front (faire attention au CORS)

<h4> Etape 5 Sécurisation et configuration<h4>

- Jwt token 
- Token CSRF 
- Security.yaml
- Hiérarchisations des rôles 
- Permissions

<h4> Etape 6 Tests et déploiement<h4>

- Lancer les tests unitaires
- Déploiement de la partie back