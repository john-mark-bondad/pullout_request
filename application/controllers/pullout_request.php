<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");



class Pullout_request extends  CI_Controller {

	public function loadMain(){
		$this->load->view("a_pages/pullout_request/pullout_request_main");	
	}


	public function loadPullOutRequestForm(){
		$this->load->view("a_pages/pullout_request/pullout_request_form");	
	}


// 'Details' Dialog
	public function loadPullOutRequestDetailsForm(){
		$this->load->view("a_pages/pullout_request/pullout_request_details_form");	
	}
// 'Details' Dialog => Add selected items Button
	public function loadPullOutRequestDetailsFormSave(){
		$this->load->view("a_pages/pullout_request/pullout_request_details_form_save");	
	}

// 'Items Options' Dialog
	public function loadPullOutRequestItemOptionsFormTbl(){
		$this->load->view("a_pages/pullout_request/pullout_request_item_options_form_tbl");	
	}
// 'Items Options' Dialog => Add selected items Button
	public function loadPullOutRequestFormSetlist(){
		$this->load->view("a_pages/pullout_request/pullout_request_item_options_form_tbl_setlist");	
	}


// 'Items to pullout' Dialog 
	public function loadPullOutRequestItemsFormTbl(){
		$this->load->view("a_pages/pullout_request/pullout_request_items_to_pullout_tbl");	
	}
	// 'Items to pullout' Dialog  => Process Request Button
	public function loadPullOutRequestItemsFormTblSave(){
		$this->load->view("a_pages/pullout_request/pullout_request_items_to_pullout_tbl_save");	
	}

// Business Partner
	public function business_partner_options_tbl(){
		$this->load->view("a_pages/pullout_request/business_partner_options_tbl");
	}

	public function business_partner_options_setlist(){
		$this->load->view("a_pages/pullout_request/business_partner_options_setlist");	
	}

	// Status : pending
	public function loadPullOutRequestPendingTbl(){
		$this->load->view("a_pages/pullout_request/pullout_request_pending_tbl");	
	}
	public function loadPullOutRequestPendingSetlist(){
		$this->load->view("a_pages/pullout_request/pullout_request_pending_setlist");	
	}
	public function loadPullOutRequestPendingView(){
		$this->load->view("a_pages/pullout_request/pullout_request_pending_view");	
	}

// Status : approved
	public function loadPullOutRequestApprovedSetlist(){
$this->load->view("a_pages/pullout_request/pullout_request_approved_setlist");	
	}
	public function loadPullOutRequestApprovedView(){
		$this->load->view("a_pages/pullout_request/pullout_request_approved_view");	
	}
	public function loadPullOutRequestApprovedTbl(){
		$this->load->view("a_pages/pullout_request/pullout_request_approved_tbl");	
	}
	public function loadPullOutRequestApprovedProcessSave(){
$this->load->view("a_pages/pullout_request/pullout_request_approve_process_save");	
	}


// Status :disapproved
	public function loadPullOutRequestDisapprovedSetlist(){
		$this->load->view("a_pages/pullout_request/pullout_request_disapproved_setlist");	
	}
	public function loadPullOutRequestDisapprovedView(){
		$this->load->view("a_pages/pullout_request/pullout_request_disapproved_view");	
	}

// Status : cancelled
	public function loadPullOutRequestCancelledSetlist(){
		$this->load->view("a_pages/pullout_request/pullout_request_cancelled_setlist");	
	}
	public function loadPullOutRequestCancelledView(){
		$this->load->view("a_pages/pullout_request/pullout_request_cancelled_view");	
	}


	// For Filtering the Category
	public function loadCategorySetlist(){
$this->load->view("a_pages/pullout_request/pullout_request_category_setlist");	
	}
	public function loadCategoryAPI(){
		$this->load->view("a_pages/pullout_request/pullout_request_category_api");	
	}
	public function loadCategorySubAPI(){
$this->load->view("a_pages/pullout_request/pullout_request_category_sub_api");	
	}



	public function loadPullOutRequestDelete(){
		$this->load->view("a_pages/pullout_request/pullout_request_delete");	
	}


	public function loadEditSave(){
		$this->load->view("a_pages/pullout_request/pullout_request_update_save");	
	}






}

