# User Management System

## Developer
**Kawish Fazal**

## Introduction
This document provides setup instructions, design decisions, and testing guidelines for the User Management System.

## Technologies Used
- **Yii2 Framework**
- **MySQL**
- **Chart.js**
- **Bootstrap 5**
- **Font Awesome**

## Setup Instructions

1. **Download the Repository**
   - Clone or download the repository to your local machine.

2. **Install Dependencies**
   ```bash
   composer install
3. **Configure Database** 
    Edit the config/db.php file with your database credentials:
    ```return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=<database-name>',
    'username' => '<username>',
    'password' => '<password>',
    'charset' => 'utf8',
];

4. **Run Migrations**
    ```bash
    php yii migrate

5. ***Insert Initial Admin Record**
  Execute the following SQL command to create an initial admin user
   OR you can upload myDB also it is in the files name **user_management.sql**
  there are 2 users for admin ==> username : admin , Password : admin 
  for user ==> username : kawish99, Pasword : 12345678
  ```INSERT INTO `user` (`username`, `email`, `password`, `auth_key`, `created_at`, `updated_at`, `role`)
VALUES ('admin', 'admin@example.com', 'hashed-password', 'random-auth-key', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 'admin');

**Challenges**
- Date Formatting: Adjusted SQL queries to handle dates correctly.
- Testing: Ensured thorough testing of login functionality, roles, and CRUD operations.

**Design Decisions**
- MVC Architecture: Applied the Model-View-Controller pattern.
- RBAC: Implemented Role-Based Access Control.
 -Responsive UI: Utilized Bootstrap 5 for responsive design.
- Chart Visualization: Used Chart.js for visualizing user registration trends.

**Contact Me**
Kawishfazal@hotmail.com
