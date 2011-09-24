<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

class CProjectAudit extends CProject {

    function GetContacts() {
        $this->_query->clear();
        $this->_query->addTable('project_contacts');
        $this->_query->addJoin('contacts', 'contacts', 'contacts.contact_id = project_contacts.contact_id');
        $this->_query->addWhere('project_contacts.project_id = '.$this->project_id);
        $this->_query->prepare();
        return db_loadHashList($this->_query, 'contacts.contact_id');
    }

    function GetAuditors() {
        $this->_query->clear();
        $this->_query->addTable('auditors');
        $this->_query->addJoin('contacts', 'contacts', 'contacts.contact_id = auditors.contact_id');
        $this->_query->addWhere('auditors.project_id = '.$this->project_id);
        $this->_query->prepare();
        return db_loadHashList($this->_query, 'contacts.contact_id');
    }

    function GetNotAuditors(){
        return array_diff($this->GetContacts(), $this->GetAuditors());
    }

}
