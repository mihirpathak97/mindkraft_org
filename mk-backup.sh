#!/bin/sh

# MySQL backup script
# Copyright (c) 2018 Z Coders
# Author - Mihir Pathak

# Backup Dir
BACKUP=mk_backup
mkdir $BACKUP

# MySQL Configurations
HOST="localhost"
USER=""
PASS=""
DB=""

# Binaries
TAR="$(which tar)"
GZIP="$(which gzip)"
MYSQL="$(which mysql)"
MYSQLDUMP="$(which mysqldump)"

# Date
NOW=$(date +"%d-%m-%y_%H:%M:%S")

mkdir $BACKUP/$NOW

# Backup tables in individual files
for i in `echo "show tables" | $MYSQL -u $USER -h $HOST -p$PASS $DB|grep -v Tables_in_`;
do
  FILE=$BACKUP/$NOW/$i.sql.gz
  echo $i; $MYSQLDUMP --add-drop-table --allow-keywords -q -c -u $USER -h $HOST -p$PASS $DB $i | $GZIP -9 > $FILE
done

# Compress all tables
ARCHIVE=$BACKUP/$NOW.tar.gz
ARCHIVED=$BACKUP/$NOW

$TAR -cvf $ARCHIVE $ARCHIVED
rm -rf $ARCHIVED
