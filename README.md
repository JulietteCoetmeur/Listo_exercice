# Listo Exercice

## Set-up

This exercice uses PHPunit for unit testing. After cloning the repository, you need to install it using composer :
```bash
composer install
```

## Instructions

En paie, nous travaillons avec des périodes.
La période mensuelle est la plus courante, notamment parce qu'elle correspond au rythme d'édition des bulletins de paie.
Elle commence le premier jour du mois à minuit (inclus) et termine le premier jour du mois suivant à minuit (exclus). 
D'autres périodes existent dans le métier de la paie, par exemple les périodes d'absence comme les congés.

Etant donné qu'un salarié a posé des congés, j'ai besoin de la fonction sur la période mensuelle isInclusDansPeriode(Absence $absence): bool
pour déterminer si je dois prendre en compte cette absence lors du calcul du bulletin correspondant à la période mensuelle en cours.

La fonction doit avoir des tests unitaires associés pour valider le fonctionnement attendu, ces tests doivent couvrir les cas aux limites.

## Test

You can run some predefined tests on your function using 
```bash
vendor/bin/phpunit tests
```

