<?php $this->start('body')?>
    <!-- CONTENT -->
<?php
$permissionData  = $data['permissionData'];
$errors    = $data['errors']['errors'] ?? [];
?>
 <div class="uk-width-large uk-padding-small">
    <?php if(isset($errors)){ ?>
        <?php foreach($errors as $error) { ?>
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?=$error?></p>
            </div>
        <?php  } ?>
    <?php  } ?>
    <h2>Update role</h2>
    <form class="toggle-class" action="<?=$this->url("admin/permission/update/{$id}")?>" method="post">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?=$permissionData->getName()?>"><!--?= $userData->getName() ?? '' ?>-->
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Code</label>
                    <div class="uk-form-controls">
                        <input id="code" class="uk-input uk-border" required placeholder="code" name="code" type="text" value="<?=$permissionData->getCode()?>"><!--?= $userData->getName() ?? '' ?>-->
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                    <div class="uk-width-1-1">
                        <label class="uk-form-label">Description</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea" rows="5" type="textarea" placeholder="Description" name="description"><?=$permissionData->getDescription()?></textarea>
                        </div>
                    </div>
            </div>

            <div class="uk-margin-bottom">
                <button type="submit"  class="uk-button uk-button-primary uk-border uk-width-1-1">Save</button>
            </div>
        </fieldset>
    </form>
  </div>
<?php $this->end()?>