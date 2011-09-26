<?php
$auditor_id = intval(dPgetParam($_GET, 'auditor_id', 0));
$project_id = intval(dPgetParam($_GET, 'project_id', 0));

if($auditor_id && getPermission('audit', 'delete')){
    $auditor = new Auditor();
    $auditor->delete($auditor_id);
    $AppUI->redirect('m=projects&a=view&project_id='.$project_id.'&tab='.$AppUI->getState('ProjVwTab'));
}
?>