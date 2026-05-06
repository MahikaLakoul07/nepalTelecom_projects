# Nepal Telecom Projects Portal

## Project Overview

Nepal Telecom Projects Portal is a web-based project management system developed using PHP and MySQL. The system is designed to manage software projects, servers, programming languages, databases, and users in an organized way.

The portal allows administrators and users to:

* Manage projects and related information
* Manage servers and databases
* Manage programming languages used in projects
* Register and authenticate users
* Track project-related details in a centralized system

---

# Features

## User Authentication

* User Registration
* User Login
* User Logout
* Session Management

## Project Management

* Add New Projects
* Update Project Details
* Delete Projects
* View Project Information

## Server Management

* Add and Manage Servers
* Store Server Information
* Manage Server Locations and Operating Systems

## Database Management

* Add Database Information
* Track Backup Availability
* Manage Database Versions

## Programming Language Management

* Add Programming Languages
* Store Language Versions
* Manage Languages Used in Projects

## Dashboard

* Centralized Dashboard
* Navigation Between Modules
* User-Friendly Interface

---

# Technology Stack

## Frontend

* HTML
* CSS
* JavaScript

## Backend

* PHP

## Database

* MySQL

## Tools Used

* XAMPP / WAMP Server
* Visual Studio Code
* phpMyAdmin

---

# Folder Structure

```bash
nepalTelecom_projects/
│
├── assets/                 # CSS and image files
├── auth/                   # Login, registration, logout files
├── components/             # Reusable components
├── config/                 # Database connection
├── dashboard/              # Dashboard pages
├── database/               # Database schema
├── index.php               # Main login page
├── manage_projects.php     # Project management
├── manage_servers.php      # Server management
├── manage_databases.php    # Database management
├── manage_languages.php    # Programming language management
└── README.md
```

---

# System Requirements

Before running the project, make sure the following software is installed:

* XAMPP or WAMP Server
* PHP 7 or above
* MySQL
* Web Browser (Chrome Recommended)
* Visual Studio Code (Optional)

---

# How to Run the Project

## Step 1: Download or Clone the Project

Place the project folder inside the `htdocs` directory of XAMPP.

Example:

```bash
C:/xampp/htdocs/nepalTelecom_projects
```

---

## Step 2: Start Apache and MySQL

Open XAMPP Control Panel and start:

* Apache
* MySQL

---

## Step 3: Create the Database

1. Open phpMyAdmin
2. Create a new database named:

```sql
nepaltelecom_projects
```

---

## Step 4: Import Database Schema

1. Open the `database` folder
2. Locate:

```bash
schema.sql
```

3. Import the file into phpMyAdmin

---

## Step 5: Configure Database Connection

Open:

```bash
config/connection.php
```

Update database credentials if necessary:

```php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nepaltelecom_projects";
```

---

## Step 6: Run the Project

Open browser and visit:

```bash
http://localhost/nepalTelecom_projects/
```

---

# Database Tables

The system contains the following major tables:

* users
* projects
* servers
* database_used
* programming_language
* proj_users

---

# Screenshots

You can include screenshots of:

* Login Page
* Registration Page
* Dashboard
* Project Management Page
* Server Management Page
* Database Management Page
* Programming Language Management Page

---

# Challenges Faced

Some challenges faced during development were:

* Managing database relationships
* Handling user authentication securely
* Maintaining proper project structure
* Connecting frontend with backend functionality
* Debugging SQL and PHP errors

These challenges were solved through research, debugging, and testing.

---

# Future Improvements

Possible future improvements include:

* Email Notifications
* Role-Based Access Control
* Advanced Search and Filters
* Report Generation
* Responsive Mobile Design
* Project Progress Tracking
* Cloud Deployment

---

# Learning Outcomes

Through this project, the following skills were improved:

* PHP Development
* Database Management
* CRUD Operations
* Frontend Design
* Problem Solving
* Documentation Skills
* Debugging and Testing

---

# Author

Developed as an internship/project work for learning and practical implementation purposes.

---

# License

This project is developed for educational purposes only.
