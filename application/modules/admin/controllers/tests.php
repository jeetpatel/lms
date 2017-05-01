<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Tests extends MY_Controller
{
    

    function __construct()
    {
        parent::__construct();
        if (!$this->authentication->is_signed_in()){
            redirect(SIGNIN);
        }
        if(!$this->authorization->is_permitted('manage_tests')){
            redirect('');
        }
        $this->load->model('tests_model');
        $this->load->library('form_validation');
    }




    /**
     * [index description]
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
            $config['base_url'] = base_url() . 'admin/tests/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/tests/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/tests';
            $config['first_url'] = base_url() . 'admin/tests';
        }
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->tests_model->total_rows($q);
        $tests = $this->tests_model->get_limit_data($config['per_page'], $start, $q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'tests_data' => $tests,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        
        $this->template->load_view('tests/tests_list', array_merge($this->data,$data));
    }




    /**
     * [read description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function read($id) 
    {
        $row = $this->tests_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'test_name' => $row->test_name,
        'test_description' => $row->test_description,
        'test_price' => $row->test_price,
        'status' => $row->status,
        );
            $this->template->load_view('tests/tests_read', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/tests'));
        }
    }




    /**
     * [create description]
     * @return [type] [description]
     */
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/tests/createAction'),
            'attributes' => array('name' => 'test_form', 'id' => 'test_form'),
        'id' => set_value('id'),
        'test_name' => set_value('test_name'),
        'test_description' => set_value('test_description'),
        'test_price' => set_value('test_price'),
        'status' => set_value('status'),
        'appScript' => 'ADMIN.createTest.init();',
    );
        $this->template->load_view('tests/tests_form', array_merge($this->data,$data));
    }
    



    /**
     * [createAction description]
     * @return [type] [description]
     */
    public function createAction() 
    {
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'test_name' => $this->input->post('test_name',TRUE),
        'test_description' => $this->input->post('test_description',TRUE),
        'test_price' => $this->input->post('test_price',TRUE),
        'status' => $this->input->post('status',TRUE),
        );
            $this->tests_model->insert_test($data);
            $this->session->set_flashdata('message', 'Test Added Successfully.');
            redirect(site_url('admin/tests'));
        }
    }
    



    /**
     * [update description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update($id) 
    {
        $row = $this->tests_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/tests/updateAction'),
                'attributes' => array('name' => 'test_form', 'id' => 'test_form'),
                'id' => set_value('id', $row->id),
                'test_name' => set_value('test_name', $row->test_name),
                'test_description' => set_value('test_description', $row->test_description),
                'test_price' => set_value('test_price', $row->test_price),
                'status' => set_value('status', $row->status),
        );
            $this->template->load_view('tests/tests_form', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Test Not Found');
            redirect(site_url('admin/tests'));
        }
    }
    



    /**
     * [updateAction description]
     * @return [type] [description]
     */
    public function updateAction() 
    {
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
        'test_name' => $this->input->post('test_name',TRUE),
        'test_description' => $this->input->post('test_description',TRUE),
        'test_price' => $this->input->post('test_price',TRUE),
        'status' => $this->input->post('status',TRUE),
        );
            $this->tests_model->update_test($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Test Updated Successfully.');
            redirect(site_url('admin/tests'));
        }
    }
    



    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) 
    {
        $row = $this->tests_model->get_by_id($id);
        if ($row) {
            $this->tests_model->delete_test($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/tests'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/tests'));
        }
    }



    /**
     * [rules description]
     * @return [type] [description]
     */
    public function rules() 
    {
    $this->form_validation->set_rules('test_name', 'test name', 'trim|required|max_length[250]');
    $this->form_validation->set_rules('test_description', 'test description', 'trim|required');
    $this->form_validation->set_rules('test_price', 'test price', 'trim|required|numeric');
    $this->form_validation->set_rules('status', 'status', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }
    



    /**
     * [getTestPrice description]
     * @return [type] [description]
     */
    public function getTestPrice()
    {
        if($this->input->is_ajax_request()){
            $result = array('status' => 'FAIL', 'mes' => '', 'test_price' => 0.00, 'final_price' => 0.00);
            if($this->input->post('test_id')){
                $this->load->model('tests_model', 'tests_m');
                $where['id'] = $this->input->post('test_id');
                $details = $this->tests_m->get_by($where);
                if(!empty($details)){
                    $result['status'] = 'SUCCESS';
                    $result['test_price'] = $details->test_price;
                    $result['final_price'] = $details->test_price;
                }
            }
            echo json_encode($result); return;
        }
    }




    /**
     * [checkTestExists description]
     * @return [type] [description]
     */
    public function checkTestExists(){
        if($this->input->is_ajax_request()){
            $result = array('call_status' => 'FAIL', 'mes' => '');
            
            if($this->input->post('test_name')){
                $c = $this->tests_model->count_by(array('test_name' => $this->input->post('test_name')));
                if($c == 0){
                    $result['call_status'] = "SUCCESS";
                }else{
                    $result['mes'] = "Test with given name already exists";
                }
            }

            echo json_encode($result); return;   
        }
    }
    
}
/* End of file Tests.php */
/* Location: ./application/controllers/Tests.php */