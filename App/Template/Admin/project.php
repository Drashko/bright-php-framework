<?php $this->start('body');

use src\Utility\Lookup;
use src\Utility\Status;
$statusList   = Status::Project;
$page    = $_GET['page'] ?? 1;
$status  = $_GET['status'] ?? '';
$role_id = $_GET['role_id'] ?? '';
?>
<form id="project-list" method="get" action="<?=$this->url('admin/project/index/')?>" class="uk-overflow-auto">
    <h2>Project List</h2>
    <div class="uk-margin">
        <a href="<?=$this->url("admin/project/create/")?>" uk-toggle class="uk-button uk-button-primary  uk-button-small" >Add project<span uk-icon="icon: plus" class="uk-margin-small-left"></span></a>
    </div>
    <div class="uk-margin uk-left">
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
                <th>Manager</th>
                <th>Client</th>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>CreatedAt</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['projectList']) ){ ?>
                <?php foreach ($data['projectList'] as $project) : ?>
                    <tr>
                        <td><?=$project['Id']?></td>
                        <td><?=$project['managerName']?></td>
                        <td><?=$project['clientName']?></td>
                        <td><?=$project['name']?></td>
                        <td><?=$project['description']?></td>
                        <td><?=$project['start_date']?></td>
                        <td><?=$project['end_date']?></td>
                        <td><span class="uk-label uk-label-<?=$project['status']?>"> <?=Lookup::findIdName($statusList, $project['status'])?> </span></td>
                        <td><?=$project['created_at']?></td>
                        <td>
                            <div class="uk-button-group">
                                <button class="uk-button uk-button-small">Actions</button>
                                <div data-uk-dropdown="{mode:'click'}">
                                    <a href="<?=$this->url("admin/project/detail/{$project['Id']}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Detail </a>
                                    <a  id="<?=$project['Id']?>" data-modal="delete-project"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10" style="text-align:center">No project found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</form>
<!--user-create modal popup-->
<?php $this->partial('Admin', 'modalUserCreate')?>
<!--export pdf  modal popup-->
<?php $this->partial('Admin', 'modalPdf')?>
<!--export excel  modal popup-->
<?php $this->partial('Admin', 'modalExcel')?>
<!--export csv  modal popup-->
<?php $this->partial('Admin', 'modalCsv')?>
<?php $this->end()?>


