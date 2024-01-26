```markdown
# Project Setup Guide

This guide will walk you through the steps to import a MySQL database, set up a local development environment using XAMPP, and run the project on your local machine.

## Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/your-repository.git
```

## Step 2: Download and Install XAMPP

Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).

## Step 3: Import Database

1. Open phpMyAdmin (usually available at [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)).
2. Create a new database (e.g., `prelove_db`).
3. Import the `prelove.sql` file located in the repository into the newly created database.

## Step 4: Move Project to htdocs

Move the cloned repository to the `htdocs` folder inside your XAMPP installation directory.

For example:

```bash
mv your-repository /path-to-xampp/htdocs/
```

## Step 5: Run the Project

1. Start XAMPP and ensure Apache and MySQL servers are running.
2. Open your web browser and navigate to [http://localhost/your-repository/](http://localhost/your-repository/).

Now, you should be able to access the project locally on your browser.

## Troubleshooting

- If you encounter any issues, check the error logs in XAMPP (`/path-to-xampp/apache/logs/error.log` and `/path-to-xampp/mysql/data/mysql_error.log`).
- Ensure that the database connection settings in the project match the database configuration in XAMPP.

```

Replace placeholders like `your-username`, `your-repository`, and `/path-to-xampp/` with your actual GitHub username, repository name, and the path to your XAMPP installation.
