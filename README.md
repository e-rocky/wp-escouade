# Escouade — WordPress / Aura

Site WordPress basé sur Bedrock, avec le thème personnalisé Aura, des blocs Gutenberg et des composants React/TypeScript. Les dépendances PHP sont gérées avec Composer ; les ressources du thème sont compilées avec Vite et les blocs avec WordPress Scripts.

## Prérequis

- Git.
- Docker Engine démarré et le plugin Docker Compose disponibles sous Linux.
- Node.js 22 LTS et npm pour compiler les ressources sur la machine hôte.

PHP 8.3, Apache, Composer et WP-CLI sont fournis par le Dockerfile. MySQL et phpMyAdmin utilisent leurs propres images. Les commandes ci-dessous s’exécutent dans un terminal Bash, depuis la racine du dépôt.

## Installation locale

### 1. Configurer l’environnement

Créer `.env` à partir de `.env.example` uniquement si `.env` n’existe pas déjà :

```bash
if [ ! -e .env ]; then
  cp .env.example .env
fi
```

Adapter les paramètres pour Docker :

```dotenv
DB_NAME='wordpress'
DB_USER='wordpress'
DB_PASSWORD='wordpress'
DB_HOST='db'
DB_PREFIX='wp_'
WP_ENV='development'
WP_HOME='http://esccouade.localhost:8080'
WP_SITEURL='http://esccouade.localhost:8080/wp'
```

Renseigner des clés et sels d’authentification propres à l’environnement (`AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY` et les quatre variables `*_SALT`). Ne pas réutiliser les identifiants personnels présents dans le modèle. Le préfixe `DB_PREFIX` doit correspondre aux tables de la base importée. Si `DATABASE_URL` est définie, elle prend le dessus sur les paramètres `DB_*` : la retirer ou l’adapter pour Docker.

Les valeurs définies dans `environment` de `docker-compose.yml` prennent le dessus sur celles de `env_file: .env`. Garder `WP_HOME` et `WP_SITEURL` identiques dans les services `wordpress` et `wpcli`.

**État actuel du fichier Compose :** `wordpress` utilise `esccouade.localhost`, tandis que `wpcli` utilise encore `localhost`. Harmoniser ces valeurs avant utilisation. Le nom `esccouade` comporte deux « c » dans la configuration actuelle ; si vous choisissez `escouade.localhost`, le modifier partout, y compris dans les commandes ci-dessous.

### 2. Construire les images et installer les dépendances PHP

```bash
docker compose build
docker compose run --rm --no-deps wordpress composer install
docker compose run --rm --no-deps wordpress composer install --working-dir=web/app/themes/aura
```

Les fichiers sont partagés avec les conteneurs via un volume : Composer installe les dépendances directement dans le dossier du projet. Utiliser `composer install` pour respecter les versions des fichiers `composer.lock`.

### 3. Installer et compiler les ressources

```bash
npm run install:all
npm run build:all
```

### 4. Démarrer les services

```bash
docker compose up -d wordpress phpmyadmin
```

MySQL démarre automatiquement en tant que dépendance. Importer ensuite une base existante selon la procédure ci-dessous, ou terminer l’installation d’un site neuf depuis l’administration WordPress.

| Service | Adresse / accès |
| --- | --- |
| Site | http://esccouade.localhost:8080 |
| Administration WordPress | http://esccouade.localhost:8080/wp/wp-admin/ |
| phpMyAdmin | http://localhost:8081 |
| MySQL depuis les conteneurs | `db:3306` |

Dans phpMyAdmin, utiliser `wordpress` comme utilisateur et mot de passe. Ces identifiants sont ceux du développement local ; les identifiants de connexion à l’administration WordPress sont distincts et proviennent de la base importée.

## Importer la base de données

Placer l’export à la racine sous le nom `database.sql`, puis exécuter :

```bash
docker compose up -d db
docker compose cp ./database.sql db:/tmp/database.sql
docker compose exec db sh -c 'mysql -uwordpress -pwordpress wordpress < /tmp/database.sql'
```

Attendre que MySQL soit prêt avant l’import (`docker compose ps`). Un export contenant des instructions `DROP TABLE` remplacera les tables existantes : sauvegarder d’abord les données à conserver.

L’import SQL ne restaure pas les médias. Récupérer également le dossier `web/app/uploads` de l’environnement source.

### Remplacer l’URL du site importé

Remplacer `https://escouade.mg` par l’URL réellement utilisée dans la base source. Effectuer d’abord une simulation :

```bash
docker compose run --rm wpcli --allow-root search-replace 'https://escouade.mg' 'http://esccouade.localhost:8080' --all-tables-with-prefix --skip-columns=guid --dry-run
```

Après vérification, appliquer :

```bash
docker compose run --rm wpcli --allow-root search-replace 'https://escouade.mg' 'http://esccouade.localhost:8080' --all-tables-with-prefix --skip-columns=guid
```

WP-CLI préserve les données sérialisées. Éviter un remplacement global manuel dans le fichier SQL.

## Exporter la base de données

Utiliser les outils MySQL du conteneur `db` :

```bash
docker compose exec db sh -c 'mysqldump -uwordpress -pwordpress --single-transaction --no-tablespaces wordpress > /tmp/sauvegarde.sql'
docker compose cp db:/tmp/sauvegarde.sql ./sauvegarde.sql
```

Le fichier `sauvegarde.sql` est créé sur la machine hôte. Cette procédure ne nécessite pas l’installation de `mysqldump` sur celle-ci. Le Dockerfile PHP actuel ne fournit pas le client MySQL : privilégier ces commandes à `wp db export` dans le service `wpcli`.

## Commandes Docker courantes

```bash
# Voir l’état des services
docker compose ps

# Consulter les logs Apache / PHP
docker compose logs -f wordpress

# Redémarrer les services déjà créés
docker compose restart

# Appliquer une modification de .env ou de docker-compose.yml
docker compose up -d --force-recreate

# Reconstruire après modification du Dockerfile
docker compose up -d --build

# Arrêter les services sans supprimer les conteneurs
docker compose stop

# Supprimer les conteneurs en conservant la base
docker compose down
```

La base est conservée dans le volume nommé `db_data`. **`docker compose down -v` supprime ce volume et ses données.** Le service `wpcli` exécute une commande puis s’arrête : il n’a pas vocation à rester actif.

## WP-CLI

Le fichier `wp-cli.yml` définit déjà `path: web/wp`. Exemples :

```bash
docker compose run --rm wpcli --allow-root --info
docker compose run --rm wpcli --allow-root plugin list
docker compose run --rm wpcli --allow-root theme activate aura
docker compose run --rm wpcli --allow-root cache flush
```

## Développement du thème et des blocs

| Commande | Usage |
| --- | --- |
| `npm run start:aura` | Démarrer le serveur de développement Vite |
| `npm run watch:aura` | Recompiler les ressources du thème à chaque modification |
| `npm run start:blocks` | Recompiler les blocs Gutenberg à chaque modification |
| `npm run build:aura` | Vérifier TypeScript et compiler le thème |
| `npm run build:blocks` | Compiler les blocs Gutenberg |
| `npm run build:all` | Compiler le thème et les blocs |

Lancer la surveillance du thème et celle des blocs dans deux terminaux si nécessaire. Pour travailler avec Apache dans Docker à partir des fichiers compilés, utiliser `watch:aura`.

## Organisation du projet

```text
config/                         Configuration Bedrock
web/wp/                         Cœur WordPress installé par Composer
web/app/plugins/                Extensions installées par Composer
web/app/uploads/                Médias
web/app/themes/aura/
  app/                          Logique PHP du thème
  app/blocks/src/               Sources des blocs Gutenberg
  resources/views/              Templates Blade
  src/js/                       Composants React et scripts TypeScript
  src/scss/                     Styles du thème
  public/build/                 Ressources compilées
Dockerfile                      Image PHP / Apache, Composer et WP-CLI
docker-compose.yml              Services et volumes locaux
docker/apache/                  Configuration Apache (racine publique : web/)
docker/php/                     Configuration PHP
```

## Fichiers à versionner

Conserver dans Git les sources, les configurations Docker, les manifestes de dépendances et leurs fichiers de verrouillage (`composer.lock`, `package-lock.json`).

Ne pas versionner `.env`, les exports SQL, les médias ni les dépendances générées. Vérifier les règles `.gitignore`, notamment pour `/database.sql` et `/sauvegarde.sql`, avant de créer un commit. Le volume Docker `db_data` n’est pas situé dans le dépôt.

## Dépannage

- **`Dockerfile: no such file or directory`** : exécuter Compose à la racine du projet et vérifier la présence du `Dockerfile`.
- **Erreur de connexion à MySQL** : contrôler `docker compose ps`, les logs `docker compose logs db`, les variables `DB_*` et le préfixe des tables. Modifier les mots de passe dans Compose ne change pas ceux d’un volume MySQL déjà initialisé.
- **Ancienne URL après modification de `.env`** : vérifier les valeurs `environment` dans Compose, recréer les conteneurs et remplacer les URL stockées en base avec WP-CLI.
- **Déconnexion phpMyAdmin après inactivité** : se reconnecter ; les données enregistrées sont conservées. Utiliser le terminal pour les imports volumineux.
- **Port 8080 ou 8081 occupé** : modifier le port publié dans Compose, puis adapter les URL concernées.
