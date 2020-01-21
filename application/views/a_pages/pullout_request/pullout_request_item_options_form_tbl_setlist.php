<?php

// This is for Search Business Partner (when selected) the 'Item Options' will load

$brid=$_GET['brid'];


    $columns = array(
    0=>'',
    1=>'sku',
    2=>'product_name',
    3 =>'brand', //etch
    4 => 'current_stock'
);



$bpid=(isset($_GET['bpid']))?$_GET['bpid']:"";



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

$srch=" and 
(
  a.sku like '%$srchtxt%' or  
  product_name like '%$srchtxt%'  or  
  brand like '%$srchtxt%'
  )
";

}


$sql="
select pid as product_id, a.bpid as product_bpid, a.sku, product_name, brand, bpname, b.bpid as business_bpid, new_qty as current_stock, f.sku as inv_sku, inv_id
  from across_product as a 
   JOIN across_business_partner as b ON a.bpid=b.bpid
  join across_product_inventory as f on f.sku=a.sku where  f.sku=a.sku
 and a.remark='1' and a.bpid='$bpid'
$srch  group by a.pid
";



// select pid as product_id, a.bpid as product_bpid, sku, product_name, brand, bpname, b.bpid as business_bpid
//   from across_product as a 
//   LEFT JOIN across_business_partner as b ON a.bpid=b.bpid
//   where a.remark='1' and a.bpid='$bpid'
// $srch  group by pid


$q1=$this->db->query($sql );
$r1=$q1->result_array();


$q=$this->db->query("
select pid as product_id, a.bpid as product_bpid, a.sku, product_name, brand, bpname, b.bpid as business_bpid, new_qty as current_stock, f.sku as inv_sku, inv_id
  from across_product as a 
   JOIN across_business_partner as b ON a.bpid=b.bpid
  join across_product_inventory as f on f.sku=a.sku where  f.sku=a.sku and a.remark='1'
  and a.bpid='$bpid' 
$srch  $catsrch group by pid $orderby
    limit $start,$length
    ");

$r=$q->result_array();
$tcnt=count($r);
$data=array();



for($x=0;$x<$tcnt;$x++){
$pid=$r[$x]['product_id'];
$sku=$r[$x]['sku'];
$product_name=$r[$x]['product_name'];
$brand=$r[$x]['brand'];

$bpname=$r[$x]['bpname'];

$a_bpid=$r[$x]['product_bpid'];
$b_bpid=$r[$x]['business_bpid'];



// galing sa across_product_inventory
$current_stock=$r[$x]['current_stock'];
$inv_id=$r[$x]['inv_id'];
$inv_sku=$r[$x]['inv_sku'];



$q31=$this->db->query("
  select pullout_qty from across_pullout_items 
  ");
$r31=$q31->result_array();


// -------------- view pending 'sa_cont' table
$pullout_qty=$r31[$x]['pullout_qty'];


// $current_stock=$this->mainmodel->get_current_qty($pid,$sku,$brid);





$st=($x==0)?"<input type='hidden'  id='tblB_rows_cnt' value='$tcnt'/>":"";


$data[$x] = array(
  0=>"
$st


<input type='hidden' id='tbl_p_current_stock$x' value='$current_stock' />
    <input type='hidden' id='tbl_p_inv_id$x' value='$inv_id' />
    <input type='hidden' id='tbl_p_inv_sku$x' value='$inv_sku' />

<input type='hidden' id='tbl_categ_json$x' value='$categ_json'/>  
<input type='hidden' id='tbl_attr_json$x' value='$attr_json'/> 

<input type='hidden' id='tbl_a_bpid$x' value='$a_bpid'/>
<input type='hidden' id='tbl_b_bpid$x' value='$b_bpid'/>

<input type='hidden' id='tbl_b_id$x' value='$id'/>
<input type='hidden' id='tbl_b_pid$x' value='$pid'/>
<input type='hidden' id='tbl_b_sku$x' value='$sku'/>
<input type='hidden' id='tbl_b_product_name$x' value='$product_name'/>
<input type='hidden' id='tbl_b_brand$x' value='$brand'/>


<input type='hidden' id='tbl_pdid$x' value='$pdid'/>


<input type='hidden' id='tbl_b_id_num$x' value='$id_num'/>
<input type='hidden' id='tbl_b_catid$x' value='$catid'/>
<input type='hidden' id='tbl_b_uid$x' value='$uid'/>
<input type='hidden' id='tbl_b_attrid$x' value='$attrid'/>
<input type='hidden' id='tbl_b_varid$x' value='$varid'/>

<input type='hidden' id='tbl_b_bpname$x' value='$bpname'/>

<input type='hidden' id='tbl_b_attribute$x' value='$attr'/>
<input type='hidden' id='tbl_b_variation$x' value='$variation'/>

<input type='hidden' id='tbl_b_category$x' value='$categs'/>
<input type='hidden' id='tbl_b_subcategory$x' value='$subcateg'/>

<input type='hidden' id='tbl_b_unit$x' value='$unit'/>


<input type='hidden' id='tbl_b_pdid$x' value='$pdid'/>
<input type='hidden' id='tbl_b_sub_catid$x' value='$sub_catid'/>

<input type='hidden' id='tbl_b_department$x' value='$department'/>


<input type='hidden' id='tbl_b_reg_price$x' value='$regular_price'/>
<input type='hidden' id='tbl_b_sales_price$x' value='$sales_price'/>

<input type='hidden' id='tbl_b_critical_level$x' value='$reorder_qty'/>


<input type='hidden' id='tbl_b_description$x' value='$description'/>

<input type='hidden' id='tbl_b_fileid$x' value='$fileid'/>

<input type='hidden' id='tbl_b_location$x' value='$location'/>


<input type='hidden' id='tbl_items_pullout_qty$x' value='$pullout_qty'/>




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