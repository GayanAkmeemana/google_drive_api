<?php
/**
 * User: Gayan Akmeemana
 * Date: 2022-04-26
 */

require_once 'config.php';

class Database extends PDO{
    
    public function __construct() {
        parent:: __construct("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    }

    /**
     * Insert query
     *
     * @param $table => Table name
     * @param $data => Data to insert
     * @return bool => Return
     */
    public function insert($table,$data){
        ksort($data);
        $names = implode('`,`',array_keys($data));
        $values = ':'.implode(', :',array_keys($data));
        $sth = $this->prepare("INSERT INTO ".$table."(`".$names."`) VALUES (".$values.")");

        foreach ($data as $key=>$value){
            $sth->bindValue(":$key",$value);
        }
        if($sth->execute()){
            return $this->lastInsertId();
        }else{
            $arr = $sth->errorInfo();
            print_r($arr);
            return false;
        }
    }

    /**
     * Update query
     *
     * @param $table => Table name
     * @param $data => Data yo update
     * @param $where => Condition
     * @return bool => Return
     */
    public function update($table,$data,$where){
        ksort($data);
        $fields = null;
        foreach ($data as $key=>$value){
            $fields .= "`$key`=:$key, ";
        }
        $fields = rtrim($fields,', ');

        $sth = $this->prepare("UPDATE ".$table." SET ".$fields." WHERE ".$where);

        foreach ($data as $key=>$value){
            $sth->bindValue(":$key",$value);
        }
        if($sth->execute()){
            return true;
        }else{
            $arr = $sth->errorInfo();
            print_r($arr);
            return false;
        }
    }

    /**
     * Delete query
     *
     * @param $table => Table name
     * @param $where => Condition
     * @return bool => Return
     */

    public function delete($table,$data, $where){
        $sth = $this->prepare("DELETE FROM ".DB_PREFIX.$table."  WHERE ".$where);
        foreach ($data as $key=>$value){
            $sth->bindValue(":$key",$value);
        }
        if($sth->execute()){
            return true;
        }else{
            $arr = $sth->errorInfo();
            print_r($arr);
            return false;
        }
    }
}
