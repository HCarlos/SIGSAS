#!/usr/bin/env bash
git remote set-url origin https://github.com/HCarlos/SIGSAS.git

## Token     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      10-06-2022

git config --global user.email "r0@tecnointel.mx"
git config --global user.name "HCarlos"
git config --global color.ui true
git config core.fileMode false
git config --global push.default simple

git checkout master

git status

git rm --cached /.env
git rm -r --cached .env
git rm -r --cached .env.example
git rm -r --.gitattributes
git rm -r --.styleci.yml
git rm -r --.editorconfig

git rm -r --cached .gitignore
git rm -r --cached .gitattributes
git rm --cached *.sh
git rm -r --cached .idea
git rm -r --cached otros

git rm -r --cached .
git rm -r --cached composer.json postgres
git rm -r --cached composer.lock

git add .

git commit -m "SIGSAS - A29-C | Alfa L8.83.5"

## git push -u origin master
git push -u origin master --force

exit

