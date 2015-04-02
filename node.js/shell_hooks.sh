#!/bin/sh
while read oldrev newrev refname
do
    branch=$(git rev-parse --symbolic --abbrev-ref $refname)
    if [ "master" = "$branch" ]; then
        git --work-tree=/var/www/bazcorp --git-dir=/home/git/repositories/bazcorp.git checkout -f
		echo "Copy sources from $branch to /var/www/bazcorp ..."
    elif [ "dev_roy" = "$branch" ]; then
        git --work-tree=/var/www/bazcorp_roy --git-dir=/home/git/repositories/bazcorp.git checkout -f dev_roy
		echo "Copy sources from $branch to /var/www/bazcorp_roy ..."
    elif [ "dev_outsource" = "$branch" ];then
        git --work-tree=/var/www/bazcorp_hanan --git-dir=/home/git/repositories/bazcorp.git checkout -f dev_outsource
		echo "Copy sources from $branch to /var/www/bazcorp_hanan ..."
    elif [ "dev_sapta" = "$branch" ];then
        git --work-tree=/var/www/bazcorp_sapta --git-dir=/home/git/repositories/bazcorp.git checkout -f dev_sapta
		echo "Copy sources from $branch to /var/www/bazcorp_sapta ..."
    else
		git --work-tree=/var/www/bazcorp_temp --git-dir=/home/git/repositories/bazcorp.git checkout -f
		echo "Copy sources from $branch to /var/www/bazcorp_temp ..."
	fi
done
