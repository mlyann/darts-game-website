#!/bin/bash

# MySQL database credentials
DB_HOST="darts-dev.co4398xc5nn7.us-east-1.rds.amazonaws.com"
DB_PORT="3306"
DB_USER="admin"
DB_PASS="QFSFKOOj1pE3VPwu7KFm"
DB_NAME="darts"

# SQL query to execute


# Run the mysql command with the specified parameters
mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" -D "$DB_NAME"