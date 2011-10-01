<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

/**
 * Auditor Class
 */

class Auditor extends CDpObject {
    var $contact_id = NULL;
    var $project_id = NULL;
    var $mail = NULL;

    function Auditor() {
        $this->CDpObject('auditors', 'auditor_id');
    }

    function loadAll($order = null, $where = null) {
        $this->_query->clear();
        $this->_query->addTable('auditors','auditors');
        if ($order) {
            $this->_query->addOrder($order);
        }
        if ($where) {
            $this->_query->addWhere($where);
        }
        $this->_query->addJoin('projects', 'projects', 'projects.project_id = auditors.project_id');
        $this->_query->addJoin('contacts', 'contacts', 'contacts.contact_id = auditors.contact_id');
        $sql = $this->_query->prepare();
        return db_loadHashList($sql, $this->_tbl_key);
    }

    function delete($id=null) {
        $this->_query->clear();
		$this->_query->setDelete('auditors');
		$this->_query->addWhere(dPgetConfig('dbprefix', '').'auditors.auditor_id = '.$id);
		$result = ((!$this->_query->exec())?db_error():null);
		return $result;
	}

    function getContact(){
        $this->_query->clear();
		$this->_query->addTable('contacts');
		$this->_query->addWhere('contacts.contact_id = '.$this->contact_id);
		$sql = $this->_query->prepare();
		return db_loadObject($sql, null);
    }

    function setMail(){
        $this->mail = new Mail();
        $this->mail->From("DotProject");
        $this->mail->To($this->getContact->email);
    }
}
?>