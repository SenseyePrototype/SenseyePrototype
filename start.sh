#!/usr/bin/env bash

sudo service apache2 stop
sudo service elasticsearch start
sudo bin/console server:run --port=80