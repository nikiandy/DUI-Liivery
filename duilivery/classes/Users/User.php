<?php
// User.php

class User {
    protected $id;
    protected $username;
    protected $email;

    public function __construct($id, $username, $email) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    public function getInfo() {
        // Return user information
        return "ID: {$this->id}, Username: {$this->username}, Email: {$this->email}";
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
}
?>
