<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_details_model extends CI_Model {

	protected $_table = "account_details";
	protected $validate = array(
            array(
                'field' => 'firstname',
                'display' => 'First Name',
                'rules' => 'trim|required|max_length[30]|xss_filter',
            ),
            array(
                'field' => 'phone',
                'display' => 'Phone',
                'rules' => 'trim|required|max_length[10]|xss_filter',
            ),
            array(
                'field' => 'dateofbirth',
                'display' => 'Date of Birth',
                'rules' => 'trim|required|max_length[10]|xss_filter',
            ),
            array(
                'field' => 'gender',
                'display' => 'Gender',
                'rules' => 'required',
            ),
            array(
                'field' => 'state',
                'display' => 'State',
                'rules' => 'required',
            ),
            array(
                'field' => 'city',
                'display' => 'City',
                'rules' => 'required',
            )
        );

	/**
	 * Get details for all account
	 *
	 * @access public
	 * @return object details for all accounts
	 */
	function get()
	{
		return $this->db->get('account_details')->result();
	}

	/**
	 * Get account details by account_id
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account details object
	 */
	function get_by_account_id($account_id)
	{
		return $this->db->get_where('account_details', array('account_id' => $account_id))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Update account details
	 *
	 * @access public
	 * @param int   $account_id
	 * @param array $attributes
	 * @return void
	 */
	function update($account_id, $attributes = array())
	{
		if (isset($attributes['fullname'])) if (strlen($attributes['fullname']) > 160) $attributes['fullname'] = substr($attributes['fullname'], 0, 160);
		if (isset($attributes['firstname'])) if (strlen($attributes['firstname']) > 80) $attributes['firstname'] = substr($attributes['firstname'], 0, 80);
		if (isset($attributes['lastname'])) if (strlen($attributes['lastname']) > 80) $attributes['lastname'] = substr($attributes['lastname'], 0, 80);
		if (isset($attributes['dateofbirth']))
		{
			$this->load->helper('date');
			$attributes['dateofbirth'] = mdate('%Y-%m-%d', strtotime($attributes['dateofbirth']));
		}
		if (isset($attributes['gender']))
		{
			switch (strtolower($attributes['gender']))
			{
				case 'f':
				case 'female':
					$attributes['gender'] = 'f';
					break;
				case 'm':
				case 'male':
					$attributes['gender'] = 'm';
					break;
			}
		}
		if (isset($attributes['postalcode'])) if (strlen($attributes['postalcode']) > 40) $attributes['postalcode'] = substr($attributes['postalcode'], 0, 40);
		// Check that it's a recognized country (see http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
		if (isset($attributes['country']))
		{
			$this->load->model('auth/account/ref_country_model');
			$country = $this->ref_country_model->get($attributes['country']);
			$country ? $attributes['country'] = $country->alpha2 : NULL;
		}
		// Check that it's a recognized language (see http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes)
		if (isset($attributes['language']))
		{
			$language = preg_split('/[_-]/', $attributes['language']);
			// Check for valid language
			if (isset($language[0]))
			{
				$this->load->model('auth/account/ref_language_model');
				$language = $this->ref_language_model->get($language[0]);
				$language ? $attributes['language'] = $language->one : NULL;
			}
		}
		// Check that it's a recognized timezone (tz database, see http://en.wikipedia.org/wiki/Zoneinfo)
		if (isset($attributes['timezone']))
		{
			$this->load->model('auth/account/ref_zoneinfo_model');
			$timezone = $this->ref_zoneinfo_model->get_by_zoneinfo($attributes['timezone']);
			$timezone ? $attributes['timezone'] = $timezone->zoneinfo : NULL;

			// Try to guess country based on timezone
			if ( ! isset($attributes['country']))
			{
				$attributes['country'] = $timezone->country;
			}
		}
		// Try to guess timezone based on country
		elseif (isset($attributes['country']))
		{
			$this->load->model('auth/account/ref_zoneinfo_model');
			$result = $this->ref_zoneinfo_model->get_by_country($attributes['country']);
			if (isset($result[0])) $attributes['timezone'] = $result[0]->zoneinfo;
		}

		// Update
		if ($this->get_by_account_id($account_id))
		{
			$this->db->where('account_id', $account_id);
			$this->db->update('account_details', $attributes);
		}
		// Insert
		else
		{	
			$attributes['account_id'] = $account_id;
			$this->db->insert('account_details', $attributes);

		}
	}

	public function getFirstName(){
		$where['account_id'] = $this->session->userdata('account_id');
		$this->select('firstname');
		$details =  $this->get_by($where);
		return $details->firstname;
	}

	public function getAllAccountDetails(){

		$account_id = $this->session->userdata('account_id');

		//getting account details if any
		$this->db->select("actors.id"); 
		$this->db->where('account_details.account_id',$account_id);
		$this->db->join('actors', 'actors.account_id = account_details.account_id');
		$actorDetails = $this->db->get('account_details')->result_array();
		
		$all_Ids = array();
		if(count($actorDetails)){
			foreach ($actorDetails as $key => $value) {
				array_push($all_Ids, $value['id']);
			}

		}

		return $all_Ids;
	}

	public function buildSenderUrl($category_id,$account_id){
		
		$category = "";
		$details = array(); 
		$where['account_id'] = $account_id;
		switch ($category_id) {
			case 1:
				$category = "actor";
				$this->load->model('home/actor_model','actor_m');
				$details = $this->actor_m->get_by($where);
				$code = $details->code; 
				break;
			case 2:
				$category = "producer";
				$this->load->model('home/producer_model','producer_m');
				$details = $this->producer_m->get_by($where);
				$code = $details->p_code;
				break;
			case 3:
				$category = "technician";
				$this->load->model('home/technician_model','technician_m');
				$details = $this->technician_m->get_by($where);
				$code = $details->t_code;
				break;
			case 4:
				$category = "movie_content";
				$this->load->model('home/moviecontent_model','moviecontent_m');
				$details = $this->moviecontent_m->get_by($where);
				$code = $details->mc_code;
				break;
			case 5:
				$category = "theatre";
				$this->load->model('home/theater_model','theater_m');
				$details = $this->theater_m->get_by($where);
				$code = $details->th_code;
				break;
			case 6:
				$category = "brand";
				$this->load->model('home/brand_model','brand_m');
				$details = $this->brand_m->get_by($where);
				$code = $details->b_code;
				break;
			case 7:
				$category = "resource";
				$this->load->model('home/resource_model','resource_m');
				$details = $this->resource_m->get_by($where);
				$code = $details->r_code;
				break;
			case 7:
				$category = "location";
				$this->load->model('home/loc_model','loc_m');
				$details = $this->loc_m->get_by($where);
				$code = $details->l_code;
				break;
			case 8:
				break;
			default:
				break;
		}
		
		
		return base_url($category."/".$code);
	}
}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */