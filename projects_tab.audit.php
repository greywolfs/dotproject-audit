<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

GLOBAL $AppUI, $project_id, $task_id, $deny, $canRead, $canEdit, $dPconfig, $cfObj, $m, $obj;
require_once($AppUI->getModuleClass('audit'));

global $allowed_folders_ary, $denied_folders_ary, $limited;

$cfObj = new CFileFolder();
$allowed_folders_ary = $cfObj->getAllowedRecords($AppUI->user_id);
$denied_folders_ary = $cfObj->getDeniedRecords($AppUI->user_id);

$limited = ((count($allowed_folders_ary) < $cfObj->countFolders()) ? true : false);

if (!$limited) {
    $canEdit = true;
} else if ($limited && array_key_exists($folder, $allowed_folders_ary)) {
    $canEdit = true;
} else {
    $canEdit = false;
}

$showProject = false;

if (getPermission('audit', 'view')) {
    $a = new Auditor();
    $list = $a->loadAll(); ?>

    <table class="std" width="100%">
        <tbody>
            <tr>
                <td align="right"><a href="?m=audit&amp;a=add_audictor&amp;project_id=<?= $project_id ?>"><?= $AppUI->_('Add')?></a></td>
            </tr>
        </tbody>
    </table>
    <table class="tbl" width="100%">
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($list as $item){?>
                <tr>
                    <td><?= $item['contact_last_name'] ?></td>
                    <td><?= $item['contact_first_name'] ?></td>
                    <td><?= $item['contact_email'] ?></td>
                    <td><a href="?m=audit&amp;a=delete_audictor&amp;audictor_id=<?= $item['auditor_id'] ?>"><?= $AppUI->_('Delete')?></a></td>
                </tr>
                <? } ?>
            </tbody>
    </table>
<?
}
?>