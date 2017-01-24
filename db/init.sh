#!/bin/sh

sudo -u postgres dropuser meneame
sudo -u postgres dropdb meneame
sudo -u postgres psql -c "create user meneame password 'meneame' superuser;"
sudo -u postgres createdb -O meneame meneame
