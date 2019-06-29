![release 1.1.0](https://img.shields.io/badge/release-1.1.0-blue.svg)
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
| id         | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment                |
| amount     | decimal(20,2)       | NO   |     | NULL                |                               |
| comment    | varchar(255)        | NO   |     | NULL                |                               |
| created_at | timestamp           | YES  |     | current_timestamp() |                               |
| updated_at | timestamp           | YES  |     | NULL                | on update current_timestamp() |

#### tags Table
| Field      | Type                | Null | Key | Default             | Extra                         |
|------------|---------------------|------|-----|---------------------|-------------------------------|
| id         | int(11) unsigned    | NO   | PRI | NULL                | auto_increment                |
| name       | varchar(100)        | NO   |     | NULL                |                               |
| created_at | timestamp           | YES  |     | current_timestamp() |                               |
| updated_at | timestamp           | YES  |     | NULL                | on update current_timestamp() |

#### tag_transaction Table
| Field          | Type                | Null | Key | Default             | Extra |
|----------------|---------------------|------|-----|---------------------|-------|
| transaction_id | int(10) unsigned    | NO   | PRI | NULL                |       |
| tag_id         | int(10) unsigned    | NO   | PRI | NULL                |       |
| created_at     | timestamp           | YES  |     | current_timestamp() |       |
