# Cit-E Cycling Web Portal

A PHP and MySQL web application built for my **CET138 Full Stack Development** assignment. This project provides a simple public-facing interest registration form and a secure admin area for managing cycling event participant data.

## Project Introduction
The **Cit-E Cycling Web Portal** is a dynamic data-driven website created for a cycling competition management scenario. The system allows users to register their interest for future events, while administrators can securely log in to search participant and club information, edit participant scores, delete participants, and log out safely. The project uses **PHP**, **MySQL**, **Bootstrap**, and custom CSS, and is designed to run locally using **XAMPP**.

## Features
- Register interest for future cycling events
- Save interest form data into the database
- Secure admin login and logout
- Search participants by first name or surname
- Search clubs by club name
- Display club totals and averages for distance and power output
- Edit participant power output and distance
- Delete participants with confirmation
- Bootstrap-based responsive design
- Custom hover styling for cards and buttons

## Technologies Used
- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap 5
- XAMPP

## Project Structure
- `index.html` - Home page
- `register_form.html` - Register interest form
- `register.php` - Saves interest form data
- `admin_login.html` - Admin login page
- `login.php` - Authenticates admin login
- `admin_menu.php` - Admin dashboard
- `search_form.php` - Search form for participants and clubs
- `search_result.php` - Displays participant and club search results
- `view_participants_edit_delete.php` - Lists participants for editing or deletion
- `edit_participant.php` - Updates participant scores
- `delete.php` - Deletes participants after confirmation
- `logout.php` - Logs admin out and redirects to home page
- `dbconnect.php` - Database connection settings
- `styles.css` - Custom styling
- `cycling.sql` - Database structure and sample data

## Setup Instructions
### 1. Install XAMPP
Install XAMPP on Windows and start:
- Apache
- MySQL

### 2. Place Project Files
Copy the project folder into:

```text
C:\xampp\htdocs\cycling
```

### 3. Create the Database
Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
cycling
```

### 4. Import SQL File
- Select the `cycling` database
- Click `Import`
- Choose `cycling.sql`
- Click `Go`

### 5. Configure Database Connection
Edit `dbconnect.php`:

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cycling";
?>
```

### 6. Run the Project
Open in browser:

```text
http://localhost/cycling/
```

## Admin Login
Use the default admin credentials from the database:

```text
Username: admin
Password: password123
```

## Notes
- The database structure was kept unchanged to match the provided SQL file.
- The `interest` table stores only firstname, surname, email, and terms acceptance.
- For now, this project was only developed to meet assignment requirements but also i'll work on it in the future.

## Author
Pratik Poudel aka Patrick
