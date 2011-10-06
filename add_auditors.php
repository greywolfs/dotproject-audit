<?php
if (!defined('DP_BASE_DIR')) {
    die('You should not access this file directly.');
}

$project_id = dPgetParam($_GET, 'project_id', 0);
$auditors = dPgetParam($_POST, 'auditors', 0);

require_once($AppUI->getModuleClass('audit'));
require_once($AppUI->getModuleClass('contacts'));
require_once($AppUI->getModuleClass('projects'));
require_once($AppUI->getSystemClass('libmail'));

if($auditors){
    $project = new CProject();
    $project->load($project_id);
    foreach($auditors as $auditor){
        $a = new Auditor();
        $a->bind(array('project_id' => $project_id, 'contact_id' => $auditor));
        if($a->store() == NULL){
            $a->setMail();
            $a->mail->Subject("[DotProject] Auditor");
            $a->mail->Body("You have been chosen as auditor on project ". $project->project_name);
            $a->mail->Send();
        }
    }
    $AppUI->redirect('m=projects&a=view&project_id='.$project_id.'&tab='.$AppUI->getState('ProjVwTab'));
}

//setup the title block
$titleBlock = new CTitleBlock('Add Auditors');
$titleBlock->show();

$p = new CProjectAudit();
$c = new CContact();
$list = $c->loadAll();
?>

<form name="add_auditors" action="?m=audit&a=add_auditors&amp;project_id=<?php echo $project_id; ?>" method="post">
    <table cellspacing="0" cellpadding="4" border="0" width="100%" class="std">
        <thead>
            <tr>
                <th valign="top"><strong><?php echo $AppUI->_('Add'); ?></strong></th>
                <th valign="top"><strong><?php echo $AppUI->_('Last Name'); ?></strong></th>
                <th valign="top"><strong><?php echo $AppUI->_('First Name'); ?></strong></th>
                <th valign="top"><strong><?php echo $AppUI->_('Email'); ?></strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $item){ ?>
                <?php if(!$p->isAuditor($project_id, $item['contact_id'])){ ?>
                    <tr>
                        <td><input type="checkbox" name="auditors[]" value="<?php echo $item['contact_id'];?>" /></td>
                        <td><?php echo $item['contact_last_name']; ?></td>
                        <td><?php echo $item['contact_first_name']; ?></td>
                        <td><?php echo $item['contact_email']; ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <input type="button" value="<?php echo $AppUI->_('back');?>" onclick="history.go(-1)" class="button" />
    <input type="submit" value="<?php echo $AppUI->_('submit') ?>" class="button" />
</form>