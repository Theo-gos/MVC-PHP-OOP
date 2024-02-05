<?php

class UserModel extends Model
{
    public function login()
    {
        if ($_SESSION['is_logged_in']) {
            header('Location: ' . ROOT_PATH . 'lists');
            exit(0);
        }

        if (isset($_POST['submit'])) {
            if ($_POST['email'] == '' || $_POST['password'] == '') {
                echo '<h1 class="bg-red-500 text-white">Error: Please fill in the required fields!</h1>';
            }

            $this->query('SELECT * FROM users WHERE email = :email');
            $this->bind(':email', $_POST['email']);
            $row = $this->fetchOne();
            $remember_me = isset($_POST['remember']);

            if ($row) {
                if (password_verify($_POST['password'], $row['password'])) {
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['userData'] = array(
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "email" => $row['email'],
                    );

                    if ($remember_me) {
                        [$selector, $validator, $token] = Remember::generateToken();

                        $this->deleteUserToken($row['id']);

                        $expiryInSenconds = time() + 60 * 60 * 24 * 30;

                        $hashed_validator = password_hash($validator, PASSWORD_DEFAULT);
                        $expiry = date('Y-m-d H:i:s', $expiryInSenconds);

                        if ($this->insertUserToken($row['id'], $selector, $hashed_validator, $expiry)) {
                            setcookie('remember_me', $token, $expiryInSenconds, '/');
                        }
                    }

                    echo '<h1 class="bg-green-500 text-white">You have logged in successfully!</h1>';
                    header('Location: ' . ROOT_PATH . 'lists');
                    exit(0);
                } else {
                    echo '<h1 class="bg-red-500 text-white">Error: Password is incorrect!</h1>';
                    return;
                }
            } else {
                echo '<h1 class="bg-red-500 text-white">Error: User not found!</h1>';
            }
        }

        return;
    }

    public function register()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['password'] == '') {
                echo '<h1 class="bg-red-500 text-white">Error: Please fill in the required fields!</h1>';
                return;
            }

            if ($_POST['password'] !== $_POST['repeat-password']) {
                echo '<h1 class="bg-red-500 text-white">Error: Passwords does not match!</h1>';
                return;
            }

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $this->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $this->bind(':name', $_POST['name']);
            $this->bind(':email', $_POST['email']);
            $this->bind(':password', $password);
            $this->execute();

            if ($this->lastInsertId()) {
                echo '<h1 class="bg-green-500 text-white">Register successfully!</h1>';
                // Redirect
                header('Location: ' . ROOT_PATH . 'users/login');
                exit(0);
            }
        }

        return;
    }

    public function logout()
    {
        $this->deleteUserToken($_SESSION['userData']['id']);

        unset($_SESSION['is_logged_in']);
        unset($_SESSION['userData']);

        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_me', null, -1);
        }

        session_destroy();

        // Redirect
        header('Location: ' . ROOT_PATH);
    }
}
