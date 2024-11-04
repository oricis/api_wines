# Simple Symfony API

This is a basis API App using Symfony.

Four entities and some related endpoints will be used to handle data of *users*, 
*sensors*, *wines* and *measurements*.

***

## How to run the app on development

You need to have a LAMP stack with Composer prepared,
[install the Symfony CLI](https://symfony.com/download#step-1-install-symfony-cli) 
and check the Synfony requirements `symfony check:requirements`
before **running the local server**.

Start the server:

    cd my-project/
    symfony server:start -d

*Add `-d` to run the server in the background and continue using the console.*

Stop the server:

    symfony server:stop

Watch last server log (only when the server is running):

    symfony server:log

**Open the application** in the web browser:

    http://localhost:8000

***NOTE:** restart the server after every "composer.json" modification.*

More details on: https://symfony.com/doc/current/setup/symfony_server.html

***

## DB

### ER schema

    |-------|   |-------| 1   N |--------------| N   1 |---------|
    | users |   | wines |-------| measurements |-------| sensors |
    |-------|   |-------|       |--------------|       |---------|

Where:
 - The *users* can interact with the different entities but these actions
are not registered.
 - Each *measurement* is related to one *wine* and uses one *sensor*.

### Set DB settings

Doc from https://symfony.com/doc/current/doctrine.html

### Create DB tables

Run the ***migrations*** with the command:

    php bin/console doctrine:migrations:migrate

## API routes

#### Public routes

    POST   | [domain]/api/v1/login

#### Private routes

    POST   | [domain]/api/v1/measurement      # register a measurement

    GET    | [domain]/api/v1/sensor           # index ABC ASC
    POST   | [domain]/api/v1/sensor           # register a sensor

    GET    | [domain]/api/v1/wine/measurement # index wines with their measurements

Check [Openapi document](./docs/api/v1/openapi:3.0.yml)

***NOTE:** the routes are on the controllers as*
*[attributes](https://symfony.com/doc/current/best_practices.html#best-practice-controller-attributes).*

***

## App Directories Tree

// TODO:

***

## Run checks/tests

### Check code with PHPStan

Run the command (check two directories, max level is 9):

    ./vendor/bin/phpstan analyze --level 5 src/Domain src/Util/Helpers

Start with an intermediate level, as 5 and increase the level after applying
corrections.

*PHPStan doc: https://phpstan.org/user-guide/getting-started*

### Check code with PHP Mesh Detector

Run the command:

    composer run phpmd

If no mesh code is detected the terminal shows code 0, in other cases check
the output file: "storage/output/phpmd.json".

***NOTE:** the command is set in the composer.json file (section "scripts")*
*and it's using the "cleancode,codesize,unusedcode,naming" rulesets*
*to analyse the code.*

You can use one or var of *the rulesets*:

<ul>
    <li><a target="_self" href="http://phpmd.org/rules/cleancode.html">cleancode</a></li>
    <li><a target="_self" href="http://phpmd.org/rules/codesize.html">codesize</a></li>
    <li><a target="_self" href="http://phpmd.org/rules/controversial.html">controversial</a></li>
    <li><a target="_self" href="http://phpmd.org/rules/design.html">design</a></li>
    <li><a target="_self" href="http://phpmd.org/rules/naming.html">naming</a></li>
    <li><a target="_self" href="http://phpmd.org/rules/unusedcode.html">unusedcode</a></li>
</ul>

*PHP Mesh Detector doc: https://phpmd.org/documentation/index.html*

### Run unitary test (PHPUnit)

Example:

    vendor/bin/phpunit tests/Unit/Services/FooService --color

*PHPUnit doc: https://phpunit.de/documentation.html*

***NOTE:** Before running tests that require the DB, run the tests migrations:*

    php bin/console doctrine:migrations:migrate --env=test


***

#### [See the app docs here)](./docs/main.md)

#### [Code Repository)](https://github.com/oricis/api_wines)

#### [Visit the author's website here](https://www.ironwoods.es)

Copyright (c) 2024 Moisés Alcocer
