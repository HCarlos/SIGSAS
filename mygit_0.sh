#!/usr/bin/env bash
echo "# WebAPP" >> README.md
echo "## SIGSAS" >> README.md
git init
git add README.md
git commit -m "Init Commit"
git remote add origin https://github.com/HCarlos/SIGSAS.git
## Token      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
git push -u origin master

echo "" > .gitignore
git add .gitignore
git commit -m "message" .gitignore

git remote set-url origin https://github.com/HCarlos/SIGSAS.git
git config --global user.email "r0@tecnointel.mx"
git config --global user.name "HCarlos"
git config --global color.ui true
git config core.fileMode false
git config --global push.default simple

git checkout master

git status

git add .

git commit -m "Init Commit"

git push -u origin master --force

exit
