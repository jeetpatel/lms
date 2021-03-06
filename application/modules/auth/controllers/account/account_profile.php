<?php
/*
 * Account_profile Controller
 */
class Account_profile extends MY_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('auth/account/account');
		$this->load->helper(array('language', 'account/ssl','photo'));
		$this->load->library(array('form_validation', 'gravatar'));
		$this->load->model(array('account/account_model', 'account/account_details_model'));
		$this->load->language(array('general', 'account/account_profile'));

	}

	/**
	 * Account profile
	 */
	function index($action = NULL)
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('auth/account/sign_in');
		}

		// Retrieve sign in user
		$this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		$this->data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
		
		// Retrieve user's gravatar if available
		$this->data['gravatar'] = $this->gravatar->get_gravatar( $this->data['account']->email );

		// Delete profile picture
		if ($action == 'delete')
		{
			unlink(FCPATH.'assets/images/user/'.$this->data['account_details']->picture); // delete previous picture
			$this->account_details_model->update($this->data['account']->id, array('picture' => NULL));
			$this->session->set_userdata('user_image','');
			redirect('auth/account/account_profile');
			
		}

		// Setup form validation
		$this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
		$this->form_validation->set_rules(array(array('field' => 'profile_username', 'label' => 'lang:profile_username', 'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]')));

		// Run form validation
		if ($this->form_validation->run())
		{
			// If user is changing username and new username is already taken
			if (strtolower($this->input->post('profile_username', TRUE)) != strtolower($this->data['account']->username) && $this->username_check($this->input->post('profile_username', TRUE)) === TRUE)
			{
				$this->data['profile_username_error'] = lang('profile_username_taken');
				$error = TRUE;
			}
			else
			{
				$this->data['account']->username = $this->input->post('profile_username', TRUE);
				$this->account_model->update_username($this->data['account']->id, $this->input->post('profile_username', TRUE));
			}
			
			switch( $this->input->post('pic_selection') )
			{
				case "gravatar":

					$this->account_details_model->update($this->data['account']->id, array('picture' => $this->data['gravatar']));
					redirect( current_url() );
					
				break;
				
				default:

					// If user has uploaded a file
					if (isset($_FILES['account_picture_upload']) && $_FILES['account_picture_upload']['error'] != 4)
					{	
						
						// Load file uploading library - http://codeigniter.com/user_guide/libraries/file_uploading.html
						$this->load->library('upload', array('overwrite' => TRUE, 'upload_path' => FCPATH.'/assets/images/user', 'allowed_types' => 'jpg|png|gif', 'max_size' => '800' // kilobytes
						));

						/// Try to upload the file
						if ( ! $this->upload->do_upload('account_picture_upload'))
						{
							$this->data['profile_picture_error'] = $this->upload->display_errors('', '');
							$error = TRUE;
						}
						else
						{
							// Get uploaded picture data
							$picture = $this->upload->data();

							// Create picture thumbnail - http://codeigniter.com/user_guide/libraries/image_lib.html
							$this->load->library('image_lib');
							$this->image_lib->clear();
							$this->image_lib->initialize(array('image_library' => 'gd2', 'source_image' => FCPATH.'/assets/images/user/'.$picture['file_name'], 'new_image' => FCPATH.'/assets/images/user/pic_'.$this->data['account']->id.$picture['file_ext'], 'maintain_ratio' => FALSE, 'quality' => '100%', 'width' => 100, 'height' => 100));

							// Try resizing the picture
							if ( ! $this->image_lib->resize())
							{
								$this->data['profile_picture_error'] = $this->image_lib->display_errors();
								$error = TRUE;
							}
							else
							{
								$this->data['account_details']->picture = 'pic_'.$this->data['account']->id.$picture['file_ext'];
								$this->account_details_model->update($this->data['account']->id, array('picture' => $this->data['account_details']->picture));
							}

							// Delete original uploaded file
							unlink(FCPATH.'assets/images/user/'.$picture['file_name']);
							$this->session->set_userdata('user_image','pic_'.$this->data['account']->id.$picture['file_ext']);
							redirect(current_url());
							
						}
					}
				
				break;
				
			} // end switch

			if ( ! isset($error)) $this->data['profile_info'] = lang('profile_updated');
		}

		$this->template->load_view('account/account_profile', $this->data);
	}

	/**
	 * Check if a username exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function username_check($username)
	{
		return $this->account_model->get_by_username($username) ? TRUE : FALSE;
	}

}


/* End of file account_profile.php */
/* Location: ./application/account/controllers/account_profile.php */