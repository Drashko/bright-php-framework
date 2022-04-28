<?php
$errors   = $data['errors'] ?? [];
$statuses   = ['pending' => 'Pending' , 'active' => 'Active' , 'blocked' => 'Blocked'];
$roles      = [ 1 => 'Client' , 2 => 'Customer', 5 => 'Admin'];
?>
<div id="modal-permission-create" uk-modal class="uk-modal">
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default uk-icon uk-close" uk-close type="button"></button>
        <h2>Create permission</h2>
        <div id="errors"></div>
        <form id="permission-create-form"  class="toggle-class">
            <fieldset class="uk-fieldset">
                <div class="uk-margin">
                    <div class="uk-width-1-1">
                        <label class="uk-form-label">Name</label>
                        <div class="uk-form-controls">
                            <input id="name" class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $_POST['name'] ?? '' ?>"><!--?= $userData->getName() ?? '' ?>-->
                        </div>
                    </div>
                    <div class="uk-width-1-1">
                        <label class="uk-form-label">Code</label>
                        <div class="uk-form-controls">
                            <input id="code" class="uk-input uk-border" required placeholder="code" name="code" type="text" value="<?= $_POST['code'] ?? '' ?>"><!--?= $userData->getName() ?? '' ?>-->
                        </div>
                    </div>
                    <div class="uk-width-1-1">
                        <label class="uk-form-label">Description</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea" rows="5" type="textarea" placeholder="Description" name="description"><?= $_POST['description'] ?? '' ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-margin-bottom">
                    <button id="submit" type="submit"  name="submit" class="uk-button uk-button-primary uk-border uk-width-1-1">Save</button>
                </div>
            </fieldset>
        </form>

    </div>
</div>

