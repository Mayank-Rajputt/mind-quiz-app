# Mind Quiz 🧠

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg)](https://github.com/)
> A sleek and engaging web-based quiz application designed to test and expand your knowledge on various topics. Log in, challenge yourself, and see how you score!

**[Live Demo Link](https://your-live-demo-link.com)**

---

## 📸 Screenshots

Here's a glimpse of what Mind Quiz looks like.

*(To use this method, create a folder named `screenshots` in your repository, add your image files to it, and then commit the changes. The paths below will then work automatically.)*

| Dashboard | Quiz Page |
| :---: | :---: |
| ![Dashboard Screenshot](./screenshots/dashboard.png) | ![Quiz Page Screenshot](./screenshots/quiz.png) |

| Login Page | Create Account Page |
| :---: | :---: |
| ![Login Screenshot](./screenshots/login.png) | ![Sign Up Screenshot](./screenshots/signup.png) |

---

## ✨ About The Project

Mind Quiz is a feature-rich quiz platform that provides an interactive and fun way for users to test their general knowledge. The project was built to demonstrate a classic web application stack with user authentication, dynamic content rendering from a database, and a clean, responsive user interface. Whether you're looking to kill some time or genuinely challenge your intellect, Mind Quiz has got you covered.

### Key Features:

* **User Authentication:** Secure sign-up and login system for a personalized experience.
* **Interactive Quiz Interface:** A clean and intuitive UI for answering questions.
* **Real-time Scoring:** Get immediate feedback on your answers and see your score update live.
* **Timed Challenges:** Each quiz is timed to add an extra layer of excitement and challenge.
* **Responsive Design:** Fully functional and visually appealing on all devices, from desktops to mobile phones.
* **Personalized Welcome:** Greets logged-in users by name on the dashboard.

---

## 🛠️ Built With

This project leverages a classic and robust stack of web technologies.

* **Frontend:**
    * CSS3
    * JavaScript

* **Backend:**
    * [PHP](https://www.php.net/)

* **Database:**
    * [MySQL](https://www.mysql.com/) (Managed with [phpMyAdmin](https://www.phpmyadmin.net/))

---

## 🚀 Getting Started

To get a local copy up and running, you'll need a local server environment like XAMPP or WAMP.

### Prerequisites

Make sure you have a local server environment installed that supports PHP and MySQL.
* [XAMPP](https://www.apachefriends.org/index.html) (cross-platform)
* [WAMP](https://www.wampserver.com/en/) (for Windows)
* [MAMP](https://www.mamp.info/en/mamp/) (for macOS)

### Installation

1.  **Clone the repo** into your server's web directory (e.g., `htdocs` for XAMPP).
    ```sh
    git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
    ```
2.  **Start your Apache and MySQL services** from your XAMPP/WAMP/MAMP control panel.
3.  **Create the database**
    * Open phpMyAdmin by navigating to `http://localhost/phpmyadmin`.
    * Create a new database and name it `mind_quiz_db` (or your preferred name).
    * Select the new database and go to the "Import" tab.
    * Upload and import the `.sql` file included in this repository to set up the tables.
4.  **Configure the database connection**
    * Open the `config.php` (or equivalent connection file) in your code editor.
    * Update the database credentials (host, username, password, database name) to match your local setup.
    ```php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mind_quiz_db";
    ```
5.  **Run the application** by navigating to `http://localhost/your-repo-name` in your web browser.

---

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

---

## 📜 License

Distributed under the MIT License. See `LICENSE` for more information.

---

## 📬 Contact

Mayank Rana - [LinkedIn](https://www.linkedin.com/in/your-linkedin-profile/) - your-email@example.com

Project Link: [https://github.com/your-username/your-repo-name](https://github.com/your-username/your-repo-name)

---
