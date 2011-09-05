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

    function Auditor($perm_name='') {
        $this->_tbl = 'auditors';
        $this->_tbl_key = 'auditor_id';
        $this->_permission_name = (($perm_name) ? $perm_name : 'auditors');
        $this->_query = new DBQuery;
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
        $this->_query->clear();
        return db_loadHashList($sql, $this->_tbl_key);
    }

    function save() {
        global $contact_id, $project_id;
        if ($this->$contact_id != NULL || $this->$project_id != NULL){
            $this->_query->clear();
            $this->_query->addTable('auditors');
            $this->_query->addInsert('project_id',$contact_id);
            $this->_query->addInsert('contact_id',$project_id);
            $this->_query->prepare();
            $this->_query->clear();
            return true;
        }
        return false;
    }

    function find($auditor_id){
        $this->_query->clear();
        $this->_query->addTable('auditors');
        $this->_query->addWhere('auditor_id = '.$auditor_id);
        $this->_query->prepare();
        $this->_query->clear();
        return $this->loadObject;
    }

    function delete($auditor_id){
        $this->_query->clear();
        $this->_query->setDelete('auditors');
        $this->_query->addWhere('auditor_id = '.$auditor_id);
        $this->_query->exec();
        $this->_query->clear();
    }
}
?>