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

create TABLE Products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_desc VARCHAR(255) NOT NULL UNIQUE,
    users_id int,
    FOREIGN KEY (users_id) REFERENCES users(id)
);
```

## Running the project
```zsh
php -S localhost:8000
```
