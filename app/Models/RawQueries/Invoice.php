<?php
namespace App\Models\RawQueries;
use Illuminate\Support\Facades\DB;

Class Invoice{
    public $table="invoices";

    public function insert($para=array()){
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);
        $sql="INSERT INTO $this->table ($table_columns) VALUES('$table_value')";
        $sth = DB::getPdo()->prepare($sql);
        $sth->execute();
        return DB::getPdo()->lastInsertId();
    }
    public function update($para=array(),$id){
        $args = array();

        foreach ($para as $key => $value) {
            $args[] = "$key = '$value'";
        }

        $sql="UPDATE  $this->table SET " . implode(',', $args);
        $sql .=" WHERE $id";
        $sth = DB::getPdo()->prepare($sql);
        $sth->execute();
        return true;
    }

    public function delete($id){
        $sql="DELETE FROM $this->table";
        $sql .=" WHERE $id ";
        $sth = DB::getPdo()->prepare($sql);
        $sth->execute();
        return true;
    }

    public function find($rows="*",$where = null){
        if ($where != null) {
            $sql="SELECT $rows FROM $this->table WHERE $where";
        }else{
            $sql="SELECT $rows FROM $this->table";
        }
        $sth = DB::getPdo()->prepare($sql);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_OBJ);
    }

    public function all($rows="*",$where = null,$order_by="ORDER BY id ASC"){
        if ($where != null) {
            $sql="SELECT $rows FROM $this->table WHERE $where $order_by";
        }else{
            $sql="SELECT $rows FROM $this->table $order_by";
        }
        $sth = DB::getPdo()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }

}
