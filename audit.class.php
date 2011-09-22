<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

require_once $AppUI->getSystemClass('dp');
/**
 * Audit Class
 */
class Audit extends CDpObject {

    function doStuff() {
        return true;
    }
}

class Auditor extends CDpObject {

    var $contact_id = NULL;
    var $project_id = NULL;

    function Auditor() {
        $this->CDpObject('auditors', 'auditor_id');
    }

    function loadAll($order = null, $where = null) {
        $q = new DBQuery();
        $q->clear();
        $q->addTable('auditors','auditors');
        if ($order) {
            $q->addOrder($order);
        }
        if ($where) {
            $q->addWhere($where);
        }
        $q->addJoin('projects', 'projects', 'projects.project_id = auditors.project_id');
        $q->addJoin('contacts', 'contacts', 'contacts.contact_id = auditors.contact_id');
        $sql = $q->prepare();
        return db_loadHashList($sql, $this->_tbl_key);
    }

    function save() {
        $q = new DBQuery();
        $q->clear();
        if ($this->contact_id != NULL && $this->project_id != NULL){
            $q->addTable('auditors');
            $q->addInsert('project_id',$this->project_id);
            $q->addInsert('contact_id',$this->contact_id);
            $q->prepare();
            return true;
        }
        return false;
    }

    function find($auditor_id){
        $q = new DBQuery();
        $q->clear();
        $q->addTable('auditors');
        $q->addWhere('auditor_id = '.$auditor_id);
        $q->prepare();
        return $this->loadObject;
    }

    function remove($auditor_id){
        $q = new DBQuery();
        $q->setDelete('auditors');
        $q->addWhere('auditor_id = ' . $auditor_id);
        if (!$q->exec())
			return db_error();
		else
			return null;
    }
}
?>