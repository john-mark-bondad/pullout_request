<?php

$columns = array(
  0 =>'', 
  1 => 'pullout_num',
  2=> 'bpname',  //bpname
  3=>'date_requested', // Date Requested,   DATE_FORMAT(date_created,'%Y-%m-%d')
  4=>'saved_by',  // Requested By
  5=>'approved_date',  //pending_date, dispending_date, cancelled_date
  6=>'approved_by',   //pending_by, dispending_by, cancelled_by
  7=>'status', //status
  8=>'',
  9=>'',
  10=>''
  // 11=>''

);
// $status=(isset($_GET['a.status']))?$_GET['a.status']:"";

$brid=(isset($_GET['brid']))?$_GET['brid']:"";

$pid=(isset($_GET['pid']))?$_GET['pid']:"";

$containerid=(isset($_GET['containerid']))?$_GET['containerid']:"";


$bridsrch=($brid=="")?"":" and brid='$brid' ";
$requestData= $_REQUEST; 


$srchtxt=trim($this->db->escape_str($requestData['search']['value']));

$length=$_REQUEST['length'];
$start=$_REQUEST['start'];
$order_by=$_REQUEST['order'][0]['column'];
$order_byorder=$_REQUEST['order'][0]['dir'];

$orderby="order by api_id ASC";
if(isset($_REQUEST['order'])){
  $orderby=($columns[$order_by]=="")?" order by api_id ASC":"order by ".$columns[$order_by]." $order_byorder";
}


$srch="";
if(isset($requestData['search']['value'])){

  $srch=" and 
  (pullout_num like '%$srchtxt%' or 
  bpname like '%$srchtxt%'
   )";
}



$this->db->query("SET SQL_BIG_SELECTS=1");

$q1=$this->db->query("
select x.pullout_id as ap_pullout_id, pullout_num, x.date_requested as date_requested, x.saved_by as saved_by, x.description, x.status,
 a.id as api_id, a.pullout_id as api_pullout_id, a.pid as api_pid, pullout_qty,
 c.pid as product_pid, sku, product_name, brand, c.bpid as product_bpid,
  d.bpid as business_pid, bpname
  from across_pullout_items as a 
  left join across_product as c on a.pid=c.pid
  left join across_business_partner as d on c.bpid=d.bpid
  left join across_pullout as x on x.pullout_id=a.pullout_id
  where a.pid=c.pid and c.bpid=d.bpid and x.pullout_id=a.pullout_id 
  and a.remark='1' and status='0'  $srch
  
  ");
$r1=$q1->result_array();

  
$q=$this->db->query("
select x.pullout_id as ap_pullout_id, pullout_num, x.date_requested as date_requested, x.saved_by as saved_by, x.description, x.status, 
 a.id as api_id, a.pullout_id as api_pullout_id, a.pid as api_pid, pullout_qty,
 c.pid as product_pid, sku, product_name, brand, c.bpid as product_bpid,
  d.bpid as business_pid, bpname
  from across_pullout_items as a 
  left join across_product as c on a.pid=c.pid
  left join across_business_partner as d on c.bpid=d.bpid
  left join across_pullout as x on x.pullout_id=a.pullout_id
  where a.pid=c.pid and c.bpid=d.bpid and x.pullout_id=a.pullout_id 
  and a.remark='1' and status='0'  $srch

  $orderby limit $start,$length
  ");


$r=$q->result_array();    // recordsTotal
$tcnt=count($r);
$data=array();
for($x=0;$x<$tcnt;$x++){

  // Galing sa  across_pullout
$pullout_id=$r[$x]['ap_pullout_id']; // across_pullout 'pullout_id'
$pullout_num=($r[$x]['pullout_num']==0)?"N/A" : $r[$x]['pullout_num'];
$date_requested=$r[$x]['date_requested']; // Date Requested



$stat="";
if($r[$x]['status']==0){
  $stat="Pending";
}

$saved_by=$r[$x]['saved_by'];

$q2=$this->db->query("
  select * from across_p_user_account as a
  LEFT JOIN across_p_person as b ON a.eid=b.eid
  where  a.accountid='$saved_by'
  ");


$r2=$q2->result_array();
$saved_by_name=(count($r2)==0)?"N/A":$r2[0]['lname']." ".$r2[0]['ename'].", ".$r2[0]['fname']." ".$r2[0]['mname'];

$description=$r[$x]['description'];



// Galing sa  across_pullout_items
$api_id=$r[$x]['api_id'];  
$api_pullout_id=$r[$x]['api_pullout_id'];  // across_pullout_items 'pullout_id'
$api_pid=$r[$x]['api_pid'];
$pullout_qty=$r[$x]['pullout_qty'];



// Galing sa  across_product at business_partner

// -------------- view_pending 'sa_cont' table

$product_pid=$r[$x]['product_pid'];
$sku=$r[$x]['sku'];
$product_name=$r[$x]['product_name'];
// $brand=$r[$x]['brand'];
$bpname=$r[$x]['bpname'];



$q2=$this->db->query("
  SELECT DISTINCT a.pid, a.sku, inv_id, b.sku as inv_sku, new_qty as current_stock, c.pid as pullout_items_pid, pullout_qty as pullout_items_qty
  from across_product as a join across_product_inventory as b on a.sku=b.sku
  join across_pullout_items as c on a.pid=c.pid
   where  a.sku=b.sku and a.pid=c.pid and c.remark='1'
  ");
$r2=$q2->result_array();

$inv_id=$r2[$x]['inv_id'];
$inv_sku=$r2[$x]['inv_sku'];

$stock=$r2[$x]['current_stock'];
$pullout_items_qty=$r2[$x]['pullout_items_qty'];

$new_qty1=$current_stock-$pullout_qty;




$st=($x==0)?"<input type='hidden'  id='tblBB_rows_cnt' value='$tcnt'/>":"";
$data[$x] = array(
  0=>" $st

  <input type='hidden' id='tbl_p_stock$x' value='$stock'/>


  <input type='hidden' id='tbl_pending_date$x' value='$pending_date' />
  <input type='hidden' id='tbl_pending_by$x' value='$pending_by_name' />

  <input type='hidden' id='tbl_requested_by$x' value='$save_by_name' />

  <input type='hidden' id='tbl_pending_requested_date$x' value='$date_requested' />

  <input type='hidden' id='tbl_pullout_num$x' value='$pullout_num' />
  <input type='hidden' id='tbl_bpname$x' value='$bpname' />
  <input type='hidden' id='tbl_description$x' value='$description' />

  <input type='hidden' id='tbl_pending_sku$x' value='$sku' />
  <input type='hidden' id='tbl_pending_product_name$x' value='$product_name' />
  <input type='hidden' id='tbl_prev_qty$x' value='$prev_qty' />

  <input type='hidden' id='tbl_dispending_by$x' value='$dispending_by_name' />
  <input type='hidden' id='tbl_dispending_date$x' value='$disapprove_date' />
  <input type='hidden' id='tbl_cancelled_by$x' value='$cancelled_by_name' />
  <input type='hidden' id='tbl_cancelled_date$x' value='$cancelled_date' />

<input type='hidden' id='tbl_pending_p_pid$x' value='$product_pid' />
  <input type='hidden' id='tbl_pending_pid$x' value='$api_pullout_id' />
  <input type='hidden' id='tbl_pending_pullout_id$x' value='$pullout_id' />
  <input type='hidden' id='tbl_status$x' value='$status' />
  <input type='hidden' id='tbl_currentStock$x' value='$current_stock'/>

  <input type='hidden' id='tbl_pending_api_pid$x' value='$api_pid'/>

  <input type='hidden' id='tbl_pid_items$x' value='$pid_items'/>
  <input type='hidden' id='tbl_items_pullout_id$x' value='$items_pullout_id'/>

<input type='hidden' id='tbl_pending_pullout_qty$x' value='$pullout_qty'/>
  <input type='hidden' id='tbl_items$x' value='$r11' />
  <div id='tbl_items_$x' style='display:none;'>$r11</div>
  <input type='hidden' id='tbl_draft_details$x' value='$rditems' />
  <input type='hidden' id='tbl_draft_details$x' value='$draft_details_json' />

  <input type='hidden' id='tbl_id$x' value='$api_id' />

  ",
  1=>"$pullout_num",
  2=>"$bpname",
  3=>"$date_requested",
  4=>"$saved_by_name", // 'saved_by' this is pending status
  5=>"n/a",
  6=>"n/a",
  7=> "$stat",
  8=>"<button class='btn' style='width:100%; background:rgba(0,0,0,0);' onclick='view_pending($x)'><span class='glyphicon glyphicon-search'></span></button>",
  9=>"<button class='btn' style='background:rgba(0,0,0,0); width:100%; font-size:15px;' title='Edit' onclick='pullout_edit($x)'><span class='glyphicon glyphicon-edit'></span></button>",
  10=>"<button class='btn' style='background:rgba(0,0,0,0); width:100%; font-size:15px;' title='Delete' onclick='pullout_delete($x)'><span class='glyphicon glyphicon-remove'></span></button>"
);



// 11=>"<button class='btn btn-success approvebtn' onclick='approve_pullout_process_save($x);' >Approve</button>
// "




} // end for loop


$json_data = array(
  "draw"            => intval( $_REQUEST['draw'] ),
  "recordsTotal"    => intval(count($r)),
  "recordsFiltered" => intval(count($r1)),
  "data"            => $data
);

echo json_encode($json_data);

?>

