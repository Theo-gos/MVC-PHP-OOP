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

### Database tables

Create a tables in phpmyadmin called _todoitems_ with the fields listed below:

**todoitems**

- id (INT, PRIMARY, AUTO_INCREMENT)
- title (VARCHAR (255))
- description (TEXT)
- priority (VARCHAR (5))
- duedate (DATE)

## config.php

Modify the _config.php_ file and add your database credentials.
