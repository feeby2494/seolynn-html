#!/bin/bash

######################################

#  Moves updated service daemon file for Api Uwsgi server to remote server 

# accepts args for:

# 1. skipping for now; none





rsync -avz -e "sudo -u $USER ssh" --progress /etc/systemd/system/seolynn_test_api.service root@143.198.65.139:/etc/systemd/system/