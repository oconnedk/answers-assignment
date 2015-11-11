#!/bin/sh
BASEDIR=$(dirname $0)
consoleCmd="php $BASEDIR/../app/console"

# drop the database if it already exists
$consoleCmd doctrine:database:drop --if-exists --force

# now create the database
$consoleCmd doctrine:database:create
