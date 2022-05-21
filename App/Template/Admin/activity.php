<?php $this->start('body'); ?>
<!-- CONTENT -->
<?php
use src\Utility\Route;
$errors   = $data['errors'] ?? [];
//TO DO move to config file or table
$statuses = ['pending' => 'Pending' , 'active' => 'Active' , 'blocked' => 'Blocked'];
$roles    = [ 1 => 'Client' , 2 => 'Customer', 5 => 'Admin'];
$page    = $_GET['page'] ?? 1;
$status  = $_GET['status'] ?? '';
$role_id = $_GET['role_id'] ?? '';

$filter  = Route::setFilterParam($_GET);
//pr($this->paginatorPages);
//exit();
?>
<form id="project-list" method="get" class="uk-overflow-auto">
    <h2>Activity List</h2>
    <div class="uk-margin">
        <a href="<?=$this->url("admin/activity/create/")?>" uk-toggle class="uk-button uk-button-secondary uk-button-small" >Add activity</a>
    </div>
    <!--div class="uk-margin uk-left">
        <select class="uk-select uk-width-small uk-form-small" id="role-select" name="role_id">
            <option value="">Choose Role</option>
            <?php foreach($roles as $key => $value) :?>
                <option value="<?=$key?>" <?=$role_id == $key ? 'selected' : ''?>><?=$value?></option>
            <?php endforeach; ?>
        </select>
        <select class="uk-select uk-width-small uk-form-small" id="status-select" name="status">
            <option value="">Choose Status</option>
            <?php foreach($statuses as $key => $value) :?>
                <option value="<?=$key?>" <?=$status == $key ? 'selected' : ''?>><?=$value?></option>
            <?php endforeach; ?>
        </select>
        <button id="button-filter" type="button"  class="uk-button uk-button-primary uk-button-small">Search</button>
    </div-->
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
                <th>Project</th>
                <th>Task</th>
                <th>User</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>CreatedAt</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['activityList']) ){ ?>
                <?php foreach ($data['activityList'] as $activity) : ?>
                    <tr>
                        <td><?=$activity->getId()?></td>
                        <td><?=$activity->getTaskId()?></td>
                        <td><?=$activity->getProjectId()?></td>
                        <td><?=$activity->getUserId()?></td>
                        <td><?=$activity->getName()?></td>
                        <td><?=$activity->getDescription()?></td>
                        <td><?=$activity->getStatus()?></td>
                        <td><?=$activity->getCreatedAt()?></td>
                        <td>
                            <div class="uk-button-group">
                                <button class="uk-button uk-button-small">Actions</button>
                                <div data-uk-dropdown="{mode:'click'}">
                                    <a href="<?=$this->url("admin/activity/detail/{$activity->getId()}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Detail </a>
                                    <a  id="<?=$activity->getId()?>" data-modal="delete"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
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


