<?php $this->start('body')?>
    <!-- CONTENT -->
<?php
$messageData  = $data['messageData'];
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
        <h2>Update message</h2>
        <form class="toggle-class" action="<?=$this->url("admin/message/update/{$id}")?>" method="post">
            <fieldset class="uk-fieldset">
                <div class="uk-margin">
                    <div class="uk-width-1-1">
                        <label class="uk-form-label">Name</label>
                        <div class="uk-form-controls">
                            <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?=$messageData->getName()?>"><!--?= $userData->getName() ?? '' ?>-->
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