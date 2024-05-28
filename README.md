# greybath_task

## Create SQL database
```sql
CREATE DATABASE test;

USE test;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash char(60) NOT NULL
);
```

## Running the project
```zsh
php -S localhost:8000
```
