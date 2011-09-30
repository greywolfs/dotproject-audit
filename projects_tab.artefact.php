<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

GLOBAL $AppUI, $project_id;

require_once($AppUI->getModuleClass('audit'));

if (getPermission('audit', 'view')) {
    $a = new Artefact();
    $list = $a->loadAll();
    if (getPermission('audit', 'add')){ ?>
        <table class="std" width="100%">
            <tbody>
                <tr>
                    <td align="right"><a href="?m=audit&amp;a=add_artefact&amp;project_id=<?php echo $project_id; ?>"><?php echo $AppUI->_('Add');?></a></td>
                </tr>
            </tbody>
        </table>
<?php  } ?>
    <table class="tbl" width="100%">
            <thead>
                <tr>
                    <th><?php echo $AppUI->_('Name');?></th>
                    <th><?php echo $AppUI->_('Short Description');?></th>
                    <th><?php echo $AppUI->_('Remove');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $item){?>
                <tr>
                    <td><?php echo $item['artefact_name']; ?></td>
                    <td><?php echo $item['artefact_short_description']; ?></td>
                    <td><a href="?m=audit&amp;a=delete_artefact&amp;artefact_id=<?php echo $item['artefact_id']; ?>&amp;project_id=<?php echo $project_id; ?>"><?php echo $AppUI->_('Remove');?></a></td>
                </tr>
                <?php } ?>
            </tbody>
    </table>
<?php
}
?>