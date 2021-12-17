<?php

class Homes
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function subscribe($data)
    {
        $this->db->query('INSERT INTO subscribers (email) VALUES (:email) ');
        $this->db->bind(':email', $data);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
