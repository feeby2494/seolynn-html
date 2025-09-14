#!/bin/bash

######################################

# Ran after the moveFrontEnd.sh
# 1. Changes permisions and user to what the remote server is setup for (apache2 uses www-data and 755 works)
# 2. Reloads nginx
# 3. test nginx

# accepts args for:

# 1. skipping for now; no args


ssh -t root@143.198.65.139 "sudo chown -R www-data:www-data /var/www/seolynn"
ssh -t root@143.198.65.139 "sudo chmod -R 755 /var/www/seolynn"

ssh -t root@143.198.65.139 "sudo apachectl configtest"
nginxGood=$?
echo $rtrn_code

if [ $nginxGood  -eq 0 ]; then
    ssh -t root@143.198.65.139 "sudo systemctl restart apache2";
else
    echo "Apache2 not working, please check";
fi;