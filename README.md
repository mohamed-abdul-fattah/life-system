# Overview
Life system is built to watch your daily life and utilize your time and money wisely.

# Database Architecture
## Transactions Table

| Field      | Type                | Null | Key | Default             | Extra          |
|------------|---------------------|------|-----|---------------------|----------------|
| id         | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
| amount     | decimal(20,2)       | NO   |     | NULL                |                |
| comment    | varchar(255)        | NO   |     | NULL                |                |
| created_at | timestamp           | YES  |     | current_timestamp() |                |