#!/bin/sh
BASEDIR=$(dirname $0)
consoleCmd="php $BASEDIR/../app/console"

# drop the database if it already exists
$consoleCmd doctrine:database:drop --if-exists --force

# now create the database
$consoleCmd doctrine:database:create

# setup entity structure in the database
$consoleCmd doctrine:schema:update --force

# load entities
$consoleCmd doctrine:fixtures:load --append