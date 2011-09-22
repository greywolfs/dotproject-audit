<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

GLOBAL $AppUI, $project_id;
require_once($AppUI->getModuleClass('audit'));


$artefact_id = intval(dPgetParam($_GET, 'artefact_id', 0));

if($artefact_id){
   if (getPermission('audit', 'delete')){
       if($artefact_id){
            $obj_artefact = new Artefact();
           // nao esta utilizando o delete de API do DP que seria
           // $obj_auditor->delete($auditor_id);
            $obj_artefact->remove($artefact_id);
        }

    }
}

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
                    <td><a href="?m=projects&amp;a=view&amp;project_id=<?php echo $project_id; ?>&amp;tab=5&amp;artefact_id=<?php echo $item['artefact_id']; ?>"><?php echo $AppUI->_('Remove');?></a></td>
                </tr>
                <?php } ?>
            </tbody>
    </table>
<?php
}
?>