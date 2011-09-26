<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

require_once($AppUI->getModuleClass('projects'));

class CProjectAudit extends CProject {
    function GetContacts($project_id) {
        $this->_query->clear();
        $this->_query->addTable('contacts', 'contacts');
        $this->_query->addJoin('project_contacts', 'project_contacts', 'contacts.contact_id = project_contacts.contact_id');
        $this->_query->addWhere('project_contacts.project_id = '.$project_id);
        $sql = $this->_query->prepare();
        return db_loadHashList($sql, 'contact_id');
    }

    function GetAuditors($project_id) {
        $this->_query->clear();
        $this->_query->addTable('contacts', 'contacts');
        $this->_query->addJoin('auditors', 'auditors', 'contacts.contact_id = auditors.contact_id');
        $this->_query->addWhere('auditors.project_id = '.$project_id);
        $sql = $this->_query->prepare();
        return db_loadHashList($sql, 'contact_id');
    }

    function isAuditor($project_id, $contact_id){
        $this->_query->clear();
        $this->_query->addTable('auditors', 'auditors');
        $this->_query->addWhere('auditors.project_id = '.$project_id.' and auditors.contact_id = '.$contact_id);
        $sql = $this->_query->prepare();
        return db_loadHashList($sql, 'contact_id');
    }
}