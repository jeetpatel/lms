<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Form_validation Class
 *
 * Extends Form_Validation library
 *
 * Adds one validation rule, "unique" and accepts a
 * parameter, the name of the table and column that
 * you are checking, specified in the forum table.column
 *
 * Note that this update should be used with the
 * form_validation library introduced in CI 1.7.0
 */
 
class MY_Form_validation extends CI_Form_validation {

	function __construct()
	{   
		parent::__construct();
	}



	/**
	 * [it will check the uniqueness based on given conditions excluding the wherenot informations]
	 * @param  string $table          [name of the table]
	 * @param  array  $where          [where conditions]
	 * @param  string $wherenotcolumn [where not column name]
	 * @param  array  $wherenot       [where not conditions]
	 * @param  string $error_name      [custom name of error message]
	 * @param  array $error_mes       [custom error message to be set]
	 * @return                  
	 */
	public function my_unique($table = '', $wherenotcolumn = '', $wherenot= array() ,$where = array(), $error_mes = 'err mess'){
		
		$CI =& get_instance();
		
		if(!empty($wherenotcolumn) && count($wherenot)>0)
			$CI->db->where_not_in($wherenotcolumn,$wherenot);

		if(!empty($where))
			$CI->db->where($where);

		$result = $CI->db->get($table);
		
		if($result->num_rows() > 0)
           {	
           	  $CI->form_validation->set_message('my_unique', $error_mes);
              $CI->form_validation->_error_array = $CI->form_validation->_error_messages;
           }
		
	}

	}

?>