<?php

class Database{

function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD){
    if($DB_TYPE==='mysql'){
        $this->db = new mysqli($DB_HOST,$DB_USER, $DB_PASSWORD,$DB_NAME);        
    }
}

private function execute($commd,$bind_string=0,$bind_arr=0){
    $stmt = $this->db->prepare($commd);
    if($bind_string){
        $c = sizeof($bind_arr);
        if($c==1)   $stmt->bind_param($bind_string, $bind_arr[0]);
        elseif($c==2)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1]);
        elseif($c==3)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1], $bind_arr[2]);
        elseif($c==4)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1], $bind_arr[2], $bind_arr[3]);
        elseif($c==5)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1], $bind_arr[2], $bind_arr[3], $bind_arr[4]);
        elseif($c==6)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1], $bind_arr[2], $bind_arr[3], $bind_arr[4], $bind_arr[5]);
        elseif($c==7)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1], $bind_arr[2], $bind_arr[3], $bind_arr[4], $bind_arr[5], $bind_arr[6]);
        elseif($c==8)   $stmt->bind_param($bind_string, $bind_arr[0], $bind_arr[1], $bind_arr[2], $bind_arr[3], $bind_arr[4], $bind_arr[5], $bind_arr[6], $bind_arr[7]);    
    }
    $stmt->execute();
    return $stmt->get_result();
}

//selects from database according to given prametres
//  an example; 
//  $fields = ["Name","Age","Gender"]      <--- an array
//  $sort_arr = ["Gender"=>"Male","Married"="Yes"]   <-array
//  $one = 1 if ony selects one entry otherwise default 0
//  $orderField = "Name";
//  $reverse =1 if ordered reverse otherwies default 0, here 1
//  $bind_string if want to stop sql injection, here "ss"
//  before binding - SELECT Name, Age, Gender FROM table WHERE Gender=? AND Married=? ORDER BY Name DESC;
// after binding - SELECT Name, Age, Gender FROM table WHERE Gender='Male' AND Married='Yes' ORDER BY Name DESC; 
public function select($table,$fields=0,$sort_arr=0,$one=0,$orderField=0,$reverse=0,$bind_string=0){
    if($fields) $commd = "SELECT ".$this->create_field_stmt($fields);
    else    $commd = "SELECT *";
    $commd.= " FROM ".$table;
    $bind_arr=0;
    if($sort_arr)   $commd.=" WHERE ".$this->create_where_stmt($sort_arr,$bind_string);
    if($orderField){
        $commd.=" ORDER BY ".$orderField;
        if($reverse==1) $commd.=" DESC";
    }
    if($bind_string){
        $bind_arr = array();
        foreach($sort_arr as $val)    $bind_arr[] = $val;
    }
    
    if($one)    $arr=$this->result_to_one($this->execute($commd,$bind_string,$bind_arr));
    else $arr=$this->result_to_array($this->execute($commd,$bind_string,$bind_arr));
    return $arr;        
}

//insert given to table with bindings
//an example
//  $fields = ["Name"=>"JNR","Age"=>"21","Gender"="F"]      <--- an array
// $bind_string="sds"
// $commd =  "INSERT INTO table (Name, Age, Gender) VALUES (?,?,?)  //before bind
// "INSERT INTO table (Name, Age, Gender) VALUES ('JNR','21','F')  //after bind
public function insert($fields,$bind_string,$sort_arr=0){
    $commd = "INSERT INTO ".$table."(".$this->create_field_stmt($fields).") VALUES (";
    for ($i=0; $i < sizeof($fields); $i++) {
        if($i==0)   $commd.="?";
        else        $commd.=",?";
    }
    $commd.=")";
    if($sort_arr)   $commd.=" WHERE ".$this->create_where_stmt($sort_arr,$bind_string);
    $this->execute($commd,$bind_string,$this->get_array_values($fields));     
    return;   
}    

//insert given to table with bindings
//an example
//  $fields = ["Name"=>"JNR","Age"=>"21","Gender"="F"]      <--- an array
// $bind_string="sds"
// $commd =  "INSERT INTO table (Name, Age, Gender) VALUES (?,?,?)  //before bind
// "INSERT INTO table (Name, Age, Gender) VALUES ('JNR','21','F')  //after bind
function update($fields,$values,$sort_arr,$bind_string){
    $commd = "UPDATE ".$table." SET ".$this->create_field_stmt_bind($fields);
    if($sort_arr)   $commd.=" WHERE ".$this->create_where_stmt($sort_arr,$bind_string);
    $this->execute($commd,$bind_string,$values);     
    return;   
} 










//get an array with array values of given array
function get_array_values($arr){
    $re = array();
    foreach($arr as $val)   $re[]=$val;
    return $re;
}
//converts database results to an array
function result_to_array($result){
    $arr = array();
    while($row = $result->fetch_assoc())    $arr[] = $row;
    return $arr;
}
//converts database results to a one row
function result_to_one($result){
    return $result->fetch_assoc();
} 
//converts $fields array to field1, field2 ...... format
//an example
//  $fields = ["Name","Age","Gender"]      <--- an array
// $commd="Name, Age, Gender"
function create_field_stmt($fields){
    $commd="";
    foreach($fields as $ind=>$field){
        if($ind==0)     $commd.=$field;
        else        $commd.=", ".$field;
    }
    return $commd;         
}
//converts sort_arr array to ind=value AND ..... format
//an example
//  $sort_arr = ["Age"=>"'12'","Gender"=>"'M'"]
//  $commd = "Age='12' AND Gender='M'" 
function create_where_stmt($sort_arr,$bind=0){
    $c=0;
    $commd="";
    foreach($sort_arr as $ind=>$val){
        if($c==0)   $c+=1;
        else    $commd.=" AND "; 
        if($bind)  $commd.=$ind." = ?";            
        else    $commd.=$ind." = '{$val}' ";
    }
    return $commd;
}

}



?>