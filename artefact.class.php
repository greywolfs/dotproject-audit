<?php
if (!defined('DP_BASE_DIR')) {
	die('You should not access this file directly.');
}

/**
 * Artefact Class
 */
class Artefact extends CDpObject {
    var $project_id = NULL;
    var $artefact_id = NULL;
    var $artefact_name = NULL;
    var $artefact_short_description = NULL;
    var $artefact_description = NULL;
    var $artefact_phase = NULL;
    var $artefact_status = NULL;

    function Artefact() {
        $this->CDpObject('artefacts', 'artefact_id');
    }

    function remove($artefact_id){
        $q = new DBQuery();
        $q->setDelete('artefacts');
        $q->addWhere('artefact_id = ' . $artefact_id);
        if (!$q->exec())
            return db_error();
        else
            return null;
    }
}
?>