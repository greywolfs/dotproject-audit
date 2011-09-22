<?php
		if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}
/*
        *  Name: Audit
        *  Directory: audit
        *  Version 0.1
        *  Type: user
        *  UI Name: Audit
        */
$config['mod_name'] = "Audit";
$config['mod_version'] = "0.1";
$config['mod_directory'] = "audit";
$config['mod_setup_class'] = "CSetupAudit";
$config['mod_type'] = "user";
$config['mod_ui_name'] = "Audit";
$config['mod_ui_icon'] = "";
$config['mod_description'] = "A module for auditions";
$config['mod_config'] = true;
$config['permissions_item_table'] = "audit";
$config['permissions_item_field'] = "audit_id";
$config['permissions_item_label'] = "audit_name";

class CSetupAudit{

    function configure() { return true; }

    function remove() {
        if($this->removeArtefact() && $this->removeAudit() && $this->removeAuditors() && $this->removeChecklist()) {
            return NULL;
        }
    }

    function upgrade($old_version) {
        return true;
    }

    function install() {
        if($this->installArtefact() && $this->installAudit() && $this->installAuditors() && $this->installChecklist()) {
            return NULL;
        }
    }

    function installArtefact() {
        $q = new DBQuery();
        $q->createTable('artefacts');
        $q->createDefinition("(artefact_id integer auto_increment,".
                             " artefact_name varchar(255) not null,".
                             " artefact_description varchar(255),".
                             " artefact_phase varchar(255),".
                             " artefact_status varchar(255),".
                             " primary key(artefact_id))");
        if (!$q->exec()) {
            return db_error();
        }
        $q->clear();
        return true;
    }

    function removeArtefact(){
        $q = new DBQuery();
        $q->dropTable('artefacts');
        if (!$q->exec()) {
            return db_error();
        }else{
            return true;
        }
    }

    function installAuditors(){
        $q = new DBQuery();
        $q->createTable('auditors');
        $q->createDefinition("(auditor_id integer auto_increment,".
                             " project_id integer not null,".
                             " contact_id integer not null,".
                             " primary key(auditor_id),".
                             " foreign key(project_id) references ".dPgetConfig('dbprefix', '')."projects (project_id),".
                             " foreign key(contact_id) references ".dPgetConfig('dbprefix', '')."contacts (contact_id))");
        if (!$q->exec()) {
            return db_error();
        }
        $q->clear();
        return true;
    }

    function removeAuditors(){
        $q = new DBQuery();
        $q->dropTable('auditors');
        if (!$q->exec()) {
            return db_error();
        }else{
            return true;
        }
    }

    function installAudit() {
        $q = new DBQuery();
        $q->createTable('audits');
        $q->createDefinition("(audit_id integer auto_increment,".
                             " artefact_id integer not null,".
                             " auditor_id integer not null,".
                             " audit_name varchar(255) not null,".
                             " primary key(audit_id),".
                             " foreign key(artefact_id) references ".dPgetConfig('dbprefix', '')."artefacts (artefact_id),".
                             " foreign key(auditor_id) references ".dPgetConfig('dbprefix', '')."auditors (user_id))");
        if (!$q->exec()) {
            return db_error();
        }
        $q->clear();
        return true;
    }

    function removeAudit(){
        $q = new DBQuery();
        $q->dropTable('audits');
        if (!$q->exec()) {
            return db_error();
        }else{
            return true;
        }
    }

    function installChecklist() {
        $q = new DBQuery();
        $q->createTable('checklists');
        $q->createDefinition("(checklist_id integer auto_increment,".
                             " checklist_name varchar(255) not null,".
                             " checklist_description varchar(255),".
                             " checklist_criteria varchar(255),".
                             " audit_id integer not null,".
                             " primary key(checklist_id),".
                             " foreign key(audit_id) references ".dPgetConfig('dbprefix', '')."audits (audit_id))");
        if (!$q->exec()) {
            return db_error();
        }
        $q->clear();
        return true;
    }

    function removeChecklist(){
        $q = new DBQuery();
        $q->dropTable('checklists');
        if (!$q->exec()) {
            return db_error();
        }else{
            return true;
        }
    }

}
?>