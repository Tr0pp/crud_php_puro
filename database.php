<?php

class Database
{
    public $conn;

    public function __construct($type = null, $value = null, $column = null, $table = null, $where = null)
    { 
        try {
            $this->conn = new MySQLi('localhost', 'root', 1234, 'lojatest');
        }catch(Exception $e){
            echo $e->getMessage(); 
        }

        $this->type = $type;
        $this->value = $value;
        $this->column = $column;
        $this->table = $table;
        $this->where = $where;

    }

    public function query_run($sql)
    {
        if ($this->type == 1) {
            $stmt = $this->conn->prepare($sql);

            if ($stmt->execute()) {
                echo "Sucesso";

                return true;
            } else {
                return false;
            }
        }else{
            if($this->conn->query($sql))
                return true;
        }
        // if($this->conn->query($sql)){
        //     echo "ok";
        // }
    }

 
    public function crud()
    {
        if ($this->type <= 0) {
            echo "Erro no tipo de requisição.";
        }else{

            // if ($this->value != NULL) {
            //     $value = array();
            //     foreach ($this->value as $arrValue) {
            //         $values[] = $arrValue;
            //         $value = implode(',', $values);
            //     }

            if ($this->column != NULL && is_array($this->column)) {
                $value = array();
                foreach ($this->column as $this->column => $arrValue) {
                    $values[] = $arrValue;
                    $columns[] = $this->column;
                    $value = implode(',', $values);
                    $column = implode(',', $columns);
                }
                
            }else{
                if($this->column != null)
                $column = $this->column;
            }

            if (is_array($this->where)) {
                $where = array();
                foreach ($this->where as $arrWhere) {
                    $wheres[] = $arrWhere;
                    $where = implode(',', $wheres);
                }
            }else{
                if($this->where != null)
                    $where = $this->where;
            }

                switch ($this->type) {
                case '1':
                    $sql = "INSERT INTO {$this->table} ({$column}) VALUES ({$value});";
                    if($this->query_run($sql));
                    return true;
                break;

                case '2':
                    $sql = "SELECT {$column} FROM {$this->table} WHERE {$where};";
                    if($this->query_run($sql));
                    return true;
                break;

                case '3':
                    $sql = "UPDATE {$this->table} SET {$value} WHERE {$where}";
                    if($this->query_run($sql));
                    return true;
                break;

                case '4':
                    $sql = "DELETE FROM {$this->table} WHERE {$where};";
                    if($this->query_run($sql));
                    return true;
                break;

               

            default:
                echo mysqli_error($this->conn);
            break;

            }
        }
    }

}

