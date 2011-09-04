<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

GLOBAL $AppUI, $project_id;
require_once($AppUI->getModuleClass('audit'));

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
                    <th><?= $AppUI->_('Last Name')?></th>
                    <th><?= $AppUI->_('First Name')?></th>
                    <th><?= $AppUI->_('Email')?></th>
                    <th><?= $AppUI->_('Remove')?></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($list as $item){?>
                <tr>
                    <td><?= $item['contact_last_name'] ?></td>
                    <td><?= $item['contact_first_name'] ?></td>
                    <td><?= $item['contact_email'] ?></td>
                    <td><a href="?m=audit&amp;a=delete_audictor&amp;audictor_id=<?= $item['auditor_id'] ?>"><?= $AppUI->_('Remove')?></a></td>
                </tr>
                <? } ?>
            </tbody>
    </table>
<?
}
?>