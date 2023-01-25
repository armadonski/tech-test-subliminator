#!/bin/bash
RET=1
echo "Waiting for database"
while [[ RET -ne 0 ]]; do
    sleep 1;
    if [ -z "${db_password}" ]; then
        mysql -h $db_host -u $db_user -e "select 1" > /dev/null 2>&1; RET=$?
    else
        mysql -h $db_host -u $db_user -p$db_password -e "select 1" > /dev/null 2>&1; RET=$?
    fi
done