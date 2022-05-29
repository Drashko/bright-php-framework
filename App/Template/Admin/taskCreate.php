<?php $this->start('body');
use src\Utility\Status;
use src\Utility\H;
use src\Utility\Time;

$errors       = $data['errors'] ?? [];
$statusList   = Status::Project;;
$dataClean    = H::cleanOut($_POST);
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
    <h2>Add task</h2>
    <div class="uk-margin"></div>
    <hr>
    <form class="toggle-class" action="<?=$this->url("admin/task/create/")?>"  method="post">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $dataClean['name'] ?? '' ?>"><!--?= $userData->getName() ?? '' ?>-->
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Task time</label>
                <select class="uk-select" id="time-select" name="time" required>
                    <option value="">Choose time</option>
                    <?php foreach($timeList as $key => $value) :?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Text</label>
                <textarea rows="5" class="uk-border uk-textarea" required placeholder="Description" name="text"><?=$dataClean['text'] ?? '' ?> </textarea>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Assignee</label>
                <select class="uk-select" id="status-select" name="user_id" required>
                    <option value="">Choose user</option>
                    <?php foreach($data['userList'] as $key => $user) :?>
                        <option value="<?=H::out($user->getId())?>" <?=$user->getId() ? 'selected' : ''?>><?=H::out($user->getName())?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Project</label>
                <select class="uk-select" id="status-select" name="project_id" required>
                    <option value="">Choose Project</option>
                    <?php foreach($data['projectList'] as $key => $project) :?>
                        <option value="<?=H::out($project->getId())?>" <?=$project->getId() ? 'selected' : ''?>><?=H::out($project->getName())?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Status</label>
                <select class="uk-select" id="form-stacked-select" name="status" required>
                    <?php foreach($statusList as $key => $value) :?>
                        <option value="<?=$value['id']?>"><?=H::out($value['name'])?></option>
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
