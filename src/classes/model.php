<?php
abstract class Model
{
    protected $dbh;
    protected $stmt;

    public function __construct()
    {
        $this->dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countSet()
    {
        $this->execute();
        return $this->stmt->fetchColumn();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    public function insertUserToken(int $user_id, string $selector, string $hashed_validator, string $expiry)
    {
        $this->query('INSERT INTO user_tokens(user_id, selector, hashed_validator, expiry) VALUES(:user_id, :selector, :hashed_validator, :expiry)');
        $this->bind(':user_id', $user_id);
        $this->bind(':selector', $selector);
        $this->bind(':hashed_validator', $hashed_validator);
        $this->bind(':expiry', $expiry);
        $this->execute();

        if ($this->lastInsertId()) {
            return true;
        }

        return false;
    }

    public function findUserTokenBySelector(string $selector)
    {
        $this->query('SELECT id, selector, hashed_validator, user_id, expiry
                    FROM user_tokens
                    WHERE selector = :selector AND
                        expiry >= now()
                   LIMIT 1');
        $this->bind(':selector', $selector);
        return $this->fetchOne();
    }

    public function findUserByToken(string $token)
    {
        $tokens = Remember::parseToken($token);

        if (!$tokens) {
            return NULL;
        }

        $this->query('SELECT users.id, name
                    FROM users
                    INNER JOIN user_tokens ON user_id = users.id
                    WHERE selector = :selector AND
                        expiry > now()
                    LIMIT 1');

        $this->bind(':selector', $tokens[0]);
        return $this->fetchOne();
    }

    public function deleteUserToken(int $user_id)
    {
        $this->query('DELETE FROM user_tokens WHERE user_id = :user_id');
        $this->bind(':user_id', $user_id);
        return $this->execute();
    }

    public function isTokenValid(string $token)
    {
        [$selector, $validator] = Remember::parseToken($token);
        $tokens = $this->findUserTokenBySelector($selector);
        if (!$tokens) {
            return false;
        }

        return password_verify($validator, $tokens['hashed_validator']);
    }

    public function isUserLoggedIn()
    {
        if (isset($_SESSION['is_logged_in'])) {
            return true;
        }

        $token = $_COOKIE['remember_me'];

        if ($token && $this->isTokenValid($token)) {
            $user = $this->findUserByToken($token);

            if ($user) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['userData'] = array(
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "email" => $user['email'],
                );
                return true;
            }
        }

        return false;
    }
}
