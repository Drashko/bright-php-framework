<?php $this->start('body');

use src\Utility\Lookup;
use src\Utility\Status;
$page    = $_GET['page'] ?? 1;
$status  = $_GET['status'] ?? '';
$user_id = $_GET['user_id'] ?? '';
$project_id = $_GET['project_id'] ?? '';
$statusList = Status::Project;
?>
<form id="project-list" method="get" class="uk-overflow-auto">
    <h2>Task List</h2>
    <div class="uk-margin">
        <a href="<?=$this->url("admin/task/create/")?>" uk-toggle class="uk-button uk-button-primary uk-button-small" >Add task <span uk-icon="icon: plus" class="uk-margin-small-left"></span></a>
    </div>
    <div class="uk-margin uk-left">
        <select class="uk-select uk-width-medium uk-form-small" id="project-select" name="project_id">
            <option value="">Choose Project</option>
            <?php foreach($data['projectList'] as $key => $project) :?>
                <option value="<?=$project->getId()?>" <?=$project_id == $project->getId() ? 'selected' : ''?>><?=$project->getName()?></option>
            <?php endforeach; ?>
        </select>
        <select class="uk-select uk-width-small uk-form-small" id="user-select" name="user_id">
            <option value="">Choose User</option>
            <?php foreach($data['userList'] as $key => $user) :?>
                <option value="<?=$user->getId()?>" <?=$user_id == $user->getId() ? 'selected' : ''?>><?=$user->getName()?></option>
            <?php endforeach; ?>
        </select>
    <select class="uk-select uk-width-small uk-form-small" id="status-select" name="status">
            <option value="">Choose Status</option>
            <?php foreach($statusList as $key => $value) :?>
                <option value="<?=$value['id']?>" <?=$status == $value['id'] ? 'selected' : ''?>><?=$value['name']?></option>
            <?php endforeach; ?>
        </select>
        <button id="button-filter" type="submit"  class="uk-button uk-button-primary uk-button-small">Search</button>
    </div>
    <div class="uk-margin uk-right ">
        <a  id="print" class="uk-button uk-button-default uk-button-small" href="">Print</a>
        <a  href="#modal-pdf" uk-toggle class="uk-button uk-button-default uk-button-small">PDF</a>
        <a  href="#modal-excel" uk-toggle class="uk-button uk-button-default uk-button-small">EXCEL</a>
        <a  href="#modal-csv" uk-toggle class="uk-button uk-button-default uk-button-small">CSV</a>
    </div>
    <hr>
    <div class="uk-overflow-container">
        <table class="uk-table uk-table-hover uk-table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Text</th>
                <th>Project</th>
                <th>User</th>
                <th>Time</th>
                <th>Status</th>
                <th>CreatedAt</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['taskList']) ){ ?>
                <?php foreach ($data['taskList'] as $task) : ?>
                    <tr>
                        <td><?=$task['Id']?></td>
                        <td><?=$task['name']?></td>
                        <td><?=$task['text']?></td>
                        <td><?=$task['projectName']?></td>
                        <td><?=$task['userName']?></td>
                        <td><?=$task['time']?></td>
                        <td><span class="uk-label uk-label-<?=$task['status']?>"> <?=Lookup::findIdName($statusList, $task['status'])?> </span></td>

                        <td><?=$task['created_at']?></td>
                        <td>
                            <div class="uk-button-group">
                                <button class="uk-button uk-button-small">Actions</button>
                                <div data-uk-dropdown="{mode:'click'}">
                                    <a href="<?=$this->url("admin/task/detail/{$task['Id']}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Detail </a>
                                    <a  id="<?=$task['Id']?>" data-modal="delete-task"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10" style="text-align:center">No task found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</form>
<script>
</script>
<!--user-create modal popup-->
<?php $this->partial('Admin', 'modalUserCreate')?>
<!--export pdf  modal popup-->
<?php $this->partial('Admin', 'modalPdf')?>
<!--export excel  modal popup-->
<?php $this->partial('Admin', 'modalExcel')?>
<!--export csv  modal popup-->
<?php $this->partial('Admin', 'modalCsv')?>
<?php $this->end()?>


