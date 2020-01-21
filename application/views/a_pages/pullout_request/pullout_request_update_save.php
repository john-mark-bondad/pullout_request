<?php

$pullout_id = $_POST['pullout_id']; // pullout_id of across_pullout


$id=$_POST['id'];

$pid=(empty($_POST['pid']))?array():$_POST['pid'];

// api_id means across_pullout_items id(column)
$id=(empty($_POST['api_id']))?array():$_POST['api_id'];
$pullout_qty=(empty($_POST['pullout_qty']))?array():$_POST['pullout_qty'];



$pullout_num=$_POST['pullout_num'];

$status=$_POST['status'];
$date_requested=$_POST['date_requested'];
$description=$this->db->escape_str($_POST['description']);



$msg=""; $sql="";


$sql .= "UPDATE `across_pullout` SET date_requested='$date_requested', `description`='$description' where pullout_num='$pullout_num' and status='0' and remark='1';";

 $sql .= "UPDATE across_pullout_items set pullout_qty='$pullout_qty' where  id='$id' and remark='1';";
  



if ($msg == "") {
    $this->mainmodel->database_update1($sql);
}




?>