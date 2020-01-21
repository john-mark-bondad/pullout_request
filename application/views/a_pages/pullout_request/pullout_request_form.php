

<style type="text/css"> 
	.fsetcont{ display: none;}
</style>




<div id='t_content'>

<div id='t_header'>
<button class='btn btn-primary fbtn' id='fbtn1'  onclick="fsetcont(1); "><span class='glyphicon glyphicon-list'></span> Details</button>
<button class='btn btn-primary fbtn' id='fbtn2'  onclick="fsetcont(2); "><span class='glyphicon glyphicon-list'></span> Item Options</button>
<button class='btn btn-primary fbtn' id='fbtn3'    onclick="fsetcont(3);  "><span class='glyphicon glyphicon-list'></span> Items to pullout<span>(<span id='addtock_items_qty' class="pulloutNum">0</span>)</span></button>
</div>




<div id='fsetcont1' class='fsetcont'>
<?php $this->load->view("a_pages/pullout_request/pullout_request_details_form"); ?>
</div>

<div id='fsetcont2' class='fsetcont'>
<?php $this->load->view("a_pages/pullout_request/pullout_request_item_options_form_tbl"); ?>
</div>



<div id='fsetcont3' class='fsetcont'>
<?php $this->load->view("a_pages/pullout_request/pullout_request_items_to_pullout_tbl"); ?>
</div>





</div>
<script type="text/javascript">
$(document).ready(function(){

// 	var table = document.getElementById("addtock_items_qty");
// var totalRowCount = table.length;
fsetcont(1);

$( ".datepicker" ).datepicker({
     changeMonth: true,
      changeYear: true,
    dateFormat: "yy-mm-dd"
  });	

});


function fsetcont(n){
$('.fsetcont').hide();
$('#fsetcont'+n).show();	

$('.fbtn').css({'color':'#fff'});
$('#fbtn'+n).css({'color':'yellow'});
}




</script>