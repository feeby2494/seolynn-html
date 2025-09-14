#!/bin/bash

######################################

#  Short test to cp test file to remote server 

# accepts args for:

# 1. skipping for now





rsync -avz -e "sudo -u $USER ssh" --progress ./test.text root@143.198.65.139:/var/www/seolynn/