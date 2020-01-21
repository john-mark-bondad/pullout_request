<?php

ini_set ('max_execution_time', 92428800000000000000000000); 
ini_set ('max_allowed_packet', 52428800000000000000000000); 


$branchid=$this->db->escape_str($_GET['branchid']);

$columns = array(
  0=>'',
  1=>'sku',
  2=>'product_name',
  3 =>'brand',
  4 => ''
);




$catid=(isset($_GET['catid']))?$_GET['catid']:"";
$catsrch=($catid=="")?"":" and b.pid in(select pid from across_prod_catid where  catid='$catid' and remark='1')";



$filtersrch="";


$catid1=(isset($_GET['catid1']))?$_GET['catid1']:"";
$catsrch1=($catid1=="")?"":" and a.pid in(select pid from across_prod_catid where  catid='$catid1' and remark='1')";



$filtersrch.=$catsrch1;







$attrid=(isset($_GET['attrid']))?$_GET['attrid']:"";
$attrsrch=($attrid=="")?"":" and a.pid in(select pid from across_prod_attrid where  attrid='$attrid')";
$filtersrch.=$attrsrch;



$bpid=(isset($_GET['bpid']))?$_GET['bpid']:"";
$bpsrch=($bpid=="")?"":" and a.bpid='$bpid'";
$filtersrch.=$bpsrch;


$description=(isset($_GET['description']))?$_GET['description']:"";
$descsrch=($description=="")?"":" and description like '%$description%'";
$filtersrch.=$descsrch;



$brand=(isset($_GET['brand']))?$_GET['brand']:"";
$brandsrch=($brand=="")?"":" and brand like '%$brand%'";
$filtersrch.=$brandsrch;








$requestData= $_REQUEST; 

$srchtxt=trim($this->db->escape_str($requestData['search']['value']));


$length=$_REQUEST['length'];
$start=$_REQUEST['start'];
$order_by=$_REQUEST['order'][0]['column'];
$order_byorder=$_REQUEST['order'][0]['dir'];




$orderby="order by product_name ASC";
if(isset($_REQUEST['order'])){
  $orderby=($columns[$order_by]=="")?"order by product_name ASC":"order by ".$columns[$order_by]." $order_byorder";
}


$srch="";
if(isset($requestData['search']['value'])){
  $srch=

  " and 
  (
  product_name like '%$srchtxt%' or
  brand like '%$srchtxt%' or
  c.sku like '%$srchtxt%' or
  description like '%$srchtxt%' or
  bpname like '%$srchtxt%'

)";

}




$sql="
 
SELECT a.catid, b.catid, b.pid, c.pid as prod_pid, c.sku, product_name, brand, c.bpid, d.bpid, bpname, e.inv_id, e.sku as inv_sku, new_qty as current_stock  
from across_categories as a  
join across_prod_catid as b on a.catid=b.catid 
 join across_product as c on b.pid=c.pid
join across_business_partner as d on c.bpid=d.bpid
join across_product_inventory as e on c.sku=e.sku  where c.sku=e.sku
$srch
$catsrch $filtersrch group by c.pid 
";


// SELECT a.catid, b.catid, b.pid, c.pid, sku, product_name, brand, c.bpid, d.bpid, bpname  from across_categories as a LEFT join across_prod_catid as b on a.catid=b.catid LEFT join across_product as c on b.pid=c.pid LEFT join across_business_partner as d on c.bpid=d.bpid  where  b.pid=c.pid and 
// a.remark='1' and b.remark='1' and c.remark='1' $srch
// $catsrch $filtersrch group by c.pid


// SELECT a.catid, b.catid, b.pid, c.pid, c.sku, product_name, brand, c.bpid, d.bpid, bpname, e.inv_id, e.sku, new_qty as current_stock  
// from across_categories as a  
// join across_prod_catid as b on a.catid=b.catid 
//  join across_product as c on b.pid=c.pid
// join across_business_partner as d on c.bpid=d.bpid
// join across_product_inventory as e on c.sku=e.sku  where c.sku=e.sku
// $srch
// $catsrch $filtersrch group by c.pid

$q1=$this->db->query($sql);
$r1=$q1->result_array();


$q=$this->db->query("
  
SELECT a.catid, b.catid, b.pid, c.pid as prod_pid, c.sku, product_name, brand, c.bpid, d.bpid, bpname, e.inv_id, e.sku inv_sku, new_qty as current_stock  
from across_categories as a  
join across_prod_catid as b on a.catid=b.catid 
 join across_product as c on b.pid=c.pid
join across_business_partner as d on c.bpid=d.bpid
join across_product_inventory as e on c.sku=e.sku  where c.sku=e.sku
$srch
$catsrch $filtersrch group by c.pid $orderby
 limit $start,$length 
 ");


$r=$q->result_array();
$tcnt=count($r);
$data=array();



for($x=0;$x<$tcnt;$x++){
  $pid=$r[$x]['prod_pid'];  // across_product pid
  $sku=$r[$x]['sku'];
  $product_name=$r[$x]['product_name'];
  $brand=$r[$x]['brand'];



$current_stock=$r[$x]['current_stock']; 
$inv_id=$r[$x]['inv_id'];
 $inv_sku=$r[$x]['inv_sku'];



$st=($x==0)?"<input type='hidden'  id='tblB_rows_cnt' value='$tcnt'/>":"";

  $data[$x] = array(
    0=>"
    $st
    <input type='hidden' id='tbl_p_current_stock$x' value='$current_stock' />
    <input type='hidden' id='tbl_p_inv_id$x' value='$inv_id' />
    <input type='hidden' id='tbl_p_inv_sku$x' value='$inv_sku' />
    

    <input type='hidden' id='tbl_id$x' value='$id'/>
    <input type='hidden' id='tbl_b_pid$x' value='$pid'/>
    <input type='hidden' id='tbl_b_sku$x' value='$sku'/>
    <input type='hidden' id='tbl_b_product_name$x' value='$product_name'/>
    <input type='hidden' id='tbl_b_brand$x' value='$brand'/>
    <input type='hidden' id='tbl_a_bpid$x' value='$bpid'/>
    <input type='hidden' id='tbl_a_bpname$x' value='$bpname'/>
    <input type='hidden' id='tbl_sub_catid$x' value='$sub_catid'/>
    <input type='checkbox' id='tbl_addstckchk$x' class='tbl_addstckchk' value='$x'/>
    ",
    1=>"$sku",
    2=>"$product_name",
    3=>"$brand",
    4=>"$current_stock"
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