-- mysql -u root -p < ./database/create_db.sql

-- DROP user and then CREATE new user
DROP USER IF EXISTS 'freeads_admin'@'localhost';
FLUSH PRIVILEGES;
CREATE USER IF NOT EXISTS 'freeads_admin'@'localhost' IDENTIFIED BY '22bbcd59-0ac8-43df-9cb5-7767e207ef03';

-- DROP DB and then CREATE DB
DROP DATABASE IF EXISTS freeads_db;
CREATE DATABASE IF NOT EXISTS freeads_db;

FLUSH PRIVILEGES;

GRANT ALL PRIVILEGES ON freeads_db.* TO freeads_admin@localhost WITH GRANT OPTION;