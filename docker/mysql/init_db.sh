#!/bin/bash

mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "DROP DATABASE ${MYSQL_DB}";
mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "CREATE DATABASE ${MYSQL_DB}";
mysql -u root -p${MYSQL_ROOT_PASSWORD} ${MYSQL_DB} < /docker-entrypoint-initdb.d/init.sql