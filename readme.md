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


## Ajouter des données de tests

``` bash
symfony console doctrine:fixtures:load
```

## Pour se connecter à la base de donnée

```bash

mysql -p
use main
```

## Envoie des mails de contacts

Les mails de prise de contact sont stockées dans la base de données, pour les envoyer au peintre par mail, il faut mettre en place un cron sur:

``` bash
symfony console app:send-contact
```