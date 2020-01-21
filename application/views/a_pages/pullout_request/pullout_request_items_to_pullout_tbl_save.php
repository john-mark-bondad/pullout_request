<?php

$pullout_id=$_POST['pullout_id'];

$cnt=$this->db->escape_str($_POST['cnt']);
$brid=$this->db->escape_str($_POST['brid']);
$containerid=$this->db->escape_str($_POST['containerid']);
$user_accountid=$this->db->escape_str($_POST['user_accountid']);


// save to across_pullout_items
$pid=(empty($_POST['pid']))?array():$_POST['pid'];
$qty=(empty($_POST['qty']))?array():$_POST['qty'];


$inv_id=(empty($_POST['inv_id']))?array():$_POST['inv_id'];
$inv_sku=(empty($_POST['inv_sku']))?array():$_POST['inv_sku'];
$current_stock=(empty($_POST['current_stock']))?array():$_POST['current_stock'];
// $current_stock = $current_stock-$qty;

// api_id means across_pullout_items id(column)
$api_id=(empty($_POST['api_id']))?array():$_POST['api_id'];
$across_pullout_pid=(empty($_POST['pullout_id']))?array():$_POST['pullout_id'];
$pullout_qtys=(empty($_POST['pullout_qty']))?array():$_POST['pullout_qty'];
// $api_pullout_id=(empty($_POST['api_pullout_id']))?array():$_POST['api_pullout_id'];



$pullout_items_pid=(empty($_POST['pullout_items_pid']))?array():$_POST['pullout_items_pid'];
$ppullout_id=(empty($_POST['ppullout_id']))?array():$_POST['ppullout_id'];

$date_requested=date("Y-m-d H:i:s");
// $bpname=$this->db->escape_str($_POST['bpname']);
$description=$this->db->escape_str($_POST['description']);
$pullout_nums=$this->db->escape_str($_POST['pullout_num']);
$year=date("Y");
$counter=$this->mainmodel->getMaxVal("across_pullout","counter","where year='$year' and remark='1'")+1;
$counter1=$this->mainmodel->numformat(2,$counter);
$pullout_num = $year + $counter1;


if(count($pullout_qtys)==0){ $msg="There are no qty to save"; }
if(count($qty)==0){ $msg="There are no qty to save"; }
$msg=""; $sql="";



if ($pullout_id=='') {
// $a='adding';

	$pullout_id=$this->mainmodel->getMaxId("across_pullout","pullout_id")+1;
	$this->db->query("insert into across_pullout values('$pullout_id','$pullout_num','$date_requested','$user_accountid','','','','','','','0','$description','$counter','$year','1');");
	for($x=0;$x<count($pid);$x++){
		$pid1=$pid[$x];
		$qty1=$qty[$x];
		$inv_id1=$inv_id[$x];
		$inv_sku1=$inv_sku[$x];
		$current_stock1=$current_stock[$x];
		$new_qty1=$current_stock1-$qty1;

		if($qty1==0){ $msg="All Quantities should be greater than zero"; }

		$this->db->query("insert into across_pullout_items values('','$pullout_id','$pid1','$qty1','1');");

		// $this->db->query("UPDATE `across_product_inventory` 
		// 	SET new_qty='$new_qty1' where inv_id='$inv_id1' and sku='$inv_sku1' and remark='1'");

	}

}
else if($pullout_id=='edit') {
// $a='editing';

	// if ($pullout_id) {
	# code...

	$sql .= "UPDATE `across_pullout` 
	SET date_requested='$date_requested', description='$description' where pullout_num='$pullout_nums' and pullout_id='$ppullout_id'  and remark='1';";


	$sql .= "UPDATE across_pullout_items set pullout_qty='$pullout_qtys'  where id='$api_id' and pid='$pullout_items_pid' and remark='1';";


// if ($cnt==1) {
	# code...

	for($x=1;$x<count($pid);$x++){
		$pid11=$pid[$x];
		$qty11=$qty[$x];
		$inv_id1=$inv_id[$x];
		$inv_sku1=$inv_sku[$x];
		$current_stock1=$current_stock[$x];
		$new_qty1=$current_stock1-$qty11;

		if($qty1==0){ $msg="All Quantities should be greater than zero"; }


		$this->db->query("UPDATE `across_product_inventory` 
			SET new_qty='$new_qty1' where inv_id='$inv_id1' and sku='$inv_sku1' and remark='1'");
	// 	if($qty1==0){ $msg="All Quantities should be greater than zero"; }
		$pullout_id=$this->mainmodel->getMaxId("across_pullout","pullout_id")+1;
		$this->db->query("insert into across_pullout values('$pullout_id','$pullout_num','$date_requested','$user_accountid','','','','','','','0','$description','$counter','$year','1');");

		$this->db->query("insert into across_pullout_items values('','$pullout_id','$pid11','$qty11','1');");

	}

	


}


if ($msg == "") {
	$this->mainmodel->database_update1($sql);
}



// echo json_encode($a);









?>