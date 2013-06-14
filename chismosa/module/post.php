<?php //-->
/*
 * This file is part a custom application package.
 */
class Post {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_database = NULL;
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	public function __construct(Eden_Mysql $database) {
		$this->_database = $database->setModel('Post_Model');
	}
	
	/* Public Methods
	-------------------------------*/
	/**
	 * Get a list of posts
	 *
	 * @param string|null keyword
	 * @param int starting point
	 * @param int # of rows to return
	 * @param array sort
	 * @return array a list of posts
	 */
	public function getList($keyword = NULL, $start = 0, $range = 25, array $sort = array()) {
		$search = $this->_database
			->search('post')
			->setStart($start)
			->setRange($range);
		
		if($keyword) {
			$search->addFilter('post_title LIKE %s OR post_detail LIKE %s', '%'.$keyword.'%', '%'.$keyword.'%');
		}
		
		if(!empty($sort)) {
			foreach($sort as $key => $order) {
				$search->addSort($key, $order);
			}
		}
		
		return $search->getRows();
	}
	
	/**
	 * Get post detail
	 *
	 * @param int
	 * @return array
	 */
	public function getDetail($id) {
		return $this->_database->getRow('post', 'post_id', $id);
	}
	
	/**
	 * updates a post
	 *
	 * @param int
	 * @param array
	 * @return this
	 */
	public function update($id, array $data) {
		$this->_database
			->model($data)
			->setPostId($id)
			->save('post');
	
		return $this;
	}
	
	/**
	 * Removes a post
	 *
	 * @param int
	 * @return this
	 */
	public function remove($id) {
		$this->_database->model()->setPostId()->remove();
		
		return $this;
	}
	
	/**
	 * Creates a post
	 *
	 * @param array
	 * @return this
	 */
	public function create(array $data) {
		$this->_database->model($data)->save('post');
		
		return $this;
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}