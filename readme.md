# Projet CDA

Il s'agit d'un site internet permettant à un artiste peintre de publier ses oeuvres.

## Environnement de développement

## Pré-requis

* PHP 
* Symfony CLI 
* Composer
* Docker
* Docker-compose
* nodejs et npm

Vous pouvez vérifier les pré-requis avec la commande suivante : 

```bash
symfony check-requirements
```

### Lancer l'environnement de développement

```bash
composer install
npm i
npm run build
docker-compose up -d
symfony serve -d
```

## Lancer des tests

``` bash
php bin/phpunit --testdox
```