<?php
use src\Utility\Status;
$errors   = $data['errors'] ?? [];
$statusList   = Status::User;
$rolesList    = Status::Role;
?>
<div id="modal-user-create" uk-modal class="uk-modal">
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default uk-icon uk-close" uk-close type="button"></button>
        <h2>Add user</h2>
        <div id="errors"></div>
        <form id="user-create-form"  class="toggle-class">
            <fieldset class="uk-fieldset">
                <div class="uk-margin">
                    <div class="uk-width-1-1">
                        <label class="uk-form-label">Name</label>
                        <div class="uk-form-controls">
                            <input id="name" class="uk-input uk-border" required placeholder="Name" name="name" type="text" value="<?= $_POST['name'] ?? '' ?>"><!--?= $userData->getName() ?? '' ?>-->
                        </div>
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                        <label class="uk-form-label">Email</label>
                        <input id="email" class="uk-input uk-border"  placeholder="Email" name="email" type="email" value="<?=$_POST['email'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                        <label class="uk-form-label">Address</label>
                        <input id="address" class="uk-input uk-border"  placeholder="Address" name="address" type="text" value="<?=$_POST['address'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                        <label class="uk-form-label">Phone</label>
                        <input id="phone" class="uk-input uk-border"  placeholder="Phone" name="phone" type="text" value="<?=$_POST['phone'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <label class="uk-form-label">Password</label>
                        <input id="password" class="uk-input uk-border"  placeholder="Password" name="password" type="password" value="<?= $_POST['password'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline uk-width-1-1">
                        <label class="uk-form-label">Repeat password</label>
                        <input id="password_confirm" class="uk-input uk-border"  placeholder="Repeat password" name="password_confirm" type="password" value="<?= $_POST['password_confirm'] ?? '' ?>">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label">Status</label>
                    <select  class="uk-select" id="status" name="status">
                        <?php foreach($statusList as $key => $value) :?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="uk-margin">
                    <label  class="uk-form-label">Role</label>
                    <select class="uk-select" id="role_id" name="role_id">
                        <?php foreach($rolesList as $key => $value) :?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="uk-margin-bottom">
                    <button id="submit" type="submit"  name="submit" class="uk-button uk-button-primary uk-border uk-width-1-1">Save</button>
                </div>
            </fieldset>
        </form>

    </div>
</div>

