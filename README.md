# Cit-E Cycling Web Portal

A PHP and MySQL web application developed for my **CET138 Full Stack Development** assignment. It provides a public interest-registration form and an administrator area for managing cycling participant records.

## Overview

The portal supports a cycling-event scenario. Visitors can register their interest in future events, while an administrator can log in to search participant and club information and manage participant performance records.

## Features

- Public interest-registration form
- Store registration details in MySQL
- Administrator login and logout
- Search participants by first name or surname
- Search clubs by club name
- Display club totals and averages for distance and power output
- Edit participant distance and power output
- Delete participant records with confirmation
- Responsive Bootstrap-based interface
- Custom CSS styling

## Technology stack

- PHP
- MySQL
- HTML5 and CSS3
- Bootstrap 5
- XAMPP for local development

## Project structure

| File | Purpose |
| --- | --- |
| `index.html` | Home page |
| `register_form.html` | Public interest form |
| `register.php` | Saves interest form data |
| `admin_login.html` | Administrator login page |
| `login.php` | Processes administrator login |
| `admin_menu.php` | Administrator menu |
| `search_form.php` | Participant and club search form |
| `search_result.php` | Displays search results |
| `view_participants_edit_delete.php` | Participant management list |
| `edit_participant.php` | Updates participant performance data |
| `delete.php` | Deletes a participant after confirmation |
| `logout.php` | Ends the administrator session |
| `dbconnect.php` | Database connection configuration |
| `styles.css` | Custom styles |
| `cycling.sql` | Database schema and sample data |

## Run locally

### 1. Install and start XAMPP

Start **Apache** and **MySQL** from the XAMPP control panel.

### 2. Copy the project

Place the repository folder in your XAMPP web root, for example:

```text
C:\xampp\htdocs\cycling
```

### 3. Create and import the database

1. Open [phpMyAdmin](http://localhost/phpmyadmin).
2. Create a database named `cycling`.
3. Select the database and import `cycling.sql`.

### 4. Check the database connection

Review `dbconnect.php` and update the local connection values to match your XAMPP setup. Do not use production credentials in a public repository.

### 5. Open the portal

Visit:

```text
http://localhost/cycling/
```

## Demo administrator account

The repository's sample database documents a default demo login:

```text
Username: admin
Password: password123
```

Change or remove sample credentials before any public deployment. This coursework application should be security-reviewed before handling real participant information.

## Scope and limitations

- Built as a coursework project and local demonstration.
- The included SQL file is the source of truth for the database structure.
- The current implementation is not presented as a production-ready event-management service.

## Author

**Pratik Poudel** · [GitHub](https://github.com/pyatrick666)
