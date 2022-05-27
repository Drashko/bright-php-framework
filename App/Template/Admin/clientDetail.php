<?php
use src\Utility\H;
use src\Utility\Status;

$this->start('body');
$errors   = $data['errors'] ?? [];
$statusList = Status::User;
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
    <h2>Client detail #<?=$id?></h2>
    <div class="uk-margin"></div>
    <hr>
    <form class="toggle-class" action="<?=$this->url("admin/client/detail/{$id}")?>" method="post">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?=H::out($clientData->getName())?>">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Email" name="email" type="text" value="<?= H::out($clientData->getEmail()) ?>">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Phone</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Phone" name="phone" type="text" value="<?= H::out($clientData->getPhone()) ?>">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Vat</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Vat" name="vat" type="text" value="<?= H::out($clientData->getVat()) ?>">
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Client</label>
                <select class="uk-select" id="form-stacked-select" name="status">
                    <?php foreach($statusList as $key => $value) :?>
                        <option value="<?=$value['id']?>" <?= ($value['id'] == $clientData->getStatus()) ? 'selected' : ''?>><?=H::out($value['name'])?></option>
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
