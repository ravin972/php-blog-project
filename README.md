
```markdown
# 📝 PHP Blog Project

A simple **PHP & MySQL Blog Application** where users can sign up, log in, create posts, edit, update, and delete only their own posts.  
This project is built with **pure PHP (no frameworks)** and is deployed live on InfinityFree.

---

## 🌍 Live Demo
🔗 [View Live Project](https://myblognew.kesug.com/index.php)

---

## 🚀 Features
- ✅ User authentication (Signup, Login, Logout)
- ✅ Create blog posts
- ✅ Edit, update, and delete **only your own posts**
- ✅ View all blog posts
- ✅ Responsive layout
- ✅ Clean navigation (Navbar with conditional links)
- ✅ MySQL database integration

---

## 📂 Project Structure
```

blog\_project/
│── assets/          # CSS, images, etc.
│── create\_post.php  # Create new blog post
│── db.php           # Database connection
│── delete\_post.php  # Delete a blog post
│── edit\_post.php    # Edit an existing blog post
│── footer.php       # Footer include
│── header.php       # Header + Navbar
│── index.php        # Homepage with blog list
│── login.php        # User login
│── logout.php       # User logout
│── my\_posts.php     # Show logged-in user's posts
│── profile.php      # User profile
│── signup.php       # User registration
│── view\_post.php    # Read full blog post
│── README.md        # Project documentation
│── .gitignore       # Git ignore file

````

---

## 🛠️ Installation Guide

1. **Clone the repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/php-blog-project.git
   cd php-blog-project
````

2. **Move files into your server directory**

   * For **XAMPP** → place inside `C:/xampp/htdocs/blog_project/`
   * For **Linux/Mac with Apache** → `/var/www/html/blog_project/`

3. **Create MySQL Database**

   * Open **phpMyAdmin** ([http://localhost/phpmyadmin](http://localhost/phpmyadmin)).
   * Create a new database, e.g., `blog_db`.
   * Import `db.sql` (if provided, or create tables manually).

   Example table:

   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL
   );

   CREATE TABLE posts (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       title VARCHAR(255) NOT NULL,
       content TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id)
   );
   ```

4. **Update Database Config**

   * Open `db.php` and set your credentials:

     ```php
     $conn = new mysqli("localhost", "root", "", "blog_db");
     ```

5. **Run Project**

   * Start Apache & MySQL in XAMPP.
   * Open browser: [http://localhost/blog\_project](http://localhost/blog_project)

---

## 🖼️ Screenshots

👉 Add your screenshots here (homepage, login, profile, etc.)

---

## 📌 Technologies Used

* **PHP** (Core PHP)
* **MySQL** (Database)
* **HTML5 / CSS3**
* **Bootstrap** (Styling)
* **InfinityFree** (Hosting)

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you’d like to change.

---

## 📜 License

This project is **open-source** and available under the [MIT License](LICENSE).

```

---

👉 Do you want me to also create a **`db.sql` file** with tables (users & posts) so you can include it in your GitHub repo? That way, anyone can set up your project instantly.
```
