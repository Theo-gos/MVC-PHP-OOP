<?php
class ListModel extends Model
{
    public function index()
    {
        if (isset($_SESSION['is_logged_in'])) {
            $this->query('SELECT * FROM todoitems WHERE user_id = :user_id');
            $this->bind(':user_id', $_SESSION['userData']['id']);
            $rows = $this->fetchAll();
            return $rows;
        }
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['title'] == '' || $_POST['desc'] == '') {
                echo '<h1 class="bg-red-500 text-white">Error: Please fill in the required fields!</h1>';
                return;
            }
            if ($_POST['due'] < date('Y-m-d')) {
                echo '<h1 class="bg-red-500 text-white">Error: Please choose a valid date!</h1>';
                return;
            }

            $this->query('INSERT INTO todoitems (user_id, title, description, priority, duedate) VALUES (:user_id, :title, :description, :priority, :duedate)');
            $this->bind(':user_id', $_SESSION['userData']['id']);
            $this->bind(':title', $_POST['title']);
            $this->bind(':description', $_POST['desc']);
            $this->bind(':priority', $_POST['prio']);
            $this->bind(':duedate', $_POST['due']);
            $this->execute();

            if ($this->lastInsertId()) {
                // Redirect
                header('Location: ' . ROOT_PATH . 'lists');
                exit(0);
            }
        }

        return;
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['title'] == '' || $_POST['desc'] == '') {
                echo '<h1 class="bg-red-500 text-white">Error: Please fill in the required fields!</h1>';
                $this->query('SELECT * FROM todoitems WHERE id = :id');
                $this->bind(':id', $_GET['id']);
                return $this->fetchOne();
            }
            if ($_POST['due'] < date('Y-m-d')) {
                echo '<h1 class="bg-red-500 text-white">Error: Please choose a valid date!</h1>';
                $this->query('SELECT * FROM todoitems WHERE id = :id');
                $this->bind(':id', $_GET['id']);
                return $this->fetchOne();
            }

            $this->query('UPDATE todoitems SET title = :title, description = :description, priority = :priority, duedate = :duedate WHERE id = :id');
            $this->bind(':title', $_POST['title']);
            $this->bind(':description', $_POST['desc']);
            $this->bind(':priority', $_POST['prio']);
            $this->bind(':duedate', $_POST['due']);
            $this->bind(':id', $_POST['id']);
            $this->execute();

            header('Location: ' . ROOT_PATH . 'lists');
            exit(0);
        } else {
            if ($_GET['id'] != NULL && $_GET['id'] != '') {
                $this->query('SELECT * FROM todoitems WHERE id = :id');
                $this->bind(':id', $_GET['id']);
                return $this->fetchOne();
            } else {
                header('Location: ' . ROOT_PATH . 'lists');
            }
        }
    }

    public function delete()
    {
        if (isset($_POST['submit'])) {
            $this->query('DELETE FROM todoitems WHERE id = :id');
            $this->bind(':id', $_POST['id']);
            $this->execute();

            header('Location: ' . ROOT_PATH . 'lists');
            exit(0);
        } else {
            if ($_GET['id'] != NULL || $_GET['id'] != '') {
                // Fetch post using GET parameter value
                $this->query('SELECT count(*) FROM todoitems WHERE id = :id');
                $this->bind(':id', $_GET['id']);
                $row = $this->countSet();
                if ($row > 0) {
                    return $_GET['id'];
                } else {
                    header('Location: ' . ROOT_PATH . 'lists');
                }
            } else {
                header('Location: ' . ROOT_PATH . 'lists');
            }
        }
    }
}
