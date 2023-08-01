#!/bin/bash

ssh ubuntu@darts.coretechs.com '
cd /var/www/html/darts-prod/darts-app
git config user.name "Sam Hopkins"
git config user.email "shopkins@coretechs.com"
git checkout prod
git fetch origin
git merge origin/sam-dev
git push origin prod
exit
'