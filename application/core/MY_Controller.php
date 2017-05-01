<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// Load the MX_Controller class
require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller {

    private $_ci;
    protected $data = array('slider' => TRUE,'breadcrumb' => array(), 'viewbreadcrumb' => TRUE);
    protected $appScript = "";
    
    
    public function __construct()
    {
        parent::__construct();

        $this->_ci =& get_instance();
        $this->data['appScript'] = "";
        $this->data['slider'] = TRUE;

        $this->load->library('template');

        // $this->output->enable_profiler(TRUE);
        
        if ($this->authentication->is_signed_in() && ($this->authorization->is_admin() || $this->authorization->is_staff())){
            $this->load->model(array('auth/account/account_model'));
            $this->load->helper(array('language', 'form', 'auth/account/ssl'));
            $this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->set_title('Admin');
            $this->template->set_header('admin/common/header');
            $this->template->set_footer('admin/common/footer');   
        }   
    }

    /**
     * Load Javascript inside the page's body
     * @access  public
     * @param   string  $script
     */
    public function _load_script($script)
    {
        if (isset($this->_ci->template) && is_object($this->_ci->template))
        {
            // Queue up the script to be executed after the page is completely rendered
            echo <<< JS
<script>
    var CIS = CIS || { Script: { queue: [] } };
    CIS.Script.queue.push(function() { $script });
</script>
JS;
        }
        else
        {   
            echo '<script>' . $script . '</script>';
        }
    }


    function prepare_flashmessage($msg,$type,$call = '')
    {   
        $returnmsg='';
        switch($type){
            case 0: $returnmsg = " <div class='alert-success alert-style'>
                                            <a href='#' class='alertclose' data-dismiss='alert'>&times;</a>
                                            <small><strong>Success! ". $msg." </strong></small>
                                        </div>
                                    ";
                break;
            case 1: $returnmsg = " 
                                        <div class='alert-danger alert-style'>
                                            <a href='#' class='alertclose' data-dismiss='alert'>&times;</a>
                                            <small><strong>Error! ". $msg." </strong></small>
                                        </div>
                                    ";
                break;
            case 2: $returnmsg = " 
                                        <div class='alert-info alert-style'>
                                            <a href='#' class='alertclose' data-dismiss='alert'>&times;</a>
                                            <small><strong>Info! ". $msg." </strong></small>
                                        </div>
                                    ";
                break;
            case 3: $returnmsg = " 
                                        <div class='alert-warning alert-style'>
                                            <a href='#' class='alertclose' data-dismiss='alert'>&times;</a>
                                            <small><strong>Warning!". $msg." </strong></small>
                                        </div>
                                    ";
                break;

          case 4: $returnmsg = " 
                            <div class='alert-danger alert-style'>
                                <a href='#' class='alertclose' data-dismiss='alert'>&times;</a>
                                <small><strong> ". $msg." </strong></small>
                            </div>
                        ";
                break;

        }
        
        if(empty($call))
            $this->session->set_flashdata("message",$returnmsg);
        else
            return $returnmsg;
    }
}

class Ajax_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('response');
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */