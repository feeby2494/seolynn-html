#!/bin/bash

######################################

#  Moves updated frontend for seolynn siter to remote server 

# accepts args for:

# 1. skipping for now; none




# How to eclude api folder? 
rsync -avz --exclude '../api' -e "sudo -u $USER ssh" --progress ../ root@143.198.65.139:/var/www/seolynn/