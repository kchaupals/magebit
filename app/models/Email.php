<?php

class Email
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Returns all rows from DB
    public function allRecords($filter)
    {
        if($filter[0] === 'email' && $filter[1] === 'asc'){
            $param1 = 'email';
            $param2= 'ASC';
        }
        if($filter[0] === 'email' && $filter[1] === 'desc'){
            $param1 = 'email';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'desc'){
            $param1 = 'sub_date';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'asc'){
            $param1 = 'sub_date';
            $param2= 'ASC';
        }
         $this->db->query("SELECT * FROM subscribers ORDER BY ".$param1 ." ".$param2);
        $rows =  $this->db->resultsSet();
        $rowCount = $this->db->rowCount();
        $result= ['data' => $rows, 'rowCount' => $rowCount];
        return $result;
    }
    // Returns e-mail provider URLS @provider
    public function emailProvider()
    {
        $this->db->query("SELECT substring_index(email, '@', -1) domain FROM `subscribers` GROUP BY substring_index(email, '@', -1)");
        $resultProvaider =  $this->db->resultsSet();
        return $resultProvaider;
    }
    // Sorts rows by e-mail provider
    public function searchByProvider($provider, $filter)
    {
        if($filter[0] === 'email' && $filter[1] === 'asc'){
            $param1 = 'email';
            $param2= 'ASC';
        }
        if($filter[0] === 'email' && $filter[1] === 'desc'){
            $param1 = 'email';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'desc'){
            $param1 = 'sub_date';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'asc'){
            $param1 = 'sub_date';
            $param2= 'ASC';
        }
        $this->db->query("SELECT * FROM `subscribers` WHERE substring_index(email, '@', -1) LIKE :email ORDER BY ". $param1 ." ". $param2);
        $this->db->bind(':email', '%' . $provider . '%');
        $rows =  $this->db->resultsSet();
        $rowCount = $this->db->rowCount();
        $result = ['data' => $rows, 'rowCount' => $rowCount];
        return $result;
    }
    // Sort by Date 
    public function searchByDate($date, $filter)
    {
        if($filter[0] === 'email' && $filter[1] === 'asc'){
            $param1 = 'email';
            $param2= 'ASC';
        }
        if($filter[0] === 'email' && $filter[1] === 'desc'){
            $param1 = 'email';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'desc'){
            $param1 = 'sub_date';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'asc'){
            $param1 = 'sub_date';
            $param2= 'ASC';
        }
        $this->db->query("SELECT * FROM subscribers WHERE sub_date LIKE :inputDate ORDER BY ". $param1 ." ". $param2);
        $this->db->bind(':inputDate', '%' . $date . '%');
        $rows = $this->db->resultsSet();
        $rowCount = $this->db->rowCount();
        if ($rowCount > 0) {
            $result = ['data' => $rows, 'rowCount' => $rowCount];
            return $result;
        } else {
            return false;
        }
    }

    public function deleteOne($id)
    {
        $this->db->query("DELETE FROM subscribers WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }


    //Find email
    public function findEmail($email, $filter)
    {
        if($filter[0] === 'email' && $filter[1] === 'asc'){
            $param1 = 'email';
            $param2= 'ASC';
        }
        if($filter[0] === 'email' && $filter[1] === 'desc'){
            $param1 = 'email';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'desc'){
            $param1 = 'sub_date';
            $param2= 'DESC';
        }
        if($filter[0] === 'sdate' && $filter[1] === 'asc'){
            $param1 = 'sub_date';
            $param2= 'ASC';
        }
        $this->db->query("SELECT * FROM subscribers WHERE email LIKE :email ORDER BY ". $param1 ." ".$param2);
        $this->db->bind(':email', '%' . $email . '%');
        $row = $this->db->resultsSet();
        $rowCount = $this->db->rowCount();
        if ($rowCount > 0) {
            $result = ['data' => $row, 'rowCount' => $rowCount];
            return $result;
        } else {
            return false;
        }
    }
}
