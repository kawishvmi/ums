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

5. **Insert Initial Data**
   - Execute the following SQL command to create initial admin and user records:
     ```sql
     INSERT INTO `user` (`username`, `email`, `password`, `auth_key`, `created_at`, `updated_at`, `role`)
     VALUES 
     ('admin', 'admin@example.com', 'hashed-password', 'random-auth-key', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 'admin'),
     ('kawish99', 'kawish@example.com', 'hashed-password', 'random-auth-key', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 'user');
     ```
     - Replace `hashed-password` with the actual hashed passwords.

   - Alternatively, you can upload the `user_management.sql` file located in the repository. This file contains the following users:
     - **Admin**
       - Username: `admin`
       - Password: `admin`
     - **User**
       - Username: `kawish99`
       - Password: `12345678`

**Challenges**
- Date Formatting: Adjusted SQL queries to handle dates correctly.
- Testing: Ensured thorough testing of login functionality, roles, and CRUD operations.

**Design Decisions**
- MVC Architecture: Applied the Model-View-Controller pattern.
- RBAC: Implemented Role-Based Access Control.
 -Responsive UI: Utilized Bootstrap 5 for responsive design.
- Chart Visualization: Used Chart.js for visualizing user registration trends.

**screenshots**
![admin-dashbaord](https://github.com/user-attachments/assets/dec8d653-4328-427f-8d87-ad7355aaba7d)
![admin-home](https://github.com/user-attachments/assets/d62d1976-6339-4da3-9e2b-ada96785b02a)
![create-user](https://github.com/user-attachments/assets/26084b5b-4fb6-4860-b812-846232f6afc6)
![delete-user](https://github.com/user-attachments/assets/f3dc986c-b3b2-4470-aeef-bbaf3f24eb9d)
![main-login-page](https://github.com/user-attachments/assets/e21a6103-2377-4999-9299-8748bc1b2213)
![update-user](https://github.com/user-attachments/assets/10541c77-4ad5-42c7-9739-ace1c3ea4b4d)
![user-management](https://github.com/user-attachments/assets/17d58826-fb5b-4281-a5aa-6fcf569ced8f)
![user-profile](https://github.com/user-attachments/assets/d57611e7-629a-45a1-8ce7-96e6010bc9a9)
![view-user](https://github.com/user-attachments/assets/0f9b1e94-0e97-4b05-8e35-10af0e87ddb6)










**Contact Me**
Kawishfazal@hotmail.com
