# 🎓 Moodle User Registration Plugin

## 🚀 About the Project
The **Moodle User Registration Plugin** extends Moodle's user management by providing a **custom registration form**. It allows users to **sign up with additional fields** and ensures **email verification with a temporary password**.

### 📌 Features
- ✅ **Custom Registration Form** with additional fields:
    - ✉️ **Email (Username)**
    - 🏷️ **First Name & Surname**
    - 🌎 **Country**
    - 📱 **Mobile Number**
- ✅ **User Account Creation in Moodle**
- ✅ **Email Verification with Temporary Password**
- ✅ **Force Password Change on First Login**
- ✅ **Dockerized Moodle Development Environment**
- ✅ **Makefile Commands for Easier Management**
- ✅ **Mailpit for Email Testing**

---

## 🛠️ Tech Stack
- **Backend:** PHP 8+ (Moodle API)
- **Database:** MariaDB
- **Email Handling:** Mailpit (SMTP testing)
- **Containerization:** Docker & Docker Compose
- **Moodle Version:** 4.5+

---

## 📋 Prerequisites
Before installing, ensure you have the following:
- ✅ **Docker & Docker Compose** installed
- ✅ **Make** (for easier command execution)
- ✅ **Git** (to clone the repository)

---

## 📦 Installation & Setup
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/npispas/moodle-user-registration.git
cd moodle-user-registration
```

### **2️⃣ Start Docker Services**
```sh
make up
```
This will:
- **Start Moodle** (`http://localhost:8080`)
- **Set up MariaDB**
- **Launch Mailpit for email testing** (`http://localhost:8025`)

### **3️⃣ Install the Plugin**
Once the moodle container is up and the installation script finishes, run the following command:
```sh
make install-plugin
```
This command **copies the plugin** into the Moodle container and **restarts Moodle**.

### **4️⃣ Complete Moodle Setup**
1. **Visit** `http://localhost:8080`
2. **Log in as admin**
3. **Navigate to**:
   ```
   Site Administration → Plugins → Local Plugins
   ```
4. **Install** the `"User Registration Plugin"`

---

## 🎮 Usage
### **1️⃣ Open the Registration Form**
Visit:
```
http://localhost:8080/local/registration_form/
```

### **2️⃣ Register a New User**
Fill in: <br>
✅ Email  
✅ First Name  
✅ Surname  
✅ Country  
✅ Mobile Number

### **3️⃣ Check the Email for a Temporary Password**
All emails are sent to **Mailpit** for testing:
```
http://localhost:8025
```

### **4️⃣ Log In as the New User**
1. Visit `http://localhost:8080/login/index.php`
2. Use the **temporary password** from the email
3. Moodle **forces a password change** on first login

---

## ⚙️ Development
### **🏷️ Project Structure**
```
moodle-user-registration/
├── moodle/
│   ├── local/
│   │   ├── registration_form/
├── .env.example
├── .gitignore
├── docker-compose.yml
├── LICENSE
├── Makefile
├── README.md
```

---

### **📌 Available Makefile Commands**
| Command               | Description                      |
|-----------------------|----------------------------------|
| `make up`             | Start Docker containers          |
| `make down`           | Stop and remove containers       |
| `make restart`        | Restart all containers           |
| `make status`         | Lists the container statuses     |
| `make moodle`         | Exec bash into moodle container  |
| `make db`             | Exec bash into mariadb container |
| `make reset-password` | Reset user password via CLI      |
| `make install-plugin` | Install plugin & restart Moodle  |
| `make logs`           | Print Moodle logs                |

---

## 🛠️ Troubleshooting
### **Email Not Sending?**
1. **Check if Mailpit is running**:
   ```sh
   docker ps | grep mailpit
   ```
2. **Check Moodle logs**:
   ```sh
   docker logs moodle --tail=50
   ```
3. **Send a manual test email**:
   ```sh
   docker exec -it moodle php /bitnami/moodle/admin/tool/task/cli/schedule_task.php --execute='\core\task\email_test_task'
   ```
4. **View the email at Mailpit**:
   ```
   http://localhost:8025
   ```

### **Plugin Not Appearing in Moodle?**
```sh
docker restart moodle
```
Then visit:
```
Site Administration → Plugins → Local Plugins
```

---

## 📚 License
This project is licensed under the **GNU GPL-3.0-or-later License**.

---

## 📩 Contact
🌟 **Created by Nikolaos Pispas**  
📧 [npispasl@gmail.com](mailto:npispas@gmail.com)
```