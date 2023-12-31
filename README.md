# To-Do List Application

This is a simple To-Do List application built with PHP and MySQL. It allows users to add, delete, and mark tasks as done.

## Features

- Add new tasks with a name and description.
- Mark tasks as done.
- Delete tasks.
- View all active and completed tasks.

## Requirements

- PHP
- MySQL
- Bootstrap (included via CDN)
- jQuery (included via CDN)

## Setup

1. Clone the repository or download the PHP file.
2. Set up a MySQL database named `todo_list` and a table named `tasks` with the following fields:
   - `id` (auto-incrementing integer)
   - `task_name` (varchar)
   - `task_description` (varchar)
   - `status` (integer, default 0)
3. Update the database connection details in the PHP file. The default username is `root` and the password is `hihihi`.
4. Run the PHP file on a server that supports PHP (like Apache).

## Usage

- To add a task, fill in the task name and description, then click the "Add Task" button.
- To mark a task as done, click the "Done" button next to the task.
- To delete a task, click the "Delete" button next to the task.

## Note

This is a basic application and does not include any form of authentication or security measures. It is not recommended to use this application in a production environment without adding appropriate security measures.
