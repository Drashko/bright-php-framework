<?php $this->start('body')?>
<!-- CONTENT -->
<?php
$errors   = $data['errors'] ?? [];
?>
        <form method="get">
            <h2>Permission List</h2>
            <div class="uk-margin">
                <a href="#modal-permission-create" uk-toggle class="uk-button uk-button-secondary uk-button-small" >Create Permission</a>
            </div>
            <div class="uk-margin uk-right">
                <a  id="print" class="uk-button uk-button-default uk-button-small" href="">Print</a>
                <a  href="#modal-pdf" uk-toggle class="uk-button uk-button-default uk-button-small">PDF</a>
                <a  href="#modal-excel" uk-toggle class="uk-button uk-button-default uk-button-small">EXCEL</a>
                <a  href="#modal-csv" uk-toggle class="uk-button uk-button-default uk-button-small">CSV</a>
            </div>
            <hr>
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Code</th><th>Description</th><th>CreatedAt</th><th>UpdatedAt</th><th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($permissionList)) { ?>
                    <?php foreach ($permissionList as $permission) : ?>
                        <tr>
                            <td><?=$permission->getId()?></td>
                            <td><?=$permission->getName()?></td>
                            <td><?=$permission->getCode()?></td>
                            <td><?=$permission->getDescription()?></td>
                            <td><?=$permission->getCreatedAt()?></td>
                            <td><?=$permission->getUpdatedAt()?></td>
                            <td>
                                <div class="uk-button-group">
                                    <button class="uk-button uk-button-small">Actions</button>
                                    <div data-uk-dropdown="{mode:'click'}">
                                        <a href="<?=$this->url("admin/permission/update/{$permission->getId()}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Update </a>
                                        <a  id="<?=$permission->getId()?>" data-modal="delete-permission"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" style="text-align:center">No Permissions found</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
<!--user-create modal popup-->
<?php $this->partial('Admin', 'modalPermissionCreate')?>
<!--export pdf  modal popup-->
<?php $this->partial('Admin', 'modalPdf')?>
<!--export excel  modal popup-->
<?php $this->partial('Admin', 'modalExcel')?>
<!--export csv  modal popup-->
<?php $this->partial('Admin', 'modalCsv')?>
<?php $this->end()?>
