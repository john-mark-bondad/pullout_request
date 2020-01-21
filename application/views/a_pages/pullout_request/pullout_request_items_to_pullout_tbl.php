<style type="text/css">
	.setcont{ display: none; }
</style>


<!-- <input type='hidden' id='form_mode' value='edit'> -->
<div class='row setcont'>
	<div class='col-sm-10'><label></label><b>Pullout QTY<b></div>
		<div class='col-sm-12'><input type='text' id='form_pullout_qty' class='textbox' style='height: 66px; width: 66%;'  value=""/>
		</div>
	</div>

	<input type='hidden' id='form_api_id' class='textbox setcont' style='height: 66px; width: 66%;'  value=""/>
	
<input type="hidden" class="form-control"  aria-describedby="basic-addon1" id='form_api_id' style='background:#fff;' value='' disabled>

	<!-- <p>Pullout ID</p> -->
	<input type='hidden' id='form_p_pullout_id' class='textbox setcont' style='height: 66px; width: 66%;'  value=""/>


	<input type='hidden' id='form_pullout_num' class='textbox setcont' style='height: 66px; width: 66%;'  value=""/>

	<div class='table-responsive' style='padding:2%;'>


		<!-- <p>id</p> -->
		<input type="hidden" class="form-control setcont"  aria-describedby="basic-addon1" id='form_id' style='background:#fff;' value='' disabled>

		<input type="hidden" class="form-control"  aria-describedby="basic-addon1" id='form_pullout_items_pid' style='background:#fff;' value='' disabled>

		<table class='table table-bordered' id='product_addtostock_toadd'>
			<thead>


				<th style='width:50px;'>SKU</th>
				<th style='width:50px;'>Item Name</th>
				<th style='width:50px;'>Qty to pull out</th>
				<th style='width:5px;'>Remove</th>
			</thead>
			<tbody></tbody>
		</table>


<!-- 
<input type='text' id='form_product_name' class='textbox' style='height: 20px; width: 16%;'  value=""/> -->




	</div>
	<div class='row' id="save" style='padding:2%;'>
		<div class='col-sm-12' align='right'>
			<button class='btn btn-success' onclick='add_pullout_save()'><span class='glyphicon glyphicon-save'></span> Process Request</button>
		</div>
	</div>
	<!-- <input type='hidden' id='form_addstockcntP' value='0'> -->
	<input type='hidden' id='form_addstockcnt' value='0'>


<input type='hidden' id='form_p' value="0">

	<input type="hidden" id="form_counter" value="<?= $counter; ?>">

	

	<script type="text/javascript">
		$(document).ready(function(){

			setcont(1);
		});



</script>