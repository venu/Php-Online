<?php
require_once 'BaseModel.php';
class User extends BaseModel
{
	protected $_name = 'users'; //table name
	protected $_primary = 'id'; //primary key

	public function register($user)
    {
		try{
			$where = $this->getAdapter()->quoteInto('id = ?', $user['id']);
			if($row = $this->fetchRow($where)){
				return $row->toArray();
			}else{
				$this->insert($user);
				$user_id=$this->getAdapter()->lastInsertId();
				$last_id = $this->getAdapter()->quoteInto('id = ?', $user['id']);
				if($row = $this->fetchRow($last_id)){
					return $row->toArray();
				}else{
					return false;
				}
			}
		} catch (Zend_Exception $e) {
			return $e->getMessage();
		}
    }
	
	public function getUserData($user_id){
		$statement =  $this->getAdapter()->query("SELECT * from users where id = ?", array('user_id' => $user_id));
		$data = $statement->fetch();//fetchAll	
	}
}
