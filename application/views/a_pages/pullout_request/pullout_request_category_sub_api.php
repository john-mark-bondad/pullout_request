<?php
$catid=$_POST['catid'];
      
$q=$this->db->query("select distinct * from across_categories where remark='1' and parent_catid='$catid'");
$r=$q->result_array();


echo json_encode($r);



?>