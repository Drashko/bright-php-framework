<?php $this->start('body')?>
<!-- CONTENT -->
<?php
$errors   = $data['errors'] ?? [];
?>
<form method="get">
    <h2>Git commands list</h2>
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
            <th >Name</th><th>Command</th><!--th>CreatedAt</th--><!--th>Actions</th-->
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($gitList)) { ?>
            <?php foreach ($gitList as $git) : ?>
                <?php if(!empty($git->getTitle())) : ?>
                   <tr>
                       <td class="uk-text-primary uk-text-bold" colspan="6"><?=$git->getTitle()?></td>
                   </tr>
                <?php endif; ?>
                <tr>
                    <td><?=$git->getDescription()?></td>
                    <td class="uk-text-warning"><?=$git->getExample()?></td>
                    <!--td><?=$git->getCreatedAt()?></td-->
                    <!--td>
                        <div class="uk-button-group">
                            <button class="uk-button uk-button-small">Actions</button>
                            <div data-uk-dropdown="{mode:'click'}">
                                <a href="<?=$this->url("admin/message/update/{$git->getId()}")?>" class="uk-button uk-button-small"><span data-uk-icon="icon: refresh" class="uk-margin-small-right uk-icon"></span> Update </a>
                                <a  id="<?=$git->getId()?>" data-modal="delete-message"  class="uk-button uk-button-small "><span data-uk-icon="icon: trash" class="uk-margin-small-right uk-icon"></span> Delete </a>
                            </div>
                        </div>
                    </td-->
                </tr>
            <?php endforeach; ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" style="text-align:center">No Messages found</td>
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
