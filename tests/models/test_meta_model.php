<?php 

class test_meta_model extends CodeIgniterUnitTestCase {

	private $prefix;
	private $meta_id;

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();
		
		$this->ci->load->model('meta/meta_model', 'meta_model', true);
		
		$this->prefix = $this->db->dbprefix;
	}
	
	//--------------------------------------------------------------------
	
	public function test_is_loaded() 
	{
		$this->assertTrue(class_exists('Meta_model'));
	}
	
	//--------------------------------------------------------------------
	
	public function test_setup_module_returns_true() 
	{
		$this->assertTrue($this->meta_model->setup_module_meta('meta'));
	}
	
	//--------------------------------------------------------------------
	
	public function test_insert_returns_false_with_no_info() 
	{
		$this->assertFalse($this->meta_model->insert());
	}
	
	//--------------------------------------------------------------------
	
	public function test_insert_returns_int_on_success() 
	{
		$result = $this->meta_model->insert('test', 'testing', 'meta', 1, 1);
		$this->meta_id = $result;
		$this->assertIsA($result, 'Integer');
	}
	
	//--------------------------------------------------------------------
	
	public function asdf() 
	{
	
	}
	
	//--------------------------------------------------------------------
	
	
	
	
	
	
	public function test_remove_module_returns_true() 
	{
		//$this->assertTrue($this->meta_model->remove_module_meta('meta'));
	}
	
	//--------------------------------------------------------------------
}