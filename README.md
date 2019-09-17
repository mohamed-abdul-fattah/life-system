![release 1.4.0](https://img.shields.io/badge/release-1.4.0-blue.svg)
# Overview
Life system is built to watch your daily life and utilize your time and money wisely.

# Configurations
## Environment Variables
Copy and rename the configs.php.example to configs.php, then change the values to what values correspond to your environment.
## Dependencies
Run `composer install` to install the project dependencies.

Run `./vendor/bin/phpunit` to run the unit tests.

# Database Architecture
## Tables Structure
#### transactions Table
| Field      | Type                | Null | Key | Default             | Extra                         |
|------------|---------------------|------|-----|---------------------|-------------------------------|
| id         | bigint(20) unsigned | NO   | PRI | None                | AUTO_INCREMENT                |
| category_id| int(11)    unsigned | YES  |     | NULL                |                               |
| amount     | decimal(20,2)       | NO   |     | None                |                               |
| comment    | varchar(255)        | NO   |     | None                |                               |
| created_at | timestamp           | YES  |     | CURRENT_TIMESTAMP	  |                               |
| updated_at | timestamp           | YES  |     | NULL                | ON UPDATE CURRENT_TIMESTAMP   |

#### categories Table
| Field      | Type                | Null | Key | Default             | Extra                         |
|------------|---------------------|------|-----|---------------------|-------------------------------|
| id         | int(10) unsigned    | NO   | PRI | NULL                | AUTO_INCREMENT                |
| name       | varchar(100)        | NO   |     | None                |                               |
| created_at | timestamp           | YES  |     | CURRENT_TIMESTAMP   |                               |
| updated_at | timestamp           | YES  |     | NULL                | ON UPDATE CURRENT_TIMESTAMP   |
| deleted_at | timestamp           | YES  |     | NULL                |                               |
