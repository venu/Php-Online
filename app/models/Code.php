<?php 
require_once 'BaseModel.php';

class Code extends BaseModel
{
	protected $_name = 'codes'; //table name
	protected $_primary = 'id'; //primary key
	
	
	function add($data) {
		if($data['filename'] =='' || $data['code'] =='' || $data['user_id'] == ''){
			$this->_messages[] = "some data missing";
			return false;
		}
		
		
		$select = $this->select()->from($this->_name, array('id'))
								->where("filename = ?", $data['filename'])
								->where("user_id != ?", $data['user_id']);
		$others_file = $this->fetchRow($select);
		if($others_file){
			$this->_messages[] = "You cannot save this file as you are not the owner of the file";
			return false;
		}
		
		try{
			
			$this->_db->beginTransaction();
			
				$revision_data = $this->getAdapter()->query('SELECT max(revision) as rev 
															FROM codes  
															WHERE filename = ? 
															FOR UPDATE', 
															array($data['filename']))
													->fetch();
				if(!$revision_data) {
					$key = 0;				
				}else{
					$key = $revision_data['rev'];
				}
				
				$data['revision'] = ++$key;
				$id = $this->insert($data);
			
			$this->_db->commit();		
			
			return $data['revision'];
		}catch(Exception $e){
			$this->_db->rollBack();
			$this->_messages[] = $e->getMessage();
			return false;
		}
	}
	
	function getMyList($user_id) {
		if($user_id == ''){
			$this->_messages[] = "some data missing";
			return false;
		}
		
		$sub_query = $this->getAdapter()->select()->from($this->_name, array(new Zend_Db_Expr('max(revision) as rev, filename')))
								->where("user_id = ?", $user_id)->group("filename");
								
		
		$select = $this->getAdapter()->select()->from(array('c'=>$sub_query), array('rev'))
								->join(array('ca'=>'codes'),'c.filename = ca.filename AND ca.revision = c.rev',array('filename','name','revision','id'))
								->where("user_id = ?", $user_id)
								->group("filename")
								->order(array("filename asc","revision desc"));
		$data = $select->query()->fetchAll();
		return $data;
	}
  
	function getCode($filename, $revision) {
		if($filename == '' || $revision == ''){
			$this->_messages[] = "some data missing";
			return false;
		}
		
		$select = $this->select()->from($this->_name, array('*'))
								->where("filename = ?", $filename)
								->where("revision = ?", $revision);
		$data = $this->fetchRow($select);
		return ($data) ? $data->toArray() : '';
	}
	
	function getMaxRevision($filename) {
		if($filename == '' ){
			$this->_messages[] = "some data missing";
			return false;
		}
		
		$data = $this->fetchRow( $this->select()->from($this->_name, array(new Zend_Db_Expr('max(revision) as rev'))) );
		return ($data && $data->rev) ? $data->rev : 0;
	}
	
	
	function remove($filename, $user_id) {
		if($filename == '' || $user_id == ''){
			$this->_messages[] = "some data missing";
			return false;
		}
		
		try{
			$where[] = $this->getAdapter()->quoteInto('filename = ?', $filename);
			$where[] = $this->getAdapter()->quoteInto('user_id = ?', $user_id);
			$this->delete($where);
			return 1;
		}catch(Exception $e){
			$this->_messages[] = "some error occured";
			return false;
		}
	}



}		