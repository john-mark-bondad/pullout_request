<?php $this->load->view("a_pages/pullout_request/a_js"); $this->load->view("a_pages/pullout_request/a_css");  ?>


<div id="t_content">

<div class='setcont' id='setcont1'><?php $this->load->view("a_pages/pullout_request/pullout_request_pending_tbl"); ?></div>
<div class='setcont' id="setcont2"><?php $this->load->view("a_pages/pullout_request/pullout_request_pending_view"); ?></div>
<div class='setcont' id="setcont3"><?php $this->load->view("a_pages/pullout_request/pullout_request_approved_view"); ?></div>
<div class='setcont' id="setcont4"><?php $this->load->view("a_pages/pullout_request/pullout_request_disapproved_view"); ?></div>
<div class='setcont' id="setcont5"><?php $this->load->view("a_pages/pullout_request/pullout_request_cancelled_view"); ?></div>

</div>

<script type="text/javascript">
$(document).ready(function(){

setcont(1);
});

function setcont(n){
    $('.setcont').hide();
    $('#setcont'+n).show();
}

</script>

