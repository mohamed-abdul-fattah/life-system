# Overview
Life system is built to watch your daily life and utilize your time and money wisely.

# Configurations
## Environment Variables
Copy and rename the configs.php.example to configs.php, then change the values to what values correspond to your environment.

# Database Architecture
## Transactions Table

| Field      | Type                | Null | Key | Default             | Extra          |
|------------|---------------------|------|-----|---------------------|----------------|
| id         | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
| amount     | decimal(20,2)       | NO   |     | NULL                |                |
| comment    | varchar(255)        | NO   |     | NULL                |                |
| created_at | timestamp           | YES  |     | current_timestamp() |                |