#!/bin/bash

######################################

# Ran after the deployFrontEnd.sh and moveApi.sh
# 0. deployFrontEnd.sh sets correct permissions for all of seolynn
# 1. delete old venv
# 2. create new venv
# 3. activate venv
# 4. install pip requirements.txt
# 5. *SKIPPING*change user/permisions of api daemon file ( already good )
# 5.5 sudo systemctl daemon-reload
# 6. start api daemon
# 7. enable daemon
# 9. check daemon status

######################################
# user for deamon is $USER, hopfully this works
######################################

# accepts args for:

# 1. skipping for now; no args

# Need OS to have:
    # apt-get install build-essential python python3-dev
    # apt install python3.8-venv
    # sudo apt install python3-pip

# Proxy in apache2
    #apt-get install libapache2-mod-wsgi
    #sudo a2enmod uwsgi

ssh -t root@143.198.65.139 "sudo chown -R www-data:www-data /var/www/seolynn"
ssh -t root@143.198.65.139 "sudo chmod -R 755 /var/www/seolynn"

ssh -t root@143.198.65.139 "sudo rm -r /var/www/seolynn/api/venv"

ssh root@143.198.65.139 "/usr/bin/python3 -m venv /var/www/seolynn/api/venv"


ssh root@143.198.65.139 "/var/www/seolynn/api/venv/bin/python3 -m pip install wheel"
ssh root@143.198.65.139 "/var/www/seolynn/api/venv/bin/python3 -m pip install uwsgi flask python-dotenv flask-cors"

ssh -t root@143.198.65.139 "sudo systemctl daemon-reload"

ssh -t root@143.198.65.139 "sudo systemctl start seolynn_test_api.service"

ssh -t root@143.198.65.139 "sudo systemctl enable seolynn_test_api.service"

ssh -t root@143.198.65.139 "sudo systemctl is-active seolynn_test_api.service"
serviceGood=$?

if [ $serviceGood  -eq 0 ]; then
    echo "seolynn_test_api.service is working!";
else
    echo "seolynn_test_api.service is not working, please check";
fi;
