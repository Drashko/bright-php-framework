<?php
use src\Utility\H;
use src\Utility\Status;
use src\Utility\Time;

$this->start('body');
$errors   = $data['errors'] ?? [];
$statusList = Status::Project;
$timeList = Time::Task;
?>
<div class="uk-width-large">
    <?php if(isset($errors)){ ?>
        <?php foreach($errors as $error) { ?>
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?=$error?></p>
            </div>
        <?php  } ?>
    <?php  } ?>
    <h2>Task detail #<?=$id?></h2>
    <div class="uk-margin"></div>
    <hr>
    <form class="toggle-class" action="<?=$this->url("admin/task/detail/{$id}")?>" method="post">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= H::out($taskData->getName()) ?>">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Task time</label>
                <select class="uk-select" id="status-select" name="time">
                    <option value="">Choose time</option>
                    <?php foreach($timeList as $key => $value) :?>
                        <option value="<?=$key?>" <?=$key == $taskData->getTime() ? 'selected' : ''?>><?=$value?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Text</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Text" name="text" type="text" value="<?= H::out($taskData->getText()) ?>">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Assignee</label>
                <select class="uk-select" id="status-select" name="user_id">
                    <option value="">Choose user</option>
                    <?php foreach($data['userList'] as $key => $user) :?>
                        <option value="<?=H::out($user->getId())?>" <?=$taskData->getUserId() == $user->getId() ? 'selected' : ''?>><?=H::out($user->getName())?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Project</label>
                <select class="uk-select" id="status-select" name="project_id">
                    <option value="">Choose Project</option>
                    <?php foreach($data['projectList'] as $key => $project) :?>
                        <option value="<?=H::out($project->getId())?>" <?=$taskData->getProjectId() == $project->getId() ? 'selected' : ''?>><?=H::out($project->getName())?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Status</label>
                <select class="uk-select" id="form-stacked-select" name="status">
                    <?php foreach($statusList as $key => $value) :?>
                        <option value="<?=$value['id']?>" <?= ($value['id'] == $taskData->getStatus()) ? 'selected' : ''?>><?=H::out($value['name'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin-bottom">
                <button type="submit"  class="uk-button uk-button-primary uk-border uk-width-1-1">Save</button>
            </div>
        </fieldset>
    </form>
</div>
<?php $this->end()?>
