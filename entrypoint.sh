#!/bin/sh
set -e

composer install
npm install --dev

exec "$@"
