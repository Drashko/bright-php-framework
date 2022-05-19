<?php $this->start('body'); ?>
<!-- CONTENT -->
<?php
$errors   = $data['errors'] ?? [];
$statuses   = ['pending' => 'Pending' , 'active' => 'Active' , 'blocked' => 'Blocked'];
$roles      = [ 1 => 'Client' , 2 => 'Customer', 5 => 'Admin'];
?>
<h2>Add Project</h2>
<br>
<hr>
<div class="uk-width-large uk-padding-small">
    <?php if(isset($errors)){ ?>
        <?php foreach($errors as $error) { ?>
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?=$error?></p>
            </div>
        <?php  } ?>

    <?php  } ?>
    <form class="toggle-class" action="<?=$this->url("admin/client/create/")?>" method="post">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $_POST['name'] ?? '' ?>"><!--?= $userData->getName() ?? '' ?>-->
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-inline uk-width-1-1">
                    <label class="uk-form-label">Description</label>
                    <textarea rows="5" class="uk-input uk-border uk-textarea" required placeholder="Description" name="description" type="textarea"><?=$_POST['description'] ?? '' ?> </textarea>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Client</label>
                <select class="uk-select" id="form-stacked-select" name="">
                    <?php foreach($statuses as $key => $value) :?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Manager</label>
                <select class="uk-select" id="form-stacked-select" name="">
                    <?php foreach($roles as $key => $value) :?>
                        <option value="<?=$key?>"><?=$value?></option>
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
