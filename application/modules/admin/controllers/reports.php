<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {
	

	function __construct()
	{	
		parent::__construct();
		
		if(!$this->authorization->is_permitted('reports')){
           redirect('');
        }
	}




	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{	
		$this->load->model('appointments_model','appointments_m');
		$dt = json_encode(array(
				'pending_appointments'    => $this->appointments_m->count_by(array('appointment_status' => 'pending')),
				'inprogress_appointments' => $this->appointments_m->count_by(array('appointment_status' => 'inprogress')),
				'generated_appointments'  => $this->appointments_m->count_by(array('appointment_status' => 'generated')),
				'cancelled_appointments'  => $this->appointments_m->count_by(array('appointment_status' => 'cancelled')),
			  ));
		$ft = json_encode(array(
				'received_amount' => $this->appointments_m->getTotalReceivedAmount(),
				'pending_amount' =>  $this->appointments_m->getTotalPendingAmount()
			  ));
		$this->data['appScript'] = "window.appointmentsData = '{$dt}'; window.financeData = '{$ft}'; ADMIN.reports.init(); ";
		$this->template->add_cdn_js("https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js");
		$this->template->add_thirdparty_css("morris/morris.css");
		$this->template->add_thirdparty_js("morris/morris.min.js");
		$this->template->load_view('reports/reports', $this->data);
	}
	
}
/* End of file reports.php */
/* Location: ./application/controllers/reports.php */