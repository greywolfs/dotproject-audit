<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

GLOBAL $AppUI, $project_id;
require_once($AppUI->getModuleClass('audit'));

$auditor_id = intval(dPgetParam($_GET, 'auditor_id', 0));

if($auditor_id){
   if (getPermission('audit', 'delete')){
       if($auditor_id){
            $obj_auditor = new Auditor();
           // nao esta utilizando o delete de API do DP que seria
           // $obj_auditor->delete($auditor_id);
            $obj_auditor->remove($auditor_id);
        }

    }
}


if (getPermission('audit', 'view')) {
    $a = new Auditor();
    $list = $a->loadAll();
    if (getPermission('audit', 'add')){ ?>
        <table class="std" width="100%">
            <tbody>
                <tr>
                    <td align="right"><a href="?m=audit&amp;a=add_auditor&amp;project_id=<?php echo $project_id; ?>"><?php echo $AppUI->_('Add');?></a></td>
                </tr>
            </tbody>
        </table>
<?php  } ?>
    <table class="tbl" width="100%">
            <thead>
                <tr>
                    <th><?php echo $AppUI->_('Last Name');?></th>
                    <th><?php echo $AppUI->_('First Name');?></th>
                    <th><?php echo $AppUI->_('Email');?></th>
                    <th><?php echo $AppUI->_('Remove');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $item){?>
                <tr>
                    <td><?php echo $item['contact_last_name']; ?></td>
                    <td><?php echo $item['contact_first_name']; ?></td>
                    <td><?php echo $item['contact_email']; ?></td>
                    <td><a href="?m=projects&amp;a=view&amp;project_id=<?php echo $project_id; ?>&amp;tab=5&amp;auditor_id=<?php echo $item['auditor_id']; ?>"><?php echo $AppUI->_('Remove');?></a></td>
                </tr>
                <?php } ?>
            </tbody>
    </table>
<?php
}
?>