<?php $this->start('body'); ?>
<!-- CONTENT -->
<?php

use src\Utility\Lookup;
use src\Utility\Status;

$errors   = $data['errors'] ?? [];
$page    = $_GET['page'] ?? 1;
$status  = $_GET['status'] ?? '';
$project_id = $_GET['project_id'] ?? '';
$user_id = $_GET['user_id'] ?? '';
$task_id = $_GET['task_id'] ?? '';
$statusList = Status::Project;
?>
<form id="project-list" method="get" class="uk-overflow-auto">
    <h2>Activity List</h2>
    <div class="uk-margin">
        <a href="<?=$this->url("admin/activity/create/")?>" uk-toggle class="uk-button uk-button-primary uk-button-small" >Add activity <span uk-icon="icon: plus" class="uk-margin-small-left"></span></a>
    </div>
    <div class="uk-margin uk-left">
        <select class="uk-select uk-width-medium uk-form-small" id="project-select" name="project_id">
            <option value="">Choose Project</option>
            <?php foreach($data['projectList'] as $key => $project) :?>
                <option value="<?=$project->getId()?>" <?=$project_id == $project->getId() ? 'selected' : ''?>><?=$project->getName()?></option>
            <?php endforeach; ?>
        </select>
        <select class="uk-select uk-width-medium uk-form-small" id="task-select" name="task_id">
            <option value="">Choose Task</option>
            <?php foreach($data['taskList'] as $key => $task) :?>
                <option value="<?=$task->getId()?>" <?=$project_id == $task->getId() ? 'selected' : ''?>><?=$task->getName()?></option>
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
        <a href="<?=$this->url('admin/activity/index/')?>" class="uk-button uk-button-danger uk-button-small">Clear</a>
    </div>
    <div class="uk-margin uk-right ">
        <a  id="print" class="uk-button uk-button-default uk-button-small" href="">Print</a>
        <a  href="#modal-pdf" uk-toggle class="uk-button uk-button-default uk-button-small">PDF</a>
        <a  href="#modal-excel" uk-toggle class="uk-button uk-button-default uk-button-small">EXCEL</a>
        <a  href="#modal-csv" uk-toggle class="uk-button uk-button-default uk-button-small">CSV</a>
    </div>
    <hr>
    <div class="table uk-overflow-auto">
        <table class="uk-table uk-table-hover uk-table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Task</th>
                <th>Project</th>
                <th>User</th>
                <th>time</th>
                <th>Status</th>
                <th>CreatedAt</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['activityList']) ){ ?>
                <?php foreach ($data['activityList'] as $activity) : ?>
                    <tr>
                        <td><?=$activity['Id']?></td>
                        <td><?=$activity['name']?></td>
                        <td><?=$activity['description']?></td>
                        <td><?=$activity['taskName']?></td>
                        <td><?=$activity['projectName']?></td>
                        <td><?=$activity['userName']?></td>
                        <td><?=$activity['time']?></td>
                        <td><span class="uk-label uk-label-<?=$activity['status']?>"> <?=Lookup::findIdName($statusList, $activity['status'])?> </span></td>
                        <td><?=$activity['created_at']?></td>
                        <td>
                            <div class="uk-button-group">
                                <button class="uk-button uk-button-small">Actions</button>
                                <div data-uk-dropdown="{mode:'click'}">
                                    <a href="<?=$this->url("admin/activity/detail/{$activity['Id']}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Detail </a>
                                    <a  id="<?=$activity['Id']?>" data-modal="delete-activity"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10" style="text-align:center">No activity found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</form>
<script>
    $('#button-filter').on('click', function() {
        let url = App.baseUrl() + '/admin/activity/index/?';
        //for search filed
        var role_id = $('select[name=\'role_id\']').val();
        if (role_id !== '') {
            url += '&role_id=' + encodeURIComponent(role_id);
        }
        var status = $('select[name=\'status\']').val();
        if (status !== '') {
            url += '&status=' + encodeURIComponent(status);
        }
        location = url;
    });
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


