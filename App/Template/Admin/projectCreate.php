<?php $this->start('body');
use src\Utility\Status;
use src\Utility\H;
$errors       = $data['errors'] ?? [];
$statusList   = Status::Project;;
$data         = H::cleanOut($_POST);
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
    <h2>Add project</h2>
    <div class="uk-margin"></div>
    <hr>
    <form class="toggle-class" action="<?=$this->url("admin/project/create/")?>" method="post">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <div class="uk-width-1-1">
                    <label class="uk-form-label">Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $data['name'] ?? '' ?>"><!--?= $userData->getName() ?? '' ?>-->
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                    <label class="uk-form-label">Description</label>
                    <textarea rows="5" class="uk-border uk-textarea" required placeholder="Description" name="description"><?=$data['description'] ?? '' ?> </textarea>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">Status</label>
                <select class="uk-select" id="form-stacked-select" name="status">
                    <?php foreach($statusList as $key => $value) :?>
                        <option value="<?=$value['id']?>"><?=H::out($value['name'])?></option>
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
