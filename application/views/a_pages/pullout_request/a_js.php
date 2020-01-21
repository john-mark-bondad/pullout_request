
<script type="text/javascript">


    function setcont(n){
       $('.setcont').hide();
       $('#setcont'+n).show();
   }

   function SYS_TableServerside2(url,tbl){
    SYS_TableStart(tbl);  
    $(tbl).fadeIn(); 
    var oTable=$(tbl).DataTable({
        "processing": true,
        "serverSide": true,
        "bSort": true,
        "bInfo": false,
        "bFilter": true,
        "ajax": {
            "url": url,
            "dataType": "json",
            "error": function(jqXHR, textStatus, errorThrown){
                $(tbl+' tbody').html("<tr><td colspan='10'>No Results Found</td></tr>");
                $(tbl+' .dataTables_info').text("Showing 0 to 0 of 0 entries");
            }
        },
        "columnDefs":[{
            "target":[0,5],
            "orderable":false
        }],
        "aLengthMenu": [[5,10,25, 50, 75, 100], [5,10,25, 50, 75, 100]],
        "pageLength": 5

    });

    $(tbl+'_filter input').unbind();
    $(tbl+'_filter input').bind('change', function() {
        oTable.search(this.value).draw();    
    }); 


    $(tbl).css({'visibility':'visible'});
}




function settblCol(){
    var status=$('#stat_filter').val();
    // console.log(status);
    if(status==0){
        $('#ap_col1').text("Pending Date");
        $('#ap_col2').text("Approved By");
        var link=URL+"index.php/pullout_request/loadPullOutRequestPendingSetlist";
        SYS_TableServerside2(link,'#t_maintable');
    }
    else if(status==1){
        $('#ap_col1').text("Approved Date");
        $('#ap_col2').text("Approved By");
        var link=URL+"index.php/pullout_request/loadPullOutRequestApprovedSetlist";
        SYS_TableServerside2(link,'#t_maintable');
        // alert(link);
    }
    else if(status==2){
        $('#ap_col1').text("Disapprove Date");
        $('#ap_col2').text("Disapproved By");
        var link=URL+"index.php/pullout_request/loadPullOutRequestDisapprovedSetlist";
        SYS_TableServerside2(link,'#t_maintable');
    }
    else if(status==3){
        $('#ap_col1').text("Cancelled Date");
        $('#ap_col2').text("Cancelled By");
        var link=URL+"index.php/pullout_request/loadPullOutRequestCancelledSetlist";
        SYS_TableServerside2(link,'#t_maintable');
    }

// alert(status);
}







function loadPullOutRequestApprovedSetlist(){

    var brid=$('#filter_branchid').val();
    var containerid=$('#filter_container').val();

    var status=$("#stat_filter").val();

    var link=URL+"index.php/pullout_request/loadPullOutRequestApprovedSetlist?name=Xssd23SqQ&brid="+brid+"&containerid="+containerid+"&status="+status+"";
    SYS_TableServerside2(link,'#t_maintable'); 
    $('#t_maintable').css({'visibility':'visible'});

}

function SYS_pending_setlist(){

    var brid=$('#filter_branchid').val();
    var containerid=$('#filter_container').val();

    var status=$("#stat_filter").val();

    var link=URL+"index.php/pullout_request/loadPullOutRequestPendingSetlist?name=Xssd23SqQ&brid="+brid+"&containerid="+containerid+"&status="+status+"";
    SYS_TableServerside2(link,'#t_maintable'); 
    $('#t_maintable').css({'visibility':'visible'});

}

function SYS_approved_tbl(){

    var brid=$('#filter_branchid').val();
    var containerid=$('#filter_container').val();
    // var status=$("#stat_filter").val();

    var approved=$("#form_approved").val();

    var link=URL+"index.php/pullout_request/loadPullOutRequestApprovedTbl?name=Xssd23SqQ&brid="+brid+"&containerid="+containerid+"&status="+status+"&approved="+approved;
    SYS_TableServerside2(link,'#t_maintable1'); 
    $('#t_maintable').css({'visibility':'visible'});

}

		// Add Pull Out
        function SYS_add_product_form(){


           var pullout_id=$('#tbl_pending_pullout_id').val();
           $('#dialog1').remove();
           $('body').append("<div id='dialog1'></div>"); /*Creates a virtual DOM <div id='dialog1'></div>*/


           SYS_dialog3('#dialog1','495','950px','Create Pullout Request',function(){  });
         // mode:'add',pullout_id:''
         $.post(URL+"index.php/pullout_request/loadPullOutRequestForm",{pullout_id:''}).done(function(data){
            $("#dialog1").html(data).dialog("open");
        });  
     }



		// Check/Uncheck All visible rows
        function checkAll(n){
            if(n==0){ $('.tbl_addstckchk').prop('checked',false); }
            else{ $('.tbl_addstckchk').prop('checked',true); }
        }





        function product_to_pullout_setlist(){
            // #filter_category
            SYS_TableStart('#product_addtostock'); 
            var catid=$('#filter_category').val();
            var link=URL+"index.php/pullout_request/loadCategorySetlist?name=Xssd23SqQ&catid="+catid;
            SYS_TableServerside2(link,'#product_addtostock');
            $('#product_addtostock').show();

        }






        function product_addtostock(){
            var link=URL+"index.php/pullout_request/loadPullOutRequestFormSetlist";
        }



        function business_partner_search(){

            $('#dialog4').remove();
            $('body').append("<div id='dialog4'></div>"); /*Creates a virtual DOM <div id='dialog1'></div>*/
            SYS_dialog3('#dialog4','595','900px','Select a Business partner',function(){ });

            $.post(URL+"index.php/pullout_request/business_partner_options_tbl",{mode:'add',pid:""}).done(function(data){
                $("#dialog4").html(data).dialog("open");
            });  

        }


        function business_partner_options_setlist(){
           var link=URL+"index.php/pullout_request/business_partner_options_setlist";
           SYS_TableServerside2(link,'#bptbl');   
       }


       function business_partner_select(x){ 
       // hidden id's in business_partner_options_setlist
       var bpid=$('#tbl_bpid'+x).val();
       var bpname=$('#tbl_bpnames'+x).val();
       var bpgroup=$('#tbl_bpgroup'+x).val();


       $('#form_bpid').val(bpid);
       $("#form_bpname").val(bpname);
       $('#form_bpgroup').val(bpgroup);


// alert(bpid);

var link=URL+"index.php/pullout_request/loadPullOutRequestFormSetlist?name=Xssd23SqQ&bpid="+bpid;
SYS_TableServerside2(link,'#product_addtostock');
$("#dialog4").dialog("close");

}





function add_checkitemstoAddstock(){
// galing sa pullout_request_item_options_form_tbl_setlist
var cnt=parseInt($('#tblB_rows_cnt').val());
var row_cnt=parseInt($('#form_addstockcnt').val());


for(var x=0;x<cnt;x++){
    if($('#tbl_addstckchk'+x).is(' :checked')){

    // galing sa pullout_request_item_options_form_tbl_setlist
    var id=$('#tbl_b_id'+x).val();
    var pid=$('#tbl_b_pid'+x).val();
    var sku=$('#tbl_b_sku'+x).val();
    var product_name=$('#tbl_b_product_name'+x).val();
    var brand=$('#tbl_b_brand'+x).val();


    var description=$('#tbl_description'+x).val();
    var pullout_num=$("#tbl_pullout_num"+x).val(); 
                    // var pullout_qty=$('#tblC_qty'+x).val();

                    
                    var pullout_id=$('#tbl_pending_pullout_id'+x).val();
                    var api_id=$('#tbl_id'+x).val();
                    var pullout_qty=$('#tbl_pending_pullout_qty'+x).val();

                    var api_pullout_id=$('#tbl_pending_pid'+x).val();


                    // galing sa category setlist
                    var current_stock=$('#tbl_p_current_stock'+x).val();
                    var inv_id=$('#tbl_p_inv_id'+x).val();
                    var inv_sku=$('#tbl_p_inv_sku'+x).val();


                    if(checkIfProdExist(0,pid)==false){

                        $('#product_addtostock_toadd tbody').append(`
                            <tr id='tblC_row`+row_cnt+`'>
                            <td>
                            <input type='hidden' id='tblC_visibility`+row_cnt+`' value='1'/>
                            <input type='hidden' id='tblC_pid`+row_cnt+`' value='`+pid+`'/>
                            <input type='hidden' id='tblC_current_stock`+row_cnt+`' value='`+current_stock+`'/>
                            <input type='hidden' id='tblC_inv_id`+row_cnt+`' value='`+inv_id+`'/>
                            <input type='hidden' id='tblC_inv_sku`+row_cnt+`' value='`+inv_sku+`'/>
                            


                            `+sku+`
                            </td>
                            <td>`+product_name+`</td>
                            <td><input type='number' id='tblC_qty`+row_cnt+`' style='width:100%; border:none;' min='1' value='1' ><input type='hidden'  value='`+api_id+`'><input type='hidden'  value='`+api_pullout_id+`'><input type='hidden'  value='`+pullout_id+`'></td>

                            <td><button class='btn' style='width:100%; background:rgba(0,0,0,0);' onclick='addstock_remove(`+row_cnt+`)'><span class='glyphicon glyphicon-remove'></span></button></td>
                            </tr>
                            `);
                        toastr.success("Item/s added");
                        row_cnt+=1;

                    }

                }
            }
            $('#form_addstockcnt').val(row_cnt);
            getRowTotal();

        }

        function addstock_remove(x){

           $('#tblC_visibility'+x).val(0);   
           $('#tblC_row'+x).hide();
           setTimeout(function(){ getRowTotal(); },100);
           setTimeout(function(){

// details_form_save();

},1000);

       }



       function getRowTotal(){
           var row_cnt=parseInt($('#form_addstockcnt').val());
           var z=0;
           for(var x=0;x<row_cnt;x++){
            if($('#tblC_visibility'+x).val()==1){ z+=1; }
        }
        $('#addtock_items_qty').text(z);

    }


    function checkIfProdExist(x,pid){
        var cnt=parseInt($('#form_addstockcnt').val());
        if(x==cnt){ return false; }
        else{
            var pid1=$('#tblC_pid'+x).val();
            if($('#tblC_visibility'+x).val()==1){
                if(pid==pid1){ return true; }
                else{ return checkIfProdExist(x+1,pid); }
            }
            else{ return checkIfProdExist(x+1,pid); }


        }


    }



                    // Create pullout request => 'Items to pullout' save
                    function add_pullout_save(){
                        var cnt=parseInt($('#form_addstockcnt').val());
                        var brid=$('#filter_branchid').val();
                        var containerid=$('#filter_container').val();
                        // global var - this used in saved_by
                        var user_accountid=$('#user_person_accountid').val();
                        var api_pullout_id=[];
                        var pid=[];
                        var qty=[];
                        var current_stock=[];
                        var inv_id=[];
                        var inv_sku=[];
                        var z=0;
                        for(var x=0;x<cnt;x++){
                            if($('#tblC_visibility'+x).val()==1){
                                pid[z]=$('#tbl_b_pid'+x).val();
                                qty[z]=$('#tblC_qty'+x).val();
                                current_stock[z]=$('#tblC_current_stock'+x).val();
                                inv_id[z]=$('#tblC_inv_id'+x).val();
                                inv_sku[z]=$('#tblC_inv_sku'+x).val();
                                
                                z+=1;
                            }
                        } 

                        SYS_confirm("Do you wish Proceed?","Information will be saved to the database","warning","Yes","No",function(){
                            sweetAlertClose();  

                            

                            var description=$('#form_description').val();

                            var pullout_num=$('#form_pullout_num').val();

                            var pullout_id=$('#form_pullout_qty').val();
                        // var pullout_qty=$('#form_pullout_qty').val();
                        var pullout_qty=$('#tblC_qty').val();
                        var api_id=$('#form_api_id').val();
                // var current_stock=parseInt($('#tbl_p_current_stock'+x).val());
                var ppullout_id=$('#tbl_p_id').val();

                var pullout_items_pid=$('#form_pullout_items_pid').val();
// alert(inv_sku);



// pullout_qty - edit
// qty - add
if (qty[0]==0 || pullout_qty==0) {
    alert('Pullout qty should be greater than zero.');
}else if(qty[0]>=1000 || pullout_qty>=1000){
    alert('Pullout qty should be less than 1000.');
}
else {
    $.ajax({
      url:URL+"index.php/pullout_request/loadPullOutRequestItemsFormTblSave",
      method:"POST",
      data:{
          brid:brid,
          cnt:cnt,
          containerid:containerid,
          pid:pid,qty:qty,
          current_stock:current_stock,
          inv_id:inv_id,
          inv_sku:inv_sku,
          pullout_id:pullout_id,
          pullout_qty:pullout_qty,
          description:description,
          user_accountid:user_accountid,
          api_id:api_id,
          ppullout_id:ppullout_id,
          pullout_num:pullout_num,
          pullout_items_pid:pullout_items_pid
      },
      success:function(data){
    // n=JSON.parse(data);
    // alert(n);
    // debugger;
    // console.log(current_stock);
    console.log(data);
    SYS_pending_setlist();   
    setTimeout(function(){
        $("#dialog1").dialog("close");     
    },500);
},
error:function(err){
    console.log(err);
}



});

}


});

}  // end 


function loadPullOutRequestItemsFormTblSave(){

    var brid=$('#filter_branchid').val();
    var containerid=$('#filter_container').val();

    var status=$("#stat_filter").val();

    var link=URL+"index.php/pullout_request/loadPullOutRequestItemsFormTblSave?name=Xssd23SqQ&brid="+brid+"&containerid="+containerid+"&status="+status+"";
    SYS_TableServerside2(link,'#t_maintable'); 
    $('#t_maintable').css({'visibility':'visible'});

}






        //SYS_add_pullout_save

        function setCategoryOptions()
        {   

            $.post(URL+"index.php/pullout_request/loadCategoryAPI").done(function(data){


                var str="";
                var n=JSON.parse(data);

                for(var x=0;x<n.length ;x++){

                    str+="<option code='"+n[x].catnum+"' value='"+n[x].catid+"'>"+n[x].category+"</option>";
                }

                $('#form_category').html(str);
                $('#filter_category').html("<option value=''> All </option>"+str);
                $('#filter_category_n').html("<option value=''> All </option>"+str);
                $('#filter_category1').html("<option value=''> All </option>"+str);

                setTimeout(function(){ setSubcategoryOptions(); },500);

            });

        }
        
        function setSubcategoryOptions(){
            var catid=$('#form_category').val();
            $.post(URL+"index.php/pullout_request/loadCategorySubAPI",{catid:catid}).done(function(data){
             console.log(data);   
             var str="";
             var n=JSON.parse(data);

             for(var x=0;x<n.length ;x++){

                str+="<option code='"+n[x].catnum+"' value='"+n[x].catid+"'>"+n[x].category+"</option>";
            }
            $('#form_subcategory').html("<option value='0'>None</option>"+str);

        });
        }



             // View pending
             function view_pending(x){
                setcont(2);
                var str="";
                var date_requested=$("#tbl_pending_requested_date"+x).val(); 
                var pullout_num=$("#tbl_pullout_num"+x).val(); 
                var description=$("#tbl_description"+x).val(); 
                var bpname=$("#tbl_bpname"+x).val();
                var api_id=$("#tbl_id"+x).val();
                // hali sa pending setlist
                // var pullout_qty=$("#tbl_pending_pullout_qty"+x).val(); 
                $('#sa_api_id').val(api_id);
                $('#sa_wrr').val(pullout_num);
                $('#sa_bpname').val(bpname);
                $('#sa_desc').val(description);
                $('#sa_request_date').val(date_requested);
                // $('#sa_pending_pullout_qty').val(pullout_qty);

                var pid=$('#tbl_pending_pid'+x).val();
                var sku=$('#tbl_pending_sku'+x).val();
                var product_name=$('#tbl_pending_product_name'+x).val();
                    // var current_stock=$('#tbl_currentStock'+x).val();
                    var pullout_qty=$('#tbl_pending_pullout_qty'+x).val();
                    var status=$('#tbl_status'+x).val();

                    var stock=$('#tbl_p_stock'+x).val();

// alert(bpname);
                            // .append will insert a new row
                            $('#sa_cont tbody').html(`
                                <tr id='tblC_row'>
                                <td>
                                `+sku+`
                                </td>
                                <td>`+product_name+`</td>
                                <td>`+pullout_qty+`</td>
                                </tr>
                                `);
} // end view_pending


   // View approved
   function view_approved(x){
    setcont(3);
    var str="";
    var approved_date=$("#tbl_approved_date"+x).val(); 
    var pullout_num=$("#tbl_pullout_num"+x).val(); 
    var description=$("#tbl_description"+x).val(); 
    var bpname=$("#tbl_bpname"+x).val();
    var api_id=$("#tbl_id"+x).val();
                // hali sa pending setlist
                // var pullout_qty=$("#tbl_pending_pullout_qty"+x).val(); 
                $('#approved_api_id').val(api_id);
                $('#approved_po_num').val(pullout_num);
          // alert(pullout_num);
          $('#approved_bpname').val(bpname);
          $('#approved_desc').val(description);
          $('#approved_date').val(approved_date);
                // $('#sa_pending_pullout_qty').val(pullout_qty);

                var pid=$('#tbl_pid'+x).val();
                var sku=$('#tbl_sku'+x).val();
                var product_name=$('#tbl_product_name'+x).val();
                    // var current_stock=$('#tbl_currentStock'+x).val();
                    var pullout_qty=$('#tbl_pending_pullout_qty'+x).val();
                    var status=$('#tbl_status'+x).val();

// alert(bpname);
                            // .append will insert a new row
                            $('#sa_cont tbody').html(`
                                <tr id='tblC_row'>
                                <td>
                                `+sku+`
                                </td>
                                <td>`+product_name+`</td>
                                <td>`+pullout_qty+`</td>
                                </tr>
                                `);
                        } 


// View disapproved
function view_disapproved(x){
    setcont(4);
    var str="";
    var disapproved_date=$("#tbl_disapproved_date"+x).val(); 
    var pullout_num=$("#tbl_pullout_num"+x).val(); 
    var description=$("#tbl_description"+x).val(); 
    var bpname=$("#tbl_bpname"+x).val();
    var api_id=$("#tbl_id"+x).val();

    $('#disapproved_api_id').val(api_id);
    $('#disapproved_po_num').val(pullout_num);
          // alert(pullout_num);
          $('#disapproved_bpname').val(bpname);
          $('#disapproved_desc').val(description);
          $('#disapproved_date').val(disapproved_date);
                // $('#sa_pending_pullout_qty').val(pullout_qty);

                var pid=$('#tbl_pid'+x).val();
                var sku=$('#tbl_sku'+x).val();
                var product_name=$('#tbl_product_name'+x).val();
                    // var current_stock=$('#tbl_currentStock'+x).val();
                    var pullout_qty=$('#tbl_pending_pullout_qty'+x).val();
                    var status=$('#tbl_status'+x).val();


                            // .append will insert a new row
                            $('#sa_cont tbody').html(`
                                <tr id='tblC_row'>
                                <td>
                                `+sku+`
                                </td>
                                <td>`+product_name+`</td>
                                <td>`+pullout_qty+`</td>
                                </tr>
                                `);
} // end view_approval




function view_cancelled(x){
    setcont(4);
    var cancelled_date=$("#tbl_cancelled_date"+x).val(); 
    var po_num=$("#tbl_po_num"+x).val(); 
    var description=$("#tbl_description"+x).val(); 
    var bpname=$("#tbl_bpname"+x).val();

    $('#sa_c_wrr').val(po_num);
    $('#sa_c_bpname').val(bpname);
    $('#sa_c_desc').val(description);
    $('#sa_c_cancelled_date').val(cancelled_date);


    var cnt=parseInt($('#tblC_rows_cnt').val());
    var row_cnt=parseInt($('#form_addstockcnt').val());
    var pid=[];
    var str="";

    for(var x=0;x<cnt;x++){
        var pid=$('#tbl_pid'+x).val();
        var sku=$('#tbl_sku'+x).val();
        var product_name=$('#tbl_product_name'+x).val();
        var current_stock=$('#tbl_currentStock'+x).val();

        $('#sa_cancelled tbody').append(`
            <tr id='tblC_row`+row_cnt+`'>
            <td>
            <input type='hidden' id='tblC_visibility`+row_cnt+`' value='1'/>
            
            <input type='hidden' id='tblC_prev_qty`+row_cnt+`' value='`+current_stock+`'/>
            `+sku+`
            </td>
            <td>`+product_name+`</td>
            <td>`+current_stock+`</td>
            </tr>
            `);
        row_cnt+=1;
    }
    $('#form_addstockcnt').val(row_cnt);
    getRowTotal();

} // end view_cancelled



// -------------------------- Edit

function pullout_edit(x){

    var api_pullout_id=$('#tbl_pending_pid'+x).val();

    var spullout_id=$('#tbl_pending_pullout_id'+x).val();

// galing sa pullout_request_pending_setlist
var product_pid=$('#tbl_p_pid'+x).val();
var description=$('#tbl_description'+x).val();
// alert(description);
var qty=$('#tbl_pending_pullout_qty'+x).val();
var pid=$('#tbl_pending_pid'+x).val();
var date_requested=$('#tbl_pending_requested_date'+x).val();
var pullout_num=$("#tbl_pullout_num"+x).val();
// across_pullout_items id as 'api_id'
var api_id=$("#tbl_id"+x).val();
var bpname=$("#tbl_bpname"+x).val(); 

var pullout_num=$("#tbl_pullout_num"+x).val();

// var ppid=$('#tbl_pending_p_pid'+x).val();
var sku=$('#tbl_pending_sku'+x).val();
var product_name=$('#tbl_pending_product_name'+x).val(); 
var pullout_qty=$('#tbl_pending_pullout_qty'+x).val();
var ppullout_id=$('#tbl_pending_pullout_id'+x).val();
// alert(product_name);


$('#dialog1').remove();
$('body').append("<div id='dialog1'></div>"); 

SYS_dialog3('#dialog1','495','950px','Edit Pullout Request',function(){  });
$.post(URL+"index.php/pullout_request/loadPullOutRequestForm",{pullout_id:'edit'}).done(function(data){

    $("#dialog1").html(data).dialog("open");


 //galing sa pullout_request_details_form
 $('#form_bpname').val(bpname);
 $('#form_description').val(description);

 $('#form_mode').val("edit");

 $('#form_pullout_num').val(pullout_num);
 $('#form_api_id').val(api_id);
 $('#form_pullout_qty').val('edit');
 $('#form_p_pullout_id').val(spullout_id);
 $('#form_pending_pid').val(pid);
 $('#form_date_requested').val(date_requested);



 var cnt=parseInt($('#tblB_rows_cnt').val());
 var row_cnt=parseInt($('#form_addstockcnt').val());

var pullout_items_pid=$('#tbl_pending_api_pid'+x).val(); // pid of pullout_items
$('#form_pullout_items_pid').val(pullout_items_pid);

// galing sa category setlist
var current_stock=$('#tbl_p_current_stock'+x).val();
var inv_id=$('#tbl_p_inv_id'+x).val();
var inv_sku=$('#tbl_p_inv_sku'+x).val();



$('#product_addtostock_toadd tbody').append(`
    <tr id='tblC_row`+row_cnt+`'>
    <td>
    <input type='hidden' id='tblC_visibility`+row_cnt+`' value='1'/>
    <input type='hidden' id='tbl_pullout_items_pid`+row_cnt+`' value='`+pullout_items_pid+`'/>
    <input type='hidden' id='tblC_current_stock`+row_cnt+`' value='`+current_stock+`'/>
    <input type='hidden' id='tblC_inv_id`+row_cnt+`' value='`+inv_id+`'/>
    <input type='hidden' id='tblC_inv_sku`+row_cnt+`' value='`+inv_sku+`'/>

    `+sku+`
    </td>
    <td>`+product_name+`</td>
    <td><input type='number' id='tblC_qty' style='width:100%; border:none;' min='1' value='`+pullout_qty+`' ><input type='hidden' id='tbl_p_id' style='width:100%; border:none;' min='1' value='`+ppullout_id+`' ></td>


    <td><button class='btn' style='width:100%; background:rgba(0,0,0,0);' onclick='addstock_remove(`+row_cnt+`)'><span class='glyphicon glyphicon-remove'></span></button></td>
    </tr>
    `);
row_cnt+=1;

$('#form_addstockcnt').val(row_cnt);
getRowTotal();


});  

}








// --------------------------  Delete

function pullout_delete(x){

    var pullout_id=$('#tbl_pending_pullout_id'+x).val();
    SYS_confirm("Do you wish Proceed?","Information will be deleted from the database","warning","Yes","No",function(){
        sweetAlertClose();  

        $.post(URL+"index.php/pullout_request/loadPullOutRequestDelete",{pullout_id:pullout_id}).done(function(data){
            n=JSON.parse(data);
            // console.log(pullout_id);
            if(n.msg==""){
                swal("Done","Information was deleted","success");  
                SYS_pending_setlist();
            }
            else{ swal("Error",n.msg,"warning");  }
        });

    }); 



}
















</script>
