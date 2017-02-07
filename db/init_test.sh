#!/bin/sh

sudo -u postgres dropdb meneame_test
sudo -u postgres createdb -O meneame meneame_test
