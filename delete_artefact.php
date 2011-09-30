<?php
$artefact_id = intval(dPgetParam($_GET, 'artefact_id', 0));
$project_id = intval(dPgetParam($_GET, 'project_id', 0));

if($artefact_id && getPermission('audit', 'delete')){
    $artefact = new Artefact();
    $artefact->delete($artefact_id);
    $AppUI->redirect('m=projects&a=view&project_id='.$project_id.'&tab='.$AppUI->getState('ProjVwTab'));
}
?>
