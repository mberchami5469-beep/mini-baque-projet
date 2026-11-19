# 🏦 BankFlow – Bank Account Management System

A mini banking management application developed using **PHP Object-Oriented Programming (OOP)**.

BankFlow allows users to manage three types of bank accounts through a simple web interface, perform financial operations, and calculate savings interest.

## 📌 Project Overview

BankFlow is a small web application designed to demonstrate the fundamentals of Object-Oriented Programming in PHP, including inheritance, encapsulation, method overriding, and static attributes.

## ✨ Features

- Display the total balance of all accounts.
- View the details of three different bank accounts.
- Deposit money into an account.
- Withdraw money with balance verification.
- Calculate savings account interest (6%).
- Apply withdrawal fees to paid accounts (5 DH per withdrawal).
- Display success and error messages.
- Maintain account data using PHP sessions.

## 💳 Account Types

| Account Type | PHP Class | Description |
|---|---|---|
| Current Account | `Compt` | Standard account without fees |
| Savings Account | `ComptEpargne` | Earns 6% interest |
| Paid Account | `ComptPayant` | 5 DH withdrawal fee |

## 🛠️ Technologies Used

- **PHP:** Backend development and application logic.
- **PHP OOP:** Classes, objects, inheritance, and encapsulation.
- **HTML5:** Web page structure.
- **CSS3:** Custom styling.
- **Bootstrap 5:** Responsive user interface.
- **PHP Sessions:** Temporary account data management.

## 🧠 OOP Concepts Practiced

This project demonstrates several important Object-Oriented Programming concepts:

- **Classes and Objects:** Creating and managing bank accounts.
- **Inheritance:** `ComptEpargne` and `ComptPayant` inherit from `Compt`.
- **Encapsulation:** Using `protected` attributes and getters.
- **Method Overriding:** Redefining the `retirer()` method in `ComptPayant`.
- **Static Attributes:** Using `$nb` to generate account codes.
- **Polymorphism:** Applying different withdrawal behaviors depending on the account type.

## 📂 Project Structure

```text
BankFlow/
│
├── index.php
│
├── comptes/
│   ├── Compt.php
│   ├── ComptEpargne.php
│   └── ComptPayant.php
│
└── css/
    └── style.css
```

## ⚙️ Installation and Execution

### 1. Install a local server

Install one of the following tools:

- [XAMPP](https://www.apachefriends.org/)
- WAMP
- Laragon

### 2. Clone the repository

Open your terminal and execute:

```bash
git clone https://github.com/TON-USERNAME/BankFlow.git
```

### 3. Move the project

Place the `BankFlow` folder inside the `htdocs` directory if you are using XAMPP.

### 4. Start Apache

Open XAMPP Control Panel and start the Apache server.

### 5. Run the application

Open your browser and visit:

```text
http://localhost/BankFlow/
```

**Note:** Account data is stored in PHP sessions. It is temporary and is not saved permanently in a database.

## 📸 Screenshots

### BankFlow Dashboard

<!-- Add your dashboard screenshot here -->

### Deposit and Withdrawal Operations

<!-- Add your transaction screenshot here -->

### Account Management

<!-- Add your account details screenshot here -->

## 🔮 Future Improvements

Possible improvements for future versions:

- Add a transaction history.
- Integrate a MySQL database.
- Implement a user authentication system.
- Add transfers between bank accounts.
- Improve security and input validation.

## 👨‍💻 Author

**Mouad Berchami**

- Field: Licence Sciences et Techniques (LST)
- Speciality: Développement Informatique (DI)
- Institution: Faculté des Sciences et Techniques de Marrakech (FST)

## 🎓 Academic Project

This mini project was developed to practice **PHP Object-Oriented Programming**, inheritance, encapsulation, and the implementation of a simple banking application.

---

⭐ If you like this project, don't forget to give it a star!
