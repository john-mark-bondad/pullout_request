
<div style='padding:2%;'>
	<label>Category</label>
	<select id='filter_category'  onchange='product_to_pullout_setlist();'></select>
</div>




<div class='table-responsive' style='padding:2%; height:400px;'>


	<table class='table table-bordered' id='product_addtostock'>
		<thead>
			<th style='width:5px;' ><input type='checkbox' id='tblchkm'></th>
			<!-- <th style='width:5px;' ></th> -->
			<th style='width:50px;'>SKU</th>
			<th style='width:50px;'>Item Name</th>
			<th style='width:50px;'>etch</th>
			<th style='width:50px;'>Current Stock</th>

		</thead>
		<tbody></tbody>
	</table>



</div>
<hr>
<div class='row' style='padding:2%;'>
	<div class='col-sm-6'>


		<div class="dropup">
			<div class="btn-group">
				<button type="button" title='Check Options' class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class='glyphicon glyphicon-option-horizontal'></span> 
				</button>
				<ul class="dropdown-menu">
					<li><a href="#" onclick='checkAll(1)'>Check All visible rows</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#" onclick='checkAll(0)'>Uncheck all visible rows</a></li>
					
					
				</ul>
			</div>
		</div>


	</div>
	<div class='col-sm-6' align='right'>
		<button class='btn btn-success' onclick='add_checkitemstoAddstock();'>
			<span class='glyphicon glyphicon-plus'></span> Add selected Items</button>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			

			var promise1 = new Promise(function(resolve, reject) {
				setCategoryOptions();
				setTimeout(function(){ resolve(1); },250);
			});

			promise1.then(function(success){
				if(success){
					product_to_pullout_setlist();		
				}
			});
			
			
			

			$('#tblchkm').on('change',function(){
				if($(this).is(" :checked")){
					checkAll(1);	
				}
				else{
					checkAll(0);	
				}




			});


			// function fsetcont(n){
			// 	$('.fsetcont').hide();
			// 	$('#fsetcont'+n).show();
			// }


			product_addtostock();

		});


		function return_false(){
			return false;
		}


	</script>




