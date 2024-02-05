# Simple To Do List using MVC framework and Object-Oriented Programming PHP

## Installation:

- Node.js version 18.18.0 is required.
- Run `npm install -D tailwindcss` to install tailwindcss.

Refer to [TailwindCSS](https://tailwindcss.com/docs/installation) for more information.

## To run the project:

- Run `npx tailwindcss -i ./src/input.css -o ./src/output.css --watch` to start the Tailwind CLI build process.
- Run `php -S localhost:8000` to start the php web server.

## Features

- Adding, Listing, Updating, Deleting items
- User registration
- User login/logout
- Password-hashing (bcrypt encryption)
- Remember me

### Database tables

Create 3 tables in phpmyadmin called _todoitems_, _users_, and _user_tokens_ with the fields listed below:

**todoitems**

- id (INT, PRIMARY, AUTO_INCREMENT)
- user_id (INT)
- title (VARCHAR (255))
- description (TEXT)
- priority (VARCHAR (5))
- duedate (DATE)
- create_date (DATETIME, CURRENT_TIMESTAMP())

**users**

- id (INT, PRIMARY, AUTO_INCREMENT)
- name (VARCHAR (255))
- email (VARCHAR (255))
- password (VARCHAR (500))
- register_date (DATETIME, CURRENT_TIMESTAMP())

**user_tokens**

- id INT AUTO_INCREMENT PRIMARY KEY,
- selector VARCHAR(255) NOT NULL,
- hashed_validator VARCHAR(255) NOT NULL,
- user_id INT NOT NULL,
- expiry DATETIME NOT NULL,
- CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE

## config.php

Modify the _config.php_ file and add your database credentials.
