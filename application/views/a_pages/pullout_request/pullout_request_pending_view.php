<div id='t_header'>
<button class='btn btn-primary' style='' onclick="setcont(1)"><span class='glyphicon glyphicon-arrow-left'></span> Back</button>
</div>
<div>

<input type='hidden' id='draft_details_json' value=''/>
<input type='hidden' id='rditems' value=''/>
<input type='hidden' id='draft_items_json' value=''/>

<div class='col-sm-10' style='padding-top:2%;'>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">PO No.</span>
  <input type="text" class="form-control"  aria-describedby="basic-addon1" id='sa_wrr' style='background:#fff;' value='' disabled>
</div>
</div>

<!-- across_pullout_items id -->

<input type="hidden" class="form-control"  aria-describedby="basic-addon1" id='sa_api_id' style='background:#fff;' value='' disabled>

<div class='col-sm-10' style='padding-top:2%;'>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Business Partner</span>
  <input type="text" class="form-control"  aria-describedby="basic-addon1" id='sa_bpname' style='background:#fff;' value='' disabled>
</div>
</div>



<div class='col-sm-10' style='padding-top:2%;'>
<label>Description</label>
<textarea class="form-control freset" id="sa_desc" spellcheck="false" style="background-color: #fff" disabled></textarea>
</div>
</div>


<div class='col-sm-10' style='padding-top:2%;'>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Request Date(yyyy-mm-dd)</span>
  <input type="text" class="form-control"  aria-describedby="basic-addon1" id='sa_request_date' style='background:#fff;' value='' disabled>
</div>
</div>




<div class='row'>
<div class='col-sm-12' style='padding-top:2%;'>

<table class='table table-bordered table-hover table-striped' id='sa_cont'>
<thead>

<tr> 
<th style='width:50px;'>SKU</th>
<th style='width:50px;'>Item Name</th>
<th style='width:50px;'>Qty to pull out</th>
</tr>

</thead>
<tbody></tbody>
</table>



</div>
</div>



</div>