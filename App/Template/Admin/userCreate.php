<?php $this->start('body')?>
<!-- CONTENT -->
<?php
$errors   = $data['errors'] ?? [];
$statuses   = ['pending' => 'Pending' , 'active' => 'Active' , 'blocked' => 'Blocked'];
$roles      = [ 1 => 'Client' , 2 => 'Customer', 5 => 'Admin'];
?>
<div id="content" class="uk-overflow-container" data-uk-height-viewport="expand: true" >
    <div class="uk-container uk-container-expand">
        <div class="uk-width-large uk-padding-small">
            <?php if(isset($errors)){ ?>
                <?php foreach($errors as $error) { ?>
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p><?=$error?></p>
                    </div>
                <?php  } ?>

            <?php  } ?>
            <h2>Add User</h2>
            <form class="toggle-class" action="<?=$this->url("admin/user/create/")?>" method="post">
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
                            <label class="uk-form-label">Email</label>
                            <input class="uk-input uk-border" required placeholder="Email" name="email" type="email" value="<?=$_POST['email'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <label class="uk-form-label">Address</label>
                            <input class="uk-input uk-border"  placeholder="Address" name="address" type="text" value="<?=$_POST['address'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <label class="uk-form-label">Phone</label>
                            <input class="uk-input uk-border" required placeholder="Phone" name="phone" type="text" value="<?=$_POST['phone'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="uk-margin-small">
                        <div class="uk-inline uk-width-1-1">
                            <label class="uk-form-label">Password</label>
                            <input class="uk-input uk-border" required placeholder="Password" name="password" type="password" value="<?= $_POST['password'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="uk-margin-small">
                        <div class="uk-inline uk-width-1-1">
                            <label class="uk-form-label">Repeat password</label>
                            <input class="uk-input uk-border" required placeholder="Repeat password" name="password_confirm" type="password" value="<?= $_POST['password_confirm'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Status</label>
                        <select class="uk-select" id="form-stacked-select" name="status">
                            <?php foreach($statuses as $key => $value) :?>
                                <option value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Role</label>
                        <select class="uk-select" id="form-stacked-select" name="role_id">
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
    </div>
</div>
<?php $this->end()?>
