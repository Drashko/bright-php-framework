<?php $this->start('body'); ?>
<!-- CONTENT -->
<?php
use src\Utility\Route;
$errors   = $data['errors'] ?? [];
//TO DO move to config file or table
?>
<form id="project-list" method="get" class="uk-overflow-auto">
    <h2>Client List</h2>
    <div class="uk-margin">
        <a href="<?=$this->url("admin/client/create/")?>" uk-toggle class="uk-button uk-button-primary uk-button-small" >Add client <span uk-icon="icon: plus" class="uk-margin-small-left"></span></a>
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
                <th>Owner</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Vat</th>
                <th>Status</th>
                <th>CreatedAt</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['clientList']) ){ ?>
                <?php foreach ($data['clientList'] as $client) : ?>
                    <tr>
                        <td><?=$client->getId()?></td>
                        <td><?=$client->getOwnerId()?></td>
                        <td><?=$client->getName()?></td>
                        <td><?=$client->getEmail()?></td>
                        <td><?=$client->getPhone()?></td>
                        <td><?=$client->getVat()?></td>
                        <td><?=$client->getStatus()?></td>
                        <td><?=$client->getCreatedAt()?></td>
                        <td>
                            <div class="uk-button-group">
                                <button class="uk-button uk-button-small">Actions</button>
                                <div data-uk-dropdown="{mode:'click'}">
                                    <a href="<?=$this->url("admin/client/detail/{$client->getId()}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Detail </a>
                                    <a  id="<?=$client->getId()?>" data-modal="delete-client"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10" style="text-align:center">No client found</td>
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


