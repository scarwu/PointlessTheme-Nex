#!/bin/sh

cd `dirname $0`

# Init & Update Git Sub-modules
git submodule init
git submodule update

# Install Compoer Packages
composer install

# Install Node Packages
yarn install
