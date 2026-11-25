# Pratique : Mini service web pour pratiquer les fondamentaux de PHP, AVEC AUTOLOADING

- [Pratique : Mini service web pour pratiquer les fondamentaux de PHP, AVEC AUTOLOADING](#pratique--mini-service-web-pour-pratiquer-les-fondamentaux-de-php-avec-autoloading)
  - [Description](#description)
  - [Remarques](#remarques)
  - [Lancer la démo](#lancer-la-démo)
  - [Tooling](#tooling)
    - [Formateur](#formateur)
    - [Analyse statique/Lint](#analyse-statiquelint)
    - [Tests unitaires](#tests-unitaires)
    - [Génération de la doc de référence](#génération-de-la-doc-de-référence)
  - [Références utiles](#références-utiles)


## Description

Un petit projet de service web fournissant une liste de publications et des informations sur leurs auteurs. Cette démo propose et utilise :

- une pagination des résultats (important sur une ressource *collection*, nous y reviendrons) et une gestion des exceptions;
- une implémentation minimale du protocole HTTP (header et code status)
- **Composer et l'autoloading PSR-4**;
- le **formateur** PHP_CodeSniffer (phpcs et phpcbf) avec les codings standard PSR12;
- l'**analyseur statique** phpStan;
- des tests unitaires avec PHPUnit;
- les *Docblocks* et PHP Documentor pour générer sa doc de référence.

## Remarques

Le format du message retourné par le service laisse encore à désirer et semble construit de manière un peu arbitraire. Nous y reviendrons quand nous aborderons le design de services *RESTful*.

## Lancer la démo

~~~bash
composer install
php -S localhost:5001 -t demo_autoloading
~~~

~~~bash
curl localhost:5001 | jq
~~~

## Tooling

### Formateur

~~~bash
./vendor/bin/phpcs src
~~~

### Analyse statique/Lint

~~~bash
./vendor/bin/phpstan analyze -l6 src
~~~

### Tests unitaires

~~~bash
./vendor/bin/phpunit --testdox tests/
~~~

### Génération de la doc de référence

~~~bash
docker run --rm -v "$(pwd):/data" phpdoc/phpdoc:3 -d src -t docs
~~~

## Références utiles

- [Composer : Basic Usage](https://getcomposer.org/doc/01-basic-usage.md), documentation officielle de Composer
- [PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/), publié par PHP-FIG
- [The VarDumper Component](https://packagist.org/packages/symfony/var-dumper), composant développé par Symfony