<?php

class SqlManager {

    private $db;
    private $query;
    private $result;

    public function __construct() {
        $this->db = new mysqli('127.0.0.1', 'root', '1234', 'my_first_site');
        if ($this->db->connect_error) {
            echo '<h1>Помилка зєднання з базою даних<h1>';
            die();
        }
    }

    public function selectQuery($stringQuery) {
        $this->result = $this->db->query($stringQuery);
        print_r($this->db->error);
        if ($this->result != false)
            return true;
        return false;
    }

    public function getRow($number)
    {
        
            if ($this->result instanceof mysqli_result) 
            {
                if ($this->result->num_rows > $number)
                {
                    $this->result->data_seek($number);

                    return $this->result->fetch_array();
                }
            }
        return false;
    }

    public function getAllQueryArray() {
        $arr_ret=array();
        if ($this->result instanceof mysqli_result) {
            if ($this->result->num_rows > 0) {
                $this->result->data_seek(0);
            }
            while ($row_c = $this->result->fetch_array())
            {
                $arr_ret[] = $row_c;
            }

            return $arr_ret;
        }
        return false;
    }

    public function getNumRow() {
        if ($this->result instanceof mysqli_result) {
            return $this->result->num_rows;
        }
        return false;
    }

    public function __destruct() {
        $this->db->close();
        unset($this->db);
        unset($this->result);
    }

}

?>
