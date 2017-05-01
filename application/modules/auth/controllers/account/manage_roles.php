<?php
/*
 * Manage_roles Controller
 */
class Manage_roles extends MY_Controller {

  /**
   * Constructor
   */
  function __construct()
  {
    parent::__construct();

    if(!$this->authorization->is_permitted('manage_roles') && !$this->authorization->is_admin()){
        redirect('');
    }

    // Load the necessary stuff...
    $this->load->config('auth/account/account');
    $this->load->helper(array('date', 'language', 'account/ssl'));
    $this->load->library(array('form_validation'));
    $this->load->model(array('account/account_model', 'account/account_details_model', 'account/acl_permission_model', 'account/acl_role_model', 'account/rel_account_permission_model', 'account/rel_account_role_model', 'account/rel_role_permission_model'));
    $this->load->language(array('general', 'account/manage_roles', 'account/account_settings', 'account/account_profile', 'account/sign_up', 'account/account_password'));

  }

  /**
   * Manage Roles
   */
  function index()
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

    // Get all permossions, roles, and role_permissions
    $roles = $this->acl_role_model->get();
    $permissions = $this->acl_permission_model->get();
    $role_permissions = $this->rel_role_permission_model->get();

    // Combine all these elements for display
    $this->data['roles'] = array();
    foreach( $roles as $role )
    {
      $current_role = array();
      $current_role['id'] = $role->id;
      $current_role['name'] = $role->name;
      $current_role['description'] = $role->description;
      $current_role['perm_list'] = array();
      $current_role['user_count'] = $this->acl_role_model->get_user_count($role->id);
      $current_role['is_disabled'] = isset( $role->suspendedon );

      foreach( $role_permissions as $rperm )
      {
        if( $rperm->role_id == $role->id )
        {
          foreach( $permissions as $perm )
          {
            if( $rperm->permission_id == $perm->id )
            {
              $current_role['perm_list'][] = array(
                'id' => $perm->id, 
                'key' => $perm->key,
                'title' => $perm->description );
            }
          }
        }
      }

      $this->data['roles'][] = $current_role;
    }

    $this->data['appScript'] = "$('#roles').DataTable(); $('#example1').DataTable();";
    
    $this->template->add_thirdparty_css("datatables/jquery.dataTables.min.css");  
    $this->template->add_thirdparty_js("datatables/jquery.dataTables.min.js");  
    // Load manage roles view
    $this->template->load_view('account/manage_roles', $this->data);
  }


  /**
   * Manage Roles
   */
  function save($id=null)
  {
    // Keep track if this is a new role
    $is_new = empty($id);

    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('auth/account/sign_in/?continue='.urlencode(base_url().'account/manage_roles'));
    }

    // Set action type (create or update role)
    $this->data['action'] = 'create';

    // Get all the permissions
    $this->data['permissions'] = $this->acl_permission_model->get();

    // Is this a System Role?
    $this->data['is_system'] = FALSE;

    //Get the role
    if( ! $is_new )
    {
      $this->data['role'] = $this->acl_role_model->get_by_id($id);

      if(empty($this->data['role'])){
        redirect('auth');
      }
      
      $this->data['role_permissions'] = $this->rel_role_permission_model->get_by_role_id($id);
      $this->data['action'] = 'update';
      $this->data['is_system'] = ($this->data['role']->is_system == 1);
    }

    // Retrieve sign in user
    $this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'role_name',
          'label' => 'lang:roles_name',
          'rules' => 'trim|required|max_length[80]'),
        array(
          'field' => 'role_description',
          'label' => 'lang:roles_description',
          'rules' => 'trim|max_length[160]')
      ));

    // Run form validation
    if ($this->form_validation->run())
    {
      $name_taken = $this->name_check($this->input->post('role_name', TRUE));

      if ( (! empty($id) && strtolower($this->input->post('role_name', TRUE)) != strtolower($this->data['role']->name) && $name_taken) || (empty($id) && $name_taken) )
      {
        $this->data['role_name_error'] = lang('roles_name_taken');
      }
      else
      {
        // Create/Update role
        $attributes = array();

        // Now allowed to update the Admin role name
        if( ! $this->data['is_system'] )
        {
          $attributes['name'] = $this->input->post('role_name', TRUE) ? $this->input->post('role_name', TRUE) : NULL;
        }

        $attributes['description'] = $this->input->post('role_description', TRUE) ? $this->input->post('role_description', TRUE) : NULL;
        $id = $this->acl_role_model->update($id, $attributes);

      
        if( $this->input->post('manage_role_ban', TRUE) )
        {
          $this->acl_role_model->update_suspended_datetime($id);
        }
        elseif( $this->input->post('manage_role_unban', TRUE))
        {
          $this->acl_role_model->remove_suspended_datetime($id);
        }
      

        // Apply the checked permissions
        $perms = array();
        foreach( $this->data['permissions'] as $perm )
        {
          if( $this->input->post("role_permission_{$perm->id}", TRUE) )
          {
            $perms[] = $perm->id;
          }
        }
        $this->rel_role_permission_model->delete_update_batch($id, $perms);

        redirect('auth/account/manage_roles');
      }
    }

    // Load manage roles view
    $this->template->load_view('account/manage_roles_save', $this->data);
  }

  /**
   * Check if the role name exist
   *
   * @access public
   * @param string
   * @return bool
   */
  function name_check($role_name)
  {
    return $this->acl_role_model->get_by_name($role_name) ? TRUE : FALSE;
  }

}


/* End of file manage_roles.php */
/* Location: ./application/account/controllers/manage_roles.php */
