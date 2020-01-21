<?php

    $columns = array(

    0 =>'',
    1 =>'bpname',
    2=>'',
    4=>''
);


$brid=(isset($_GET['brid']))?$_GET['brid']:"";

$bridfilter=($brid=="")?"":"and d.brid='$brid'";



$requestData= $_REQUEST; 

$srchtxt=trim($this->db->escape_str($requestData['search']['value']));


$length=$_REQUEST['length'];
$start=$_REQUEST['start'];
$order_by=$_REQUEST['order'][0]['column'];
$order_byorder=$_REQUEST['order'][0]['dir'];

$orderby="order by bpid ASC";
if(isset($_REQUEST['order'])){
$orderby=($columns[$order_by]=="")?"order by bpid ASC":"order by ".$columns[$order_by]." $order_byorder";
}

$srch="";
if(isset($requestData['search']['value'])){
$srch=" and 
(
bpname like '%$srchtxt%' 
 )";
}


$q1=$this->db->query("
select  * from 
  across_business_partner
    where
    remark='1'

$srch 
    ");
//$bridfilter  and b.cid!='0'
$r1=$q1->result_array();


$q=$this->db->query("
select  * from 
  across_business_partner
    where
    remark='1'

$srch 
    $orderby
    limit $start,$length
	");



$r=$q->result_array();
$tcnt=count($r);
$data=array();
for($x=0;$x<$tcnt;$x++){
$bpid=$r[$x]['bpid'];
$bpname=$r[$x]['bpname'];
$bpgroup=$r[$x]['bpgroup'];

$bg="";
if($bpgroup=="1"){  $bg="Outright"; }
else if($bpgroup=="5"){ $bg="Concessionaire"; }




$bpdata=json_encode($r[$x]);

$data[$x] = array(
    0=>" 
    <input type='hidden' id='tbl_bpid$x' value='$bpid'/>
    <input type='hidden' id='tbl_bpnames$x' value='$bpname'/>
    <input type='hidden' id='tbl_bpgroup$x' value='$bpgroup'/>
    ",
    1 =>"$bpname",
    2=>"$bg",
    3=>"<button class='btn' style='background:rgba(0,0,0,0); width:100%; font-size:15px; $st1' title='Select' onclick='business_partner_select($x)'><span class='glyphicon glyphicon-edit'></span></button>"
    );

}



 $json_data = array(
                "draw"            => intval( $_REQUEST['draw'] ),
                "recordsTotal"    => intval(count($r)),
                "recordsFiltered" => intval(count($r1)),
                "data"            => $data
            );

    echo json_encode($json_data);


    ?>