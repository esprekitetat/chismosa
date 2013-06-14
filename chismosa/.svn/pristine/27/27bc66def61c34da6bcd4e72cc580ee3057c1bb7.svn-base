<?php //-->
/*
 * This file is part a custom application package.
 */

//http://svn.openovate.com/pokemon/trunk

/**
 * Default logic to output a page
 */
class Front_Page_Foo_Bar_Test2 extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'Foo Bar';
	protected $_class = 'foo-bar';
	protected $_template = '/foo/bar/test2.phtml';
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {


		// $database = front()->Post_Model();
		$database = eden('mysql','127.0.0.1','love','root','');

		$joins = $filter = $sort = array();
		$joins[]                = array('inner', 'post', 'user_id=post_user', false);
		$filter[]               = array('post_active = %d', 1);
		$sort['user_id']        = 'ASC';
		$sort['user_created']   = 'DESC';
		 
		$rows = $database->getRows('user', $joins, $filter, $sort, 0, 25);	

		if(!empty($_POST)) {
			//do something
			header('Location: /test');
		}
		
		$this->_body = array(
		'rows'		=> $rows );
		// echo 'haha';
		return $this->_page();
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
