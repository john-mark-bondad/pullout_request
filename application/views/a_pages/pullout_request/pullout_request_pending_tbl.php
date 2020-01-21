
<div id='t_header'>
    <button class='btn btn-primary' style='<?= $st; ?>' onclick="SYS_add_product_form()"><span class='glyphicon glyphicon-plus'></span>Add Pull Out</button>
</div>

<!-- <input type='hidden' id='form_pullout_id' value=''/> -->

<div style='padding:1%; padding-top:1.5%;'>
    <input type='hidden' id='filter_branchid' value=''/>
 <span id='filter_name'></span>
</div>
<hr>

<input type='hidden' id='form_pullout_id' value=''/>

<div>
    <label>Status</label>
    <select id='stat_filter' onchange='settblCol();'>
        <option value="0">Pending</option>
        <option value="1">Approved</option>
        <option value="2">Disapproved</option>
        <option value="3">Cancelled</option>
    </select>
</div>

<div style='margin-top:0.5%; padding:1.5%;' class='table-responsive'>

    <!-- style='visibility:hidden;' -->
    <table id='t_maintable' class='table table-bordered table-striped table-condensed table-hover' >
        <thead>
            <tr>


             <th style='width:5px;'></th>
             <th style='width:50px;'>Pull out No.</th>
             <th style='width:50px;'>Supplier/Business Partner</th>
             <th style='width:55px;'>Date requested</th>
             <th style='width:50px;'>Requested By</th>
             <th style='width:50px;' id='ap_col1'>Date Pending</th>
             <th style='width:50px;' id='ap_col2'>Approved By</th>
             <th style='width:50px;'>Status</th>
             <th style='width:50px;'>View</th>
             <th style='width:50px;'>Edit</th>
             <th style='width:50px;'>Delete</th>
             <!-- <th style='width:50px;'>Approve</th> -->
         </tr>
     </thead>
     <tbody>

     </tbody>
 </table>

<input type='hidden' id='form_sa_addstockcnt' value='0'>

</div>
<script type="text/javascript">
$(document).ready(function(){
setTimeout(function(){
settblCol();

},500);



});
</script>