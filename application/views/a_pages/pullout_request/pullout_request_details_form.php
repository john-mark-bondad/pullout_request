<style type="text/css">
	.asti .row{ margin-bottom:1%;}
	
	.setcont{ display: none; } 
	
</style>

<div class='asti' style='padding:2%;'>

	

	<input type='hidden' id='form_draftid' value=''>
	<div class='row'>
		<div class='col-sm-12'>
			<label>Business Partner</label>
			<div class="input-group" onclick='business_partner_search()'> 
				<input type='hidden' id='form_bpid'value='' />
				<input type='hidden' id='form_bpgroup' value=''/>
				<input type='hidden' id='form_bpcode' value=''/>	
				<input type='text'   id='form_bpname' placeholder='Select a Business Partner'  class='form-control' style='background:#fff;' disabled>
				<span class="input-group-addon btn" id="basic-addon1" ><b><span class='glyphicon glyphicon-search'></span></b></span> 
			</div>
		</div>
	</div>



	<div class='row'>
		<div class='col-sm-10'><label></label><b>Description<b></div>
			<div class='col-sm-12'><input type='text' id='form_description' class='textbox' style='height: 66px; width: 66%;'  value="<?= $description; ?>"/>
			</div>
		</div>

		
		<input type="text" class="form-control setcont"  aria-describedby="basic-addon1" id='form_pullout_num' style='background:#fff;' value='' disabled>



		<input type='text' id='form_pid' class='textbox setcont' style='height: 66px; width: 66%;'  value=""/>
		

		<input type='text' id='form_date_requested' class='form-control  datepicker setcont'  placeholder="yyyy-mm-dd h-m-s">


		
		<div class='row'>
			<div class='col-sm-12' align='right'>
				<button class='btn btn-success' id="btn1" onclick='fsetcont(2); details_form_save();'>Next<span class='glyphicon glyphicon-arrow-right'></span> </button>
			</div>
		</div>



	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			function fsetcont(n){
				$('.btn1').hide();
				$('#btn1'+n).show();
			}

		});
	</script>
