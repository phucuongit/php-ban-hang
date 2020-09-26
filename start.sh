#!/bin/bash
myInput=
case "$1" in
    build)
        sudo rm -R ./db
        docker-compose up --build --force-recreate
        ;;
esac