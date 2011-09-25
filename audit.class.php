<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

require_once $AppUI->getSystemClass('dp');

require_once DP_BASE_DIR.'/modules/audit/artefact.class.php';
require_once DP_BASE_DIR.'/modules/audit/auditor.class.php';
require_once DP_BASE_DIR.'/modules/audit/cproject.class.php';
require_once DP_BASE_DIR.'/modules/audit/checklist.class.php';

/**
 * Audit Class
 */
class Audit extends CDpObject {

    function doStuff() {
        return true;
    }
}
?>