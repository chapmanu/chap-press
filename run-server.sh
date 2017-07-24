#!/bin/bash

HOST=0.0.0.0
PORT=8222
DOCROOT="$(pwd)/public"
INIFILE="$(pwd)/config/php.ini"
PHP=$(which php)

if [ $? != 0 ] ; then
 echo "Unable to find PHP"
 exit 1
fi

echo "server is running ..."

$PHP -S $HOST:$PORT -c $INIFILE -t $DOCROOT

