<?php

$brid=$this->db->escape_str($_POST['brid']);
$containerid=$this->db->escape_str($_POST['containerid']);
$user_accountid=$this->db->escape_str($_POST['user_accountid']);

$approved_date=date("Y-m-d H:i:s");
$pullout_nums=$this->db->escape_str($_POST['pullout_num']);
$across_pullout_pid=(empty($_POST['pullout_id']))?array():$_POST['pullout_id'];


$sql .= "UPDATE `across_pullout` 
SET approved_date='$approved_date', approved_by='$user_accountid', status='1'  where pullout_id='$across_pullout_pid' and pullout_num='$pullout_nums' and  remark='1';";


if ($msg == "") {
    $this->mainmodel->database_update1($sql);
}



?>