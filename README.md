Integration Service Tests for Kernel service
========================================================

##description
Autotests in this framework are using API-testing for branded clothing internet shop. Framework uses:
1. PHP 7.3 with composer
2. Codeception testing framework
3. Gazzle client

This framework is only for skills demonstration. Tests executing is possible only with installing core framework. The core-framework is missing here, because of it was not develeped by your humble servant -)
 
## local install
1. Install core framework
2. Execute `composer install`
 
## how to execute this tests (linux and macos)
1. Install local docker
2. Execute in folder with project  `sh run_tests_in_docker.sh codeception-prod.yml`  
(parameter is Codeception config file)  
3. HTML-report will be in folder output
  
## how to execute tests with environment
on prod: `php vendor/bin/codecept run -c codeception-prod.yml`  
on stage: `php vendor/bin/codecept run -c codeception-stage.yml`

## how to execute one test
`php vendor/bin/codecept run tests/search/CheckSearchEngineCest -c codeception-prod.yml`
