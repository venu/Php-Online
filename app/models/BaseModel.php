<?php
require_once LIBRARY_PATH . '/Zend/Db/Table/Abstract.php';
class BaseModel extends Zend_Db_Table_Abstract
{
	protected $_messages = array();
	
	public function getMessages(){
        return $this->_messages;
    }
	
    public function insert(array $data){	 	
       if (empty($data['created_at'])) {
            $data['created_at'] = new Zend_Db_Expr('NOW()');
        }
		return parent::insert($data);
    }

    public function update(array $data, $where){
       if (empty($data['updated_at'])) {
            $data['updated_at'] = new Zend_Db_Expr('NOW()');
        }
        return parent::update($data, $where);
    }
	
	public function exists($where){ 
	  return $this->fetchAll($where)->count() > 0 ? true : false; 
	} 
	
	public function found_rows(){
		return $this->_db->query("SELECT FOUND_ROWS()");
	}
	
}

?>