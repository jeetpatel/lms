<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Appointments extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
        if (!$this->authentication->is_signed_in()){
            redirect(SIGNIN);
        }
        if(!$this->authorization->is_permitted('manage_appointments')){
           redirect('');
        }
        
        $this->load->model('appointments_model');
        $this->load->library('form_validation');
        $this->load->helper('tests');
        $this->load->helper('doctor');
    }
    /**
     * [index will load list of all appointments]
     * @return [type] [description]
     */
    public function index()
    {   
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $segment = $this->uri->segment(3);         
        if(!empty($segment) && ctype_digit($segment)){
            $start = $this->uri->segment(3);
        }
        
        if ($q <> '') {
            $config['base_url'] = base_url('admin/appointments');
            $config['first_url'] = base_url('admin/appointments');
        } else {
            $config['base_url'] = base_url('admin/appointments');
            $config['first_url'] = base_url('admin/appointments');
        }
        $config['per_page'] = RECORDSPERPAGE;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->appointments_model->total_rows($q);
        $appointments = $this->appointments_model->get_limit_data($config['per_page'], $start, $q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'appointments_data' => $appointments,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'appScript' => "ADMIN.uploadReportsForm.init(); ADMIN.sendMail.init();"
        );
        $this->template->load_view('appointments/appointments_list', array_merge($this->data,$data));
    }
    /**
     * [read method will give informations about the appointment]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function read($id){
        $this->load->library('response');
        $this->response->dialog(array(
            'title' => 'Appointment Info',
            'body' => Modules::run('admin/appointments/readAppointment',$id)
        ));
        $this->response->send();
    }
    
    /**
     * [readAppointment method will load appointment read view]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function readAppointment($id) 
    {   
        $this->load->helper('auth/account');
        $row = $this->appointments_model->get_by_id($id);
        
        $data = array(
            'user_id' => $row->user_id,
            'reference_no' => $row->reference_no,
            'name' => $row->name,
            'age' => $row->age,
            'sex' => $row->sex,
            'phone' => $row->phone,
            'email_id' => $row->email_id,
            'test' => $row->test,
            'test_price' => $row->test_price,
            'discount' => $row->discount,
            'total_price' => $row->total_price,
            'sample_collection_time' => $row->sample_collection_time,
            'appointment_date' => $row->appointment_date,
            'doctor_ref_by' => $row->doctor_ref_by,
            'doctor_id' => $row->doctor_id,
            'appointment_status' => $row->appointment_status,
            'report_doc' => $row->report_doc,
        );
        
        $this->load->view('appointments/appointments_read', $data);
        
    }
    /**
     * [create method is used to book or create new appointment]
     * @return [type] [description]
     */
    public function create() 
    {   
        $this->load->model('tests_model', 'tests_m');
        $this->load->model('doctors_model', 'doctors_m');
        $data = array(
            'button'        => 'Create',
            'action'        => site_url('admin/appointments/createAction'),
            'attributes'    => array('name' => 'appointment_form', 'id' => 'appointment_form'),
            'id'            => set_value('id'),
            'user_id'       => set_value('user_id'),
            'reference_no'  => set_value('reference_no'),
            'name'          => set_value('name'),
            'age'           => set_value('age'),
            'sex'           => set_value('sex'),
            'phone'         => set_value('phone'),
            'email_id'      => set_value('email_id'),
            'test'          => set_value('test'),
            'test_price'    => set_value('test_price'),
            'discount'      => set_value('discount'),
            'total_price'   => set_value('total_price'),
            'sample_collection_time' => set_value('sample_collection_time'),
            'appointment_date' => set_value('appointment_date'),
            'doctor_ref_by'  => set_value('doctor_ref_by'),
            'appointment_status' => set_value('appointment_status'),
            'report_doc'     => set_value('report_doc'),
            'payment_status' => set_value('payment_status'),
            'test_options'   => $this->tests_m->getTestOptions(),
            'doctor_options' => $this->doctors_m->getDoctorOptions(),
            'appScript'      => "ADMIN.createAppointment.init()"
    );
        $this->template->add_cdn_css("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/themes/redmond/jquery-ui.css");
        $this->template->add_thirdparty_css('jQuery.ptTimeSelect/src/jquery.ptTimeSelect.css');
        $this->template->add_thirdparty_js('jQuery.ptTimeSelect/src/jquery.ptTimeSelect.js');
        $this->template->load_view('appointments/appointments_form', array_merge($this->data,$data));
    }
    
    /**
     * [createAction is used to save the new appointment informations]
     * @return [type] [description]
     */
    public function createAction() 
    {
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // dump_exit($this->input->post());
            $data = array(
        'user_id' => $this->session->userdata('account_id'),
        'reference_no' => uniqid(),
        'name' => $this->input->post('name',TRUE),
        'age' => $this->input->post('age',TRUE),
        'sex' => $this->input->post('sex',TRUE),
        'phone' => $this->input->post('phone',TRUE),
        'email_id' => $this->input->post('email_id',TRUE),
        'test' => $this->input->post('test',TRUE),
        'test_price' => $this->input->post('test_price',TRUE),
        'discount' => $this->input->post('discount',TRUE),
        'total_price' => $this->input->post('total_price',TRUE),
        'sample_collection_time' => $this->input->post('sample_collection_time',TRUE),
        'appointment_date' => date('Y-m-d'),
        'doctor_id' => $this->input->post('doctor_ref_by',TRUE),
        'appointment_status' => $this->input->post('appointment_status',TRUE),
        'report_doc' => '',
        'payment_status' => $this->input->post('payment_status',TRUE),
        );            
            $this->appointments_model->insert_appointment($data);
            $this->session->set_flashdata('message', 'Appointment Saved Successfully.');
            redirect(site_url('admin/appointments'));
        }
    }
    
    /**
     * [update method is used to load appointment update view]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update($id) 
    {
        $row = $this->appointments_model->get_by_id($id);
        $this->load->model('tests_model', 'tests_m');
        $this->load->model('doctors_model', 'doctors_m');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/appointments/updateAction'),
                'attributes'    => array('name' => 'appointment_form', 'id' => 'appointment_form'),
        'id' => set_value('id', $row->id),
        'user_id' => set_value('user_id', $row->user_id),
        'reference_no' => set_value('reference_no', $row->reference_no),
        'name' => set_value('name', $row->name),
        'age' => set_value('age', $row->age),
        'sex' => set_value('sex', $row->sex),
        'phone' => set_value('phone', $row->phone),
        'email_id' => set_value('email_id', $row->email_id),
        'test' => set_value('test', $row->test),
        'test_price' => set_value('test_price', $row->test_price),
        'discount' => set_value('discount', $row->discount),
        'total_price' => set_value('total_price', $row->total_price),
        'sample_collection_time' => set_value('sample_collection_time', $row->sample_collection_time),
        'appointment_date' => set_value('appointment_date', $row->appointment_date),
        'doctor_ref_by' => set_value('doctor_ref_by', $row->doctor_ref_by),
        'appointment_status' => set_value('appointment_status', $row->appointment_status),
        'report_doc' => set_value('report_doc', $row->report_doc),
        'payment_status' => set_value('payment_status', $row->payment_status),
        'test_options'   => $this->tests_m->getTestOptions(),
        'doctor_options' => $this->doctors_m->getDoctorOptions(),
        'appScript'      => "ADMIN.createAppointment.init()"
        );  
            $this->template->add_cdn_css("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/themes/redmond/jquery-ui.css");
            $this->template->add_thirdparty_css('jQuery.ptTimeSelect/src/jquery.ptTimeSelect.css');
            $this->template->add_thirdparty_js('jQuery.ptTimeSelect/src/jquery.ptTimeSelect.js');
            $this->template->load_view('appointments/appointments_form', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/appointments'));
        }
    }
    
    /**
     * [updateAction method will update the appointment informations]
     * @return [type] [description]
     */
    public function updateAction() 
    {
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
            'name' => $this->input->post('name',TRUE),
            'age' => $this->input->post('age',TRUE),
            'sex' => $this->input->post('sex',TRUE),
            'phone' => $this->input->post('phone',TRUE),
            'email_id' => $this->input->post('email_id',TRUE),
            'test' => $this->input->post('test',TRUE),
            'test_price' => $this->input->post('test_price',TRUE),
            'discount' => $this->input->post('discount',TRUE),
            'total_price' => $this->input->post('total_price',TRUE),
            'sample_collection_time' => $this->input->post('sample_collection_time',TRUE),
            'doctor_ref_by' => $this->input->post('doctor_ref_by',TRUE),
            'appointment_status' => $this->input->post('appointment_status',TRUE),
            'payment_status' => $this->input->post('payment_status',TRUE),
            );
            $this->appointments_model->update_appointment($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Appointment Updated Successfully.');
            redirect(site_url('admin/appointments'));
        }
    }
    
    /**
     * [rules method is used to set server side validations for appointment form]
     * @return [type] [description]
     */
    public function rules() 
    {
    $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('age', 'age', 'trim|required|integer');
    $this->form_validation->set_rules('sex', 'sex', 'trim|required');
    $this->form_validation->set_rules('phone', 'phone', 'trim|required|max_length[20]');
    $this->form_validation->set_rules('email_id', 'email id', 'trim|valid_email');
    $this->form_validation->set_rules('test', 'test', 'trim|required|integer');
    $this->form_validation->set_rules('test_price', 'test price', 'trim|required|numeric');
    $this->form_validation->set_rules('discount', 'discount', 'trim|integer');
    $this->form_validation->set_rules('total_price', 'total price', 'trim|required|numeric');
    $this->form_validation->set_rules('sample_collection_time', 'sample collection time', 'trim|required|max_length[45]');
    $this->form_validation->set_rules('doctor_ref_by', 'doctor ref by', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('appointment_status', 'appointment status', 'trim|required');
    $this->form_validation->set_rules('payment_status', 'Pay Status', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }
    /**
     * [excel method is used to get excel download for all the appointments]
     * @return [type] [description]
     */
   public function excel()
    {   
        $this->load->helper('exportexcel');
        $namaFile = "appointments.xls";
        $judul = "appointments";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");
        xlsBOF();
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "User Id");
    xlsWriteLabel($tablehead, $kolomhead++, "Reference No");
    xlsWriteLabel($tablehead, $kolomhead++, "Name");
    xlsWriteLabel($tablehead, $kolomhead++, "Age");
    xlsWriteLabel($tablehead, $kolomhead++, "Sex");
    xlsWriteLabel($tablehead, $kolomhead++, "Phone");
    xlsWriteLabel($tablehead, $kolomhead++, "Email Id");
    xlsWriteLabel($tablehead, $kolomhead++, "Test");
    xlsWriteLabel($tablehead, $kolomhead++, "Test Price");
    xlsWriteLabel($tablehead, $kolomhead++, "Discount");
    xlsWriteLabel($tablehead, $kolomhead++, "Total Price");
    xlsWriteLabel($tablehead, $kolomhead++, "Sample Collection Time");
    xlsWriteLabel($tablehead, $kolomhead++, "Appointment Date");
    xlsWriteLabel($tablehead, $kolomhead++, "Doctor Ref By");
    xlsWriteLabel($tablehead, $kolomhead++, "Appointment Status");
    xlsWriteLabel($tablehead, $kolomhead++, "Report Doc");
    xlsWriteLabel($tablehead, $kolomhead++, "Payment Status");
    foreach ($this->appointments_model->get_all_appointments() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
        xlsWriteLabel($tablebody, $kolombody++, $data->reference_no);
        xlsWriteLabel($tablebody, $kolombody++, $data->name);
        xlsWriteNumber($tablebody, $kolombody++, $data->age);
        xlsWriteLabel($tablebody, $kolombody++, $data->sex);
        xlsWriteLabel($tablebody, $kolombody++, $data->phone);
        xlsWriteLabel($tablebody, $kolombody++, $data->email_id);
        xlsWriteNumber($tablebody, $kolombody++, $data->test);
        xlsWriteNumber($tablebody, $kolombody++, $data->test_price);
        xlsWriteNumber($tablebody, $kolombody++, $data->discount);
        xlsWriteNumber($tablebody, $kolombody++, $data->total_price);
        xlsWriteLabel($tablebody, $kolombody++, $data->sample_collection_time);
        xlsWriteLabel($tablebody, $kolombody++, $data->appointment_date);
        xlsWriteLabel($tablebody, $kolombody++, $data->doctor_ref_by);
        xlsWriteLabel($tablebody, $kolombody++, $data->appointment_status);
        xlsWriteLabel($tablebody, $kolombody++, $data->report_doc);
        xlsWriteLabel($tablebody, $kolombody++, $data->payment_status);
        $tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }
    /**
     * [todayAppointments method will give current day appointments]
     * @param  integer $start [description]
     * @return [type]         [description]
     */
    public function todayAppointments($start = 0)
    {   
        $config['base_url']    = base_url('admin/appointments/todayAppointments');
        $config['first_url']   = base_url('admin/appointments/todayAppointments');
        $config['per_page']    = RECORDSPERPAGE;
        $config['uri_segment'] = 4;
        $config['total_rows']  = $this->appointments_model->todayAppointmentsCount();
        $appointments          = $this->appointments_model->order_by('id','DESC')->todayAppointments($config['per_page'], $start);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'appointments_data' => $appointments,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'day_details' => $this->appointments_model->getDayDetails(date('Y-m-d')),
            'appScript' => "ADMIN.uploadReportsForm.init(); ADMIN.sendMail.init();"
        );
        $this->template->load_view('appointments/appointments_today_list', array_merge($this->data,$data));
    }
    /**
     * [getAppointmentsByDate method will give appointments based on dates]
     * @return [type] [description]
     */
    public function getAppointmentsByDate()
    {      
        $default_date = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        if($this->input->get() || $this->input->post()){
            $dates = array('from_date' => $this->input->get_post('from_date'), 
                           'to_date'   => $this->input->get_post('to_date'));
        }else{
            $dates = array('from_date' => $default_date, 'to_date' => $default_date);
        }
        $config['page_query_string'] = TRUE;
        $config['base_url']    = base_url('admin/appointments/getAppointmentsByDate/?').http_build_query($dates);
        $config['per_page']    = RECORDSPERPAGE;
        $config['uri_segment'] = 4;
        if($this->input->get('per_page') && is_numeric($this->input->get('per_page'))){
                $start = $this->input->get('per_page');
        }else{
            $start = 0;
        }
        $config['total_rows']  = $this->appointments_model->getAppointmentsCountByDate($dates['from_date'], $dates['to_date']);
        $appointments = $this->appointments_model->getAppointmentsByDate($dates['from_date'], $dates['to_date'], $config['per_page'], $start);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'appointments_data' => $appointments,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'date'       => date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))),
            'appScript'  => 'ADMIN.getAppointmentsByDate.init(); ADMIN.uploadReportsForm.init(); ADMIN.sendMail.init();',
            'dates'      => $dates,
            'day_details'     => $this->appointments_model->getDetailsByDates($dates['from_date'], $dates['to_date'])
        );
        
        $this->template->add_thirdparty_css('bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css');
        $this->template->add_thirdparty_js('bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js');
        $this->template->load_view('appointments/day_report', array_merge($this->data,$data));
    }
    /**
     * [uploadReportsForm method wil load view to upload reports]
     * @return [type] [description]
     */
    public function uploadReportsForm(){
        if($this->input->is_ajax_request()){
            $this->load->library('response');
            $this->response->dialog(array(
                'title' => 'Upload Reports',
                'body' => Modules::run('admin/appointments/pageletUploadReportsForm',array('ref_no' => $this->input->post('refno')))
            ));
$script = <<< SUBMITREPORT
        ADMIN.uploadReports.init();
SUBMITREPORT;
            
            $this->response->script($script);
            $this->response->send();
        }
    }
    /**
     * [pagelet_uploadReportsForm will load upload reports view]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    function pageletUploadReportsForm($params = array()){
        
        $this->load->model('emailsettings_model','emailsettings_m');
        $default_params = array(
                                    'action' => 'admin/appointments/uploadReports',
                                    'attributes' => array('name' => 'uploadreports_form', 'id' => 'uploadreports_form'),
                                    'ref_no' => '',
                                    'details' => $this->appointments_model->get_by(array('reference_no' => $params['ref_no']))
                               );
        $params = array_merge($default_params,$params);
        $this->load->view('appointments/sendreport_form', $params);
    }
    /**
     * [uploadReports method will upload reports for appointments]
     * @return [type] [description]
     */
    public function uploadReports(){
        if($this->input->is_ajax_request()){
            
            $result = array('status' => 'FAIL', 'mes' => '', 'send_mail_mes' => '', 'has_mail_id' => 'no', 'ref_no' => '');
            $app_details = $this->appointments_model->get_by(array('reference_no' => $this->input->post('ref_no')));
            $path = "./assets/reports/".$this->input->post('ref_no').'/';
            if(!empty($app_details->email_id)){
                $result['has_mail_id'] = "yes";
            }
            if($this->input->post('ref_no')){
                $result['ref_no'] = $this->input->post('ref_no');
            }
            //check wether the appointment exists or not with the reference no
            if(empty($app_details)){
                $result['mes'] = '<div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Info!</strong> Appointment Not Available.
                </div>';
                echo json_encode($result); return;
            }
            //check wether the uploaded reports are valid reports if not return with message
            $count = count($_FILES['report']['size']);
            foreach($_FILES as $key=>$value)
            for($s=0; $s<=$count-1; $s++) {
                if($value['type'][$s] != "application/pdf"){
                    $result['mes'] = '<div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Info!</strong> Filetype not Allowed.
                    </div>';
                    echo json_encode($result); return;
                }
            }
            //step 1 : unlink all previous appointments if any and update appointment
            if(!empty($app_details->report_doc)){
                
                $uploaded_reports = explode(',', $app_details->report_doc);
                if(count($uploaded_reports) > 0){
                    foreach ($uploaded_reports as $key => $value) {
                        if(file_exists($path.$value)){
                            unlink($path.$value);    
                        }
                    }
                }
                $where['reference_no'] = $this->input->post('ref_no');
                $update_date['report_doc'] =  "";
                $this->appointments_model->update_by($where,$update_date);    
            }
            // end
            //step 2 : uploading files
            $this->load->library('upload');
            if(!file_exists($path)) 
                mkdir($path);
            $reports_array = array();
            $reports_path_array = array();
            $count = count($_FILES['report']['size']);
            foreach($_FILES as $key=>$value)
            for($s=0; $s<=$count-1; $s++) {
                $_FILES['report']['name']     = $value['name'][$s];
                $_FILES['report']['type']     = $value['type'][$s];
                $_FILES['report']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['report']['error']    = $value['error'][$s];
                $_FILES['report']['size']     = $value['size'][$s];  
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'pdf';
                $this->upload->initialize($config);
                $this->upload->do_upload('report');
                $data = $this->upload->data();
                $reports_array[] = $data['file_name'];
                $reports_path_array[] = $path.$data['file_name'];
            }
            
            $reports = implode(',', $reports_array);
            if(!empty($reports)){
                $result['status'] = "SUCCESS";
                $result['mes'] = '<div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Success!</strong> Reports upload success.
                </div>';
            }
            // end
            
            //step 3 : update appointment information
            $where['reference_no'] = $this->input->post('ref_no');
            $update_date['appointment_status'] = "generated";
            $update_date['report_doc'] =  $reports;
            $this->appointments_model->update_by($where, $update_date);
            // end
            //step 4: send mail if mail id exists
            if($this->input->post('send_mail')){
                $result['send_mail_mes'] = $this->sendReportMail($reports_path_array, $app_details);
            }
            //end
            
             
            echo json_encode($result); return;
        }
    }
    /**
     * [sendReportMail method will send reports to mail address]
     * @param  [type] $reports [description]
     * @param  [type] $details [description]
     * @return [type]          [description]
     */
    public function sendReportMail($reports, $details){
         
            $this->load->library('email');
            $this->load->model('emailsettings_model','emailsettings_m');
            $settings = $this->emailsettings_m->get_first_row();
            $config['protocol']         = $settings->protocol;
            $config['mailpath']         = $settings->path_to_send_mail;
            $config['smtp_host']        = $settings->smtp_host;
            $config['smtp_user']        = $settings->smtp_user;
            $config['smtp_pass']        = $settings->smtp_password;
            $config['smtp_port']        = $settings->smtp_port;
            
            $this->email->initialize($config);
            $this->email->from($config['smtp_user'], $this->config->item('site_name'))
                        ->reply_to($config['smtp_user'])
                        ->to($details->email_id)
                        ->subject(getTestName($details->test)." Report")
                        ->message("Your reports has been generated, please check the attachements");
            
            if(count($reports) > 0){
                foreach ($reports as $key => $value) {
                    $this->email->attach($value);
                }
            }
            if ($this->email->send()){
                return '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Success!</strong> Mail Sent.
                </div>';                    
            }else{
                return '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Info!</strong> Unable to send mail.
                </div>';
            }
    }
    /**
     * [sendMail method will resend reports to mail when ever needed]
     * @return [type] [description]
     */
    public function sendMail(){
        if($this->input->is_ajax_request()){
            $result = array('mail_status_mes' => '');
            if($this->input->post('ref_no')){
                $this->load->helper('file');
                $path = "./assets/reports/".$this->input->post('ref_no').'/';    
                $files = get_filenames($path);
                $path_array = array();
                if(count($files) > 0){
                    foreach ($files as $key => $value) {
                        $path_array[] = $path.$value;
                    }
                }
                $app_details = $this->appointments_model->get_by(array('reference_no' => $this->input->post('ref_no')));
                $result['mail_status_mes'] = $this->sendReportMail($path_array, $app_details);
            }
            
            echo json_encode($result); return;   
        }
    } 
   public function generate ($id)
   {
       $data['generateValue']= $this->appointments_model->generate_get_by_id($id);
       $this->load->view('appointments/appointment_print', $data);
   }
}
/* End of file Appointments.php */
/* Location: ./application/controllers/Appointments.php */