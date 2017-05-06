<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Subtest extends MY_Controller
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
        $this->load->helper('subtest');
        $this->load->model('subtest_model');
        $this->load->library('form_validation');
    }




    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
      die("index");
    }
    
    public function getSubTest() {
      echo '<option value="" disabled="true">SELECT SUBTEST</option>';
      if($this->input->is_ajax_request()){            
            if($this->input->post('test_id')){
                $this->load->model('subtest_model', 'subtest_m');
                $test_id = $this->input->post('test_id');
                $result = $this->subtest_m->get_all_subtest($test_id);
                if (count($result)>0) {
                  foreach ($result as $res) {
                    echo '<option value="'.$res->id.'">'.$res->subtest_name.'</option>';
                  }
                }
            }
        }
    }
    /**
     * [getTestPrice description]
     * @return [type] [description]
     */
    public function getSubTestPrice()
    {
        if($this->input->is_ajax_request()){
          $testPrice = 0;
            $result = array('status' => 'FAIL', 'mes' => '', 'test_price' => 0, 'final_price' => 0);
            if($this->input->post('id')){
                $this->load->model('subtest_model', 'subtest_m');
                $ids = $this->input->post('id');
                $result = $this->subtest_m->getDataByKey('id',$ids,'IN');
                if (($result)>0)
                {
                  foreach ($result as $res) {
                    $testPrice = $testPrice+($res->price);
                  }
                }
                
                $result['status'] = 'SUCCESS';
                $result['test_price'] = $testPrice;
                $result['final_price'] = $testPrice;
                
            }
            echo json_encode($result); return;
        }
    }


}
/* End of file Subtests.php */
/* Location: ./application/controllers/ssubtest.php */