# Employee Management System

A **full-stack web application** for managing employee records, including personal details, multiple contact numbers, addresses, school attachments, and other attachments. Built with **PHP**, **MySQL**, and **HTML/CSS**, this system allows adding, storing, and viewing employees with multi-value details.

---

## Table of Contents

1. [Features](#features)  
2. [Project Structure](#project-structure)  
3. [Database Setup](#database-setup)  
4. [Installation & Setup](#installation--setup)  
5. [Usage](#usage)  
6. [Technologies Used](#technologies-used)  
7. [Future Improvements](#future-improvements)

---

## Features

- Add new employee details.  
- Support multiple addresses, telephone numbers, WhatsApp numbers.  
- Record school attachments (with start and end dates).  
- Record other attachments with dates and periods.  
- Relational database structure to maintain data consistency.  
- Data validation and prevention of duplicates for `file_number`.

---

## Project Structure

employee_system/
│
├── employee_form.html # HTML form for input
├── employee_submit.php # PHP script to handle form submission
├── employee_list.php # (Optional) Page to list all employees
├── README.md # Project documentation
└── assets/ # Optional: CSS/JS files


---

## Database Setup

1. Open **phpMyAdmin** or MySQL client.  
2. Create database `education` and run the following SQL:

```sql
CREATE DATABASE education;
USE education;

CREATE TABLE Employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    file_number VARCHAR(50) UNIQUE,
    employee_name VARCHAR(100) NOT NULL,
    nic VARCHAR(20) UNIQUE,
    date_of_birth DATE,
    gender VARCHAR(10),
    date_of_trainee_training_appointment DATE,
    date_of_release_from_divisional_secretariat DATE,
    date_of_appointment DATE,
    date_of_assuming_duties_in_zone DATE,
    date_of_passing_efficiency_test DATE,
    date_of_tamil_release DATE,
    date_of_appointment_confirmed DATE
);

CREATE TABLE EmployeeAddresses (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    file_number VARCHAR(50),
    address TEXT,
    FOREIGN KEY (file_number) REFERENCES Employees(file_number) ON DELETE CASCADE
);

CREATE TABLE EmployeeTelephones (
    phone_id INT AUTO_INCREMENT PRIMARY KEY,
    file_number VARCHAR(50),
    phone_number VARCHAR(20),
    FOREIGN KEY (file_number) REFERENCES Employees(file_number) ON DELETE CASCADE
);

CREATE TABLE EmployeeWhatsApp (
    whatsapp_id INT AUTO_INCREMENT PRIMARY KEY,
    file_number VARCHAR(50),
    whatsapp_number VARCHAR(20),
    FOREIGN KEY (file_number) REFERENCES Employees(file_number) ON DELETE CASCADE
);

CREATE TABLE EmployeeSchoolAttachments (
    school_attach_id INT AUTO_INCREMENT PRIMARY KEY,
    file_number VARCHAR(50),
    school_name VARCHAR(150),
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (file_number) REFERENCES Employees(file_number) ON DELETE CASCADE
);

CREATE TABLE EmployeeAttachments (
    attachment_id INT AUTO_INCREMENT PRIMARY KEY,
    file_number VARCHAR(50),
    date_of_attachment DATE,
    period VARCHAR(50),
    FOREIGN KEY (file_number) REFERENCES Employees(file_number) ON DELETE CASCADE
);


## Installation & Setup

1. Install **XAMPP** (or MAMP/Laragon) with PHP and MySQL.  
2. Start **Apache** and **MySQL** servers.  
3. Place your project folder (e.g., `employee_system`) inside `htdocs` (for XAMPP) or use PHP built-in server:  

```bash
cd path/to/employee_system
php -S localhost:8000

4.Open your web browser and go to:
http://localhost/employee_system/employee_form.html
5.Fill in employee details in the form and submit to store them in the database.
