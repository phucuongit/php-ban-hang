#!/bin/bash
myInput=
case "$1" in
    build)
        sudo rm -R ./db
        docker-compose -f ./docker-compose.dev.yml up --build -d
        ;;
esac