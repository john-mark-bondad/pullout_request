<?php

// This is for product_to_pullout_setlist() - to filter
    
$q=$this->db->query("select distinct * from across_categories where remark='1' and parent_catid='0'  group by category");
$r=$q->result_array();


echo json_encode($r);


?>