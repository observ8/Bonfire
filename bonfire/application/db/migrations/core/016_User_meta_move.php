<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_User_meta_move extends Migration {
	
	private $core_user_fields = array(
		'id',
		'role_id',
		'email',
		'username',
		'password_hash',
		'reset_hash',
		'salt',
		'last_login',
		'last_ip',
		'created_on',
		'deleted',
		'banned',
		'ban_message',
		'reset_by'
	);
	private $default_fields = array(
		'first_name'	=> array(
			'label'			=> 'First Name',
			'type'			=> 'text',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 1	
		),
		'last_name'	=> array(
			'label'			=> 'Last Name',
			'type'			=> 'text',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 2
		),
		'street_1'	=> array(
			'label'			=> 'Address 1',
			'type'			=> 'text',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 3
		),
		'street_2' => array(
			'label'			=> 'Address 2',
			'type'			=> 'text',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 4
		),
		'city'	=> array(
			'label'			=> 'City',
			'type'			=> 'text',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 5
		),
		'zipcode'	=> array(
			'label'			=> 'Postal Code',
			'type'			=> 'text',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 7
		),
		'state_code'	=> array(
			'label'			=> 'State',
			'type'			=> 'state',
			'validators'	=> '',
			'order'			=> 6
		),
		'country_iso'	=> array(
			'label'			=> 'Country',
			'type'			=> 'country',
			'validators'	=> 'trim|strip_tags|xss_clean',
			'order'			=> 8
		)
	);
	
	//--------------------------------------------------------------------
	
	/*
		Adding the table for user_meta and moving all current meta fields
		over to the new table.
	*/
	public function up() 
	{
		$this->load->dbforge();
		
		$this->setup_module_meta('User');
		
		/*
			Backup our users table
		*/
		$this->load->dbutil();
		
		$filename = APPPATH .'backup_meta_users_table.txt';

		$prefs = array(
			'tables'		=> $this->db->dbprefix .'users',
			'format'		=> 'txt',
			'filename'		=> $filename,
			'add_drop'		=> true,
			'add_insert'	=> true
		);
		$backup =& $this->dbutil->backup($prefs);
		
		$this->load->helper('file');
		write_file($filename, $backup);
		
		if (file_exists($filename))
		{
			log_message('info', 'Backup file successfully saved. It can be found at <a href="/'. $filename .'">'. $filename . '</a>.');
		}
		else
		{
			log_message('error', 'There was a problem saving the backup file.');
			die('There was a problem saving the backup file.');
		}
		
		/*
			Create display_name field in users table
		*/
		$field = array(
			'display_name'	=> array(
				'type'			=> 'varchar',
				'constraint'	=> 255,
				'null'			=> false,
				'default'		=> 'Unnamed'
			)
		);
		$this->dbforge->add_column('users', $field);
		
		/*
			Create our custom fields for the user.
		*/
		$field_ids = array();
		
		foreach ($this->default_fields as $field => $vals)
		{
			$vals['name']	= $field;
		
			$field_ids[$field] = $this->insert_custom_field($vals, 'user');
		}
		
		/*
			Move User data to meta table
		*/
	
		// If there are users, loop through them and create meta entries
		// then remove all 'non-core' columns as they will now be in the meta table.
		if ($this->db->count_all_results('users'))
		{
			$query = $this->db->get('users');
			$rows = $query->result();

			foreach ($rows as $row)
			{
				foreach ($this->default_fields as $field => $vals)
				{
					// We don't want to store the field if it doesn't exist in the user profile.
					if (!empty($row->$field))
					{
						$data = array(
							'field_id'		=> $field_ids[$field],
							$module .'_id'	=> $row->id,
							'meta_key'		=> $field,
							'meta_value'	=> $row->$field
						);

						$this->db->insert($this->table, $data);
						
						unset($data);
					}
				}
				
				// Set a default display name
				$this->user_model->update_display_name();
			}
		}
		
		/*
			Drop existing columns from users table.
		*/
		$fields = $this->db->list_fields('users');

		foreach($fields as $field)
		{
			if(!in_array($field, $this->core_user_fields)) {
				$this->dbforge->drop_column('users', $field);
			}
		}
		unset($fields);
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$this->load->dbforge();
		
		// Copy the information back over to the users table.
		
		
		
		$this->load->model('meta/meta_model');
		
		$this->meta_model->remove_module_meta('User');
	}
	
	//--------------------------------------------------------------------
	
	//--------------------------------------------------------------------
	// !META FUNCTIONS
	//--------------------------------------------------------------------
	// These functions were taken from the meta_model to make
	// creating and removing the meta information simpler.
	//
	
	/*
		Method: setup_module_meta()
		
		Sets up a new module to have custom field information usable.
		This sets up 2 new tables: 
			
			'*_fields'	- Holds the fields and their display information.
			'*_meta'	- Holds the actual custom data.
			
		Parameters:
			$module	- A string with the name of the module. This is the
					  name that will be used for the table names. 
					  
		Returns:
			true/false
	*/
	public function setup_module_meta($module=null) 
	{
		if (empty($module))
		{
			return false;
		}
		
		$this->load->dbforge();
		
		$this->prep_module($module);

		// Fields table
		if (!$this->db->table_exists($module .'_fields'))
		{ 
			$fields = array(
				'id'	=> array(
					'type'			=> 'INT',
					'constraint'	=> 4,
					'unsigned'		=> true,
					'auto_increment'	=> true
				),
				'name'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 32,
				),
				'label'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 50
				),
				'order'	=> array(
					'type'			=> 'int',
					'constraint'	=> 11,
					'default'		=> 0
				),
				'desc'	=> array(
					'type'		=> 'text',
					'null'		=> true,
				),
				'type'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 50
				),
				'options'	=> array(
					'type'		=> 'text',
					'null'		=> true,
				),
				'width'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 20,
					'null'			=> true,
				),
				'default'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 255,
					'null'			=> true,
				),
				'placeholder'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 255,
					'null'			=> true,
				),
				'required'	=> array(
					'type'			=> 'tinyint',
					'constraint'	=> 1,
					'default'		=> 0
				),
				'validators'	=> array(
					'type'		=> 'text',
					'null'		=> true,
				),
				'created_on'	=> array(
					'type'		=> 'datetime',
					'null'		=> true
				),
				'modified_on'	=> array(
					'type'		=> 'datetime',
					'null'		=> true
				)
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', true);
	
			$this->dbforge->create_table($module .'_fields');
		}
		
		// Meta table
		if (!$this->db->table_exists($module .'_meta'))
		{	
			$fields = array(
				'meta_id'	=> array(
					'type'			=> 'INT',
					'constraint'	=> 20,
					'unsigned'		=> true,
					'auto_increment'	=> true
				),
				'field_id'	=> array(
					'type'			=> 'INT',
					'constraint'	=> 4,
					'unsigned'		=> true,
					'default'		=> 0
				),
				$module .'_id'	=> array(
					'type'			=> 'INT',
					'constraint'	=> 20,
					'unsigned'		=> true,
					'default'		=> 0
				),
				'meta_key'	=> array(
					'type'			=> 'varchar',
					'constraint'	=> 255,
					'default'		=> ''
				),
				'meta_value' => array(
					'type'		=> 'text',
					'null'		=> true,
				),
				'created_on'	=> array(
					'type'		=> 'datetime',
					'null'		=> true
				),
				'modified_on'	=> array(
					'type'		=> 'datetime',
					'null'		=> true
				)		
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('meta_id', TRUE);
			
			$this->dbforge->create_table($module .'_meta');
		}
		
		return true;
	}
	
	//--------------------------------------------------------------------
	
	/*
		Method: remove_module_meta()
		
		Removes any meta/field tables from the database for a given module.
		Intended to be used during migrations.
		
		Parameters:
			$module	- A string with the module name
		
		Returns:
			true/false
	*/
	public function remove_module_meta($module=null) 
	{
		if (empty($module))
		{
			$this->error = lang('meta_no_module');
			return false;
		}
		
		$this->load->dbforge();
		
		$this->prep_module($module);
		
		$this->dbforge->drop_table($module .'_fields');
		$this->dbforge->drop_table($module .'_meta');
		
		return true;
	}
	
	//--------------------------------------------------------------------
	
	/*
		Method: insert_custom_field()
		
		Creates a new custom field entry for the specified module.
		
		The params array should be formatted as a series of key/value pairs
		that match the following...
		
		$params = array(
			'field_name'		=> '',	// The system name of the field. Required. No spaces.
			'field_label'		=> '',	// The display name of the field. Required.
			'field_order'		=> '',	// The display order. INT. Optional. Defaults to 0.
			'field_desc'		=> '',	// Description of field. Used as a help string. Optional.
			'field_type'		=> '',	// The type of field, ie 'text', 'dropdown', 'checkbox', etc.
			'field_options'		=> '',	// Only needed for selects. A serialized set of options/values.
			'field_width'		=> '',	// A string with the input width. Used for CSS display.
			'field_default'		=> '',	// A default value. Optional.
			'field_required'	=> '',	// Either 0 or 1 for not required/required. Defaults to 0.
			'field_validators	=> ''	// A string with pipe-delimited validation rules. ie 'trim|xss_clean'.
		);
		
		Parameters: 
			$params	- An array of key/value pairs with the entries.
			$module	- The module name.
			
		Returns: 
			An int with the ID of the field or FALSE.
	*/
	public function insert_custom_field($params=null, $module=null) 
	{
		if (!is_array($params))
		{
			$this->error = 'No parameters found.';
			return false;
		}
		
		if (empty($module))
		{
			$this->error = 'No module found.';
			return false;
		}
		
		$this->prep_module($module);
		
		if ($this->db->insert($this->field_table, $params))
		{
			return $this->db->insert_id();
		}
		
		return false;		
	}
	
	//--------------------------------------------------------------------
	
	public function prep_module(&$module) 
	{	
		// Prep the module name for use in table
		$module = url_title($module, 'underscore', true);
		
		// Setup the table to use
		$this->table 		= $module .'_meta';
		$this->field_table	= $module .'_fields';

		$this->key = $module .'_id';
	}
	
	//--------------------------------------------------------------------
}