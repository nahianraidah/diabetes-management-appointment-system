# Diabetes Management and Appointment Booking System

A web-based diabetes management and appointment booking system developed as a group project for **CSE370: Database Systems**.

The project was built using **PHP, HTML, CSS, and MySQL**. It provides separate features for administrators, doctors and patients, using a relational database to manage users, doctors, appointments and prescriptions.

---

## About the Project

The system was developed to provide a simple platform for managing diabetes-related appointments and interactions between patients and doctors.

Users can register and log in based on their role. Administrators can verify doctors and manage information about doctors and appointments. Doctors can manage their profiles, view and approve appointments, and write prescriptions for patients. Patients can view verified doctors, request appointments and view their prescriptions.

The project also involved designing the database using an **ER/EER diagram** and **relational schema** before implementing it using MySQL.

---

## Main Features

### Admin

* Admin login
* Admin dashboard
* Verify doctors
* View all doctors
* View all appointments

### Doctor

* Doctor dashboard
* Update doctor profile
* View appointments
* Approve appointments
* Write prescriptions for patients

### Patient

* Patient dashboard
* Update patient profile
* Request appointments
* View verified doctors
* View prescriptions

---

## Technologies Used

* **PHP** — Backend and server-side functionality
* **HTML** — Page structure
* **CSS** — Styling and user interface
* **MySQL** — Database management
* **XAMPP** — Local development environment

---

## Database

The project uses a MySQL database named:

```text
dms
```

The database is included in the repository as:

```text
dms.sql
```

The project also includes database design documentation containing the **ER/EER diagram** and **relational schema diagram**.

---

## Project Structure

```text
diabetes-management-appointment-system/
│
├── admin/                  # Admin-related pages
├── doctor/                 # Doctor-related pages
├── patient/                # Patient-related pages
├── img/                    # Images and visual assets
├── docs/                   # Project documentation
│
├── dbconnect.php           # Database connection
├── dms.sql                 # MySQL database
├── login.php               # Login page
├── login.css               # Login page styling
├── logout.php              # Logout functionality
├── registration.php        # Registration page
├── registration.css        # Registration page styling
│
├── README.md
└── .gitignore
```

---

## Running the Project

This project was developed and tested locally using **XAMPP**.

### 1. Set Up XAMPP

Install XAMPP and start the following services:

* **Apache**
* **MySQL**

### 2. Add the Project

Place the project folder inside the XAMPP `htdocs` directory:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\diabetes-management-appointment-system\
```

### 3. Set Up the Database

Open **phpMyAdmin** and create a database named:

```text
dms
```

Then import the `dms.sql` file into the database.

### 4. Check the Database Connection

Open `dbconnect.php` and make sure the database connection details match your local MySQL configuration.

### 5. Run the Project

Start **Apache** and **MySQL** from the XAMPP Control Panel.

Then open the following URL in your browser:

```text
http://localhost/diabetes-management-appointment-system/
```

---

## My Contribution

This was a group project where we worked together on different parts of the system.

My main contribution was the **Doctor module**, including:

* Developing the doctor dashboard
* Updating the doctor's profile
* Viewing doctor appointments
* Approving appointments
* Writing prescriptions for patients

---

## Team

**CSE370: Database Systems — Group 7**

* **Aditya Dasgupta**
* **Nahian Raidah**
* **Afia Labiba**

---

## Course Information

| Information      | Details                   |
| ---------------- | ------------------------- |
| **Course**       | CSE370 — Database Systems |
| **Lab Section**  | 7                         |
| **Group**        | 7                         |
| **Semester**     | Summer 2024               |
| **Project Type** | Academic / Group Project  |

---

## Database Design

The project includes the following database design components:

* **ER/EER Diagram**
* **Relational Schema Diagram**
* **MySQL Database Implementation**

The relevant documentation and diagrams can be found in the `docs/` directory.

---

## Disclaimer

This project was developed for academic purposes as part of the **CSE370 Database Systems** course. It is a demonstration of database design and web application development and is **not intended for use as a real medical management system**.
