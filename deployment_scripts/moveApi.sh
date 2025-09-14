#!/bin/bash

######################################

#  Moves all api folder recursivly to remote server
# keeps default permissions; next script will change these on remote server

# accepts args for:

# 1. skipping for now; no args





rsync -avz --exclude '../api/venv' -e "sudo -u $USER ssh" --progress ../api root@143.198.65.139:/var/www/seolynn/