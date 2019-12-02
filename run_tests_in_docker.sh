#!/usr/bin/env bash

if [ -z "$1" ]; then
    echo "Please, set config file! Example: sh run_tests_in_docker.sh codeception-prod.yml"
    exit 1
fi

pwd=`pwd`

TAG="sakharovmaksim/service-integration-tests-base-image:latest"
echo "Локальный запуск api-тестов, используя docker-image $TAG"

CONTAINER_NAME="my_local_integration_service_tests_run"

# Устанавливаем обработчик сигнала, чтобы контейнер удалился, даже если скрипт завершают досрочно
trap 'docker rm -f $CONTAINER_NAME' 2 15

docker pull $TAG

docker run -di --net=host --name=$CONTAINER_NAME -v $pwd:/local_project $TAG

# Копируем код тестов из --volume папки в папку с предустановленным vendor, чтобы не требовать vendor на хосте
docker exec $CONTAINER_NAME rsync -a /local_project/. /service-tests-core-dir/ --exclude vendor --exclude output --exclude tmp --exclude .git

# Запуск тестов из папки, в которой предустановлен vendor. Установлена опция формирования HTML-отчета (можно выключить)
docker exec $CONTAINER_NAME php /service-tests-core-dir/vendor/bin/codecept run -c /service-tests-core-dir/$1 --html

# Копируем репорты от тестов обратно в --volume-папку local_project
docker exec $CONTAINER_NAME rsync -a /service-tests-core-dir/output/ /local_project/output/

echo "Останавливается и удаляется docker-контейнер $CONTAINER_NAME"
docker rm -f $CONTAINER_NAME