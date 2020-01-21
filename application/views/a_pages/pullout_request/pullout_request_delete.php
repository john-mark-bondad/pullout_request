<?php

$pullout_id=$this->db->escape_str($_POST['pullout_id']);
$msg=""; $sql="";

$sql.="update across_pullout set remark='0' where pullout_id='$pullout_id';";
$sql.="update across_pullout_items set remark='0' where pullout_id='$pullout_id';";

if($msg==""){ $this->mainmodel->database_update1($sql); }

$a['msg']=$msg;
echo json_encode($a);


?>