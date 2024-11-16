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

### Seed DB tables

Run the ***fixtures*** with the command:

    php bin/console doctrine:fixtures:load

There are fixtures created to seed the tables: *sensor*, *user* and *wine*.

***

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

***NOTE:** use the `API_TOKEN` value from the `.env`file to validate all the api requests.*

***NOTE:** only the "login" request is public and needs to have* *the `apitoken` header to be recognized as valid, the other routes need*
*to have set the `apitoken` and the `token` (user token) correctly in the headers.*

***

## App Directories Tree

```
api_wines
├─ .env
├─ .env.test
├─ .gitignore
├─ LICENCE
├─ README.md
├─ bin
│  └─ console
├─ composer.json
├─ composer.lock
├─ config/..
├─ docs
│  ├─ api
│  │  └─ v1
│  │     └─ openapi:3.0.yml
│  └─ images
├─ phpmd.baseline.xml
├─ phpstan.dist.neon
├─ phpunit.xml.dist
├─ public
│  └─ index.php
├─ src
│  ├─ Controller
│  │  └─ TokenAuthenticatedController.php
│  ├─ Domain
│  │  ├─ Measurement
│  │  │  ├─ Controller
│  │  │  │  └─ Api
│  │  │  │     └─ V1
│  │  │  │        └─ CreateMeasurementController.php
│  │  │  ├─ Entity
│  │  │  │  └─ Measurement.php
│  │  │  ├─ Event
│  │  │  │  └─ MeasurementEvent.php
│  │  │  ├─ Exception
│  │  │  │  └─ CreateMeasurementException.php
│  │  │  ├─ Repository
│  │  │  │  └─ MeasurementRepository.php
│  │  │  ├─ Service
│  │  │  │  ├─ CreateMeasurementService.php
│  │  │  │  └─ MeasurementResponseService.php
│  │  │  └─ migrations
│  │  │     └─ Version20241104113808.php
│  │  ├─ Sensor
│  │  │  ├─ Controller
│  │  │  │  └─ Api
│  │  │  │     └─ V1
│  │  │  │        ├─ CreateSensorController.php
│  │  │  │        └─ ListSensorController.php
│  │  │  ├─ DataFixtures
│  │  │  │  └─ SensorFixture.php
│  │  │  ├─ Entity
│  │  │  │  └─ Sensor.php
│  │  │  ├─ Event
│  │  │  │  └─ SensorEvent.php
│  │  │  ├─ Exception
│  │  │  │  └─ CreateSensorException.php
│  │  │  ├─ Repository
│  │  │  │  └─ SensorRepository.php
│  │  │  ├─ Service
│  │  │  │  ├─ CreateSensorService.php
│  │  │  │  ├─ QuerySensorService.php
│  │  │  │  └─ SensorResponseService.php
│  │  │  └─ migrations
│  │  │     └─ Version20241104113818.php
│  │  ├─ User
│  │  │  ├─ Controller
│  │  │  │  └─ Api
│  │  │  │     └─ V1
│  │  │  │        └─ AuthUserController.php
│  │  │  ├─ DataFixtures
│  │  │  │  └─ UserFixture.php
│  │  │  ├─ Entity
│  │  │  │  └─ User.php
│  │  │  ├─ Event
│  │  │  │  └─ UserEvent.php
│  │  │  ├─ Exception
│  │  │  │  └─ CreateTokenException.php
│  │  │  ├─ Repository
│  │  │  │  └─ UserRepository.php
│  │  │  ├─ Service
│  │  │  │  ├─ AuthUserService.php
│  │  │  │  └─ AuthenticateUserResponseService.php
│  │  │  └─ migrations
│  │  │     └─ Version20241104113754.php
│  │  └─ Wine
│  │     ├─ Controller
│  │     │  └─ Api
│  │     │     └─ V1
│  │     │        └─ ListWineAndMeasurementsController.php
│  │     ├─ DataFixtures
│  │     │  └─ WineFixture.php
│  │     ├─ Entity
│  │     │  └─ Wine.php
│  │     ├─ Event
│  │     │  └─ WineEvent.php
│  │     ├─ Repository
│  │     │  └─ WineRepository.php
│  │     ├─ Service
│  │     │  ├─ QueryWineService.php
│  │     │  └─ WineWithMeasurementsResponseService.php
│  │     └─ migrations
│  │        └─ Version20241104113832.php
│  ├─ EventSubscriber
│  │  └─ TokenSubscriber.php
│  ├─ Kernel.php
│  ├─ Repository
│  │  └─ BaseRepository.php
│  └─ Util
│     ├─ Exceptions
│     │  └─ RequireSpecificObjectException.php
│     ├─ Helpers
│     │  ├─ Common
│     │  │  ├─ logging.php
│     │  │  ├─ strings.php
│     │  │  └─ traces.php
│     │  └─ loader.php
│     ├─ Interfaces
│     │  ├─ CreateServiceInterface.php
│     │  └─ ResponseServiceInterface.php
│     └─ Misc
│        ├─ ApiUtils.php
│        └─ HttpStatusCode.php
├─ storage
│  └─ output
│     └─ phpmd.json
├─ symfony.lock
├─ templates
├─ tests
│  ├─ Functional
│  │  ├─ App
│  │  │  └─ Domain
│  │  │     ├─ Measurement
│  │  │     │  ├─ Controller
│  │  │     │  │  └─ Api
│  │  │     │  │     └─ V1
│  │  │     │  │        ├─ CreateMeasurementControllerTest.php
│  │  │     │  │        └─ CreateMeasurementServiceTest.php
│  │  │     │  └─ CreateMeasurementTrait.php
│  │  │     ├─ Sensor
│  │  │     │  ├─ Controller
│  │  │     │  │  └─ Api
│  │  │     │  │     └─ V1
│  │  │     │  │        ├─ CreateSensorControllerTest.php
│  │  │     │  │        └─ ListSensorControllerTest.php
│  │  │     │  └─ Repository
│  │  │     │     └─ SensorRepositoryTest.php
│  │  │     ├─ User
│  │  │     │  ├─ Controller
│  │  │     │  │  └─ Api
│  │  │     │  │     └─ V1
│  │  │     │  │        └─ AuthUserControllerTest.php
│  │  │     │  └─ Repository
│  │  │     │     └─ UserRepositoryTest.php
│  │  │     └─ Wine
│  │  │        ├─ Controller
│  │  │        │  └─ Api
│  │  │        │     └─ V1
│  │  │        │        └─ ListWineAndMeasurementsControllerTest.php
│  │  │        ├─ Repository
│  │  │        │  └─ WineRepositoryTest.php
│  │  │        └─ Service
│  │  │           └─ WineWithMeasurementsResponseServiceTest.php
│  │  └─ BrowserTrait.php
│  ├─ Unit
│  │  └─ App
│  │     └─ Util
│  │        └─ Helpers
│  │           └─ Common
│  │              └─ StringsTest.php
│  └─ bootstrap.php
├─ var/..
└─ vendor/..
```

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

### Run test (PHPUnit)

The test classes are grouped into two main directories:

 - tests/Functional/
 - tests/Unit/

The functional tests require setting a test DB.
To create and populate the test DB run the commands:

    symfony console doctrine:database:create --env=test
    symfony console doctrine:schema:update --env=test --force
    php bin/console doctrine:fixtures:load --env=test

To run the test contained in one class run:

    vendor/bin/phpunit route_to_the_test_class/className.php --color
Example:

    vendor/bin/phpunit tests/Functional/App/Domain/User/Controller/Api/V1/AuthUserControllerTest --color

*PHPUnit doc: https://phpunit.de/documentation.html*


***

#### [See the app docs here)](./docs/main.md)

#### [Code Repository)](https://github.com/oricis/api_wines)

#### [Visit the author's website here](https://www.ironwoods.es)

Copyright (c) 2024 Moisés Alcocer
