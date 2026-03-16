# 🌐 IP Monitoring System

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![Chart.js](https://img.shields.io/badge/Chart.js-2.9.4-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)](https://chartjs.org)

A sleek, real-time network monitoring solution designed to track the availability and performance of multiple IP addresses simultaneously. Built with PHP and MySQL, it provides a comprehensive dashboard for network administrators to visualize latency and status at a glance.

---

## ✨ Features

- **🚀 Real-Time Monitoring**: Automatically checks the status (Online/Offline) of all registered IP addresses.
- **📊 Interactive Analytics**: Visualizes ping latency (ms) using **Chart.js** bar graphs for easy performance tracking.
- **♻️ Auto-Refresh**: The dashboard refreshes every 60 seconds to ensure the latest data is always displayed.
- **🔍 Deep Insights**: Automatically fetches **Host Name** and **OS Information** (via WMIC) for online devices.
- **🛠️ Easy Management**: Seamlessly add new IP addresses or remove existing ones through an intuitive interface.
- **📱 Responsive Design**: Fully responsive layout powered by **Bootstrap 5**, looking great on desktops, tablets, and mobile devices.

---

## 🛠️ Tech Stack

- **Backend:** PHP (Native)
- **Frontend:** HTML5, CSS3, JavaScript
- **Framework:** Bootstrap 5.3
- **Visualization:** Chart.js, Plotly
- **Database:** MySQL
- **Icons:** FontAwesome 5/6

---

## ⚙️ Installation & Setup

### 1. Prerequisites
- **Web Server**: XAMPP, WAMP, or any Apache server with PHP support.
- **Database**: MySQL/MariaDB.
- **Network Permissions**: Ensure the server has permission to execute `ping` and `wmic` commands.

### 2. Database Configuration
1. Create a new database named `ip_list`.
2. Create a table named `list` using the following SQL:
   ```sql
   CREATE TABLE `list` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `ip_address` varchar(100) NOT NULL,
     `ip_name` varchar(100) NOT NULL,
     PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
   ```

### 3. Application Setup
1. Clone or download this project to your web root (e.g., `htdocs/ip-monitoring`).
2. Update the database credentials in `ip_table.php` and `ip_form.php`:
   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "ip_list";
   ```

### 4. Running the App
Navigate to `http://localhost/ip-monitoring/index.php` in your browser.

---

## 📝 Usage

- **Add an IP**: Enter the IP Address and a friendly Name in the top form and click **Insert**.
- **View Status**: The table below will display the current status, ping time, and hostname.
- **Analyze Latency**: Check the bar chart at the top to compare latency across all monitored devices.
- **Delete an IP**: Click the trash/minus icon in the table to remove an IP from tracking.

---

## ⚠️ Requirements for OS Detection
For the OS Detection feature to work:
1. The server must be running on Windows.
2. Remote Management (WMI) must be enabled on the target machines.
3. The server must have appropriate permissions to execute `wmic` across the network.

---


<p align="center">Made with ❤️ for Network Administrators</p>
