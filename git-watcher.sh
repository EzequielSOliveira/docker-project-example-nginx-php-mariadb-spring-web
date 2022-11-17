#!/bin/sh

BASEDIR="/home/ezequieloliveirapessoal/git/CAPEDAC"

cd $BASEDIR

# git remote update (will update all of your branches set to track remote ones, but not merge any changes in).
# git fetch (will update only the branch you're on, but not merge any changes in.)

git fetch

UPSTREAM=${1:-'@{u}'}
LOCAL=$(git rev-parse @)
REMOTE=$(git rev-parse "$UPSTREAM")
BASE=$(git merge-base @ "$UPSTREAM")

if [ $LOCAL = $REMOTE ]; then
    echo "Up-to-date"
elif [ $LOCAL = $BASE ]; then
    echo "Need to pull"
    git pull
elif [ $REMOTE = $BASE ]; then
    echo "Need to push"
else
    echo "Diverged"
fi
