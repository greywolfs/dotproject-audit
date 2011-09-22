<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

$project_id = intval(dPgetParam($_GET, 'project_id', 0));
$name = dPgetParam($_POST, 'name', 0);
$phase = dPgetParam($_POST, 'phase', 0);
$short_description = dPgetParam($_POST, 'short_description', 0);
$detailed_description = dPgetParam($_POST, 'detail_description', 0);

require_once($AppUI->getModuleClass('audit'));

if($name&&$phase&&$short_description&&$detailed_description){
        $a = new Artefact();
        $a->bind(array(NULL, 'project_id' => $project_id, 'artefact_name' => $name, 'artefact_phase' => $phase, 'artefact_short_description' => $short_description, 'artefact_description' => $detailed_description, 'artefact_status' => "proposto"));
        if($a->store()==NULL){
            echo "Artefact " . $name ." added!";
        }else{
            echo $a->store();
        }
}

//setup the title block
$titleBlock = new CTitleBlock('Add Auditors');
$titleBlock->show();
?>

<html>
    <body>
        <form action="?m=audit&a=add_artefact&project_id=<?php echo $project_id ?>" method="post">
            Name : <input type="text" name="name"><br>
            Phase : <input type="text" name="phase"><br>
            Short Description : <input type="text" name="short_description"><br>
            Detailed Description : <textarea name="detail_description"></textarea><br>
            <input type="button" value="Back" onclick="history.go(-1)" class="button" >
            <input type="submit" value="Add" class="button" >
        </form>
    </body>
</html>