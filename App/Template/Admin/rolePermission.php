<?php $this->start('body')?>
<!-- CONTENT -->
<?php
$roleList = $roleList ?? [];
$rolePermissionList = $rolePermissionList ?? [];
//pr($rolePermissionList);
?>
<div id="message"></div>
<h2>Role/Permission list</h2>
<hr>
<div class="uk-overflow-auto">
    <form id="rolePermission-filter"  method="GET">
        <div class="uk-margin uk-left">
            <label  class="uk-form-label"></label>
            <select class="uk-select uk-width-medium uk-form-small" id="role_id" name="role_id">
                <option value="">Choose Role</option>
                <?php foreach($roleList as $role) :?>
                    <option value="<?=$role->getId()?>" <?=isset($_GET['role_id']) && !empty($_GET['role_id'] == $role->getId()) ? "selected='selected'" : ""?>><?=$role->getName()?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit"  class="uk-button uk-button-primary uk-button-small">Select</button>
        </div>
    </form>
    <?php if(!empty($_GET['role_id'])) { ?>
        <div>
            <form id="rolePermission-formList" action="" method="POST">
                <input type="hidden" name="role_id" value="<?= $_GET['role_id'] ?>">
                <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                    <thead><tr><th class="uk-width-small">Id</th><th class="uk-width-small">Name</th><th class="uk-width-small">Code</th><th class="uk-width-large">Description</th></tr></thead>
                    <tbody>
    <?php foreach($rolePermissionList as $roleName => $permissionList) : ?>
                        <tr>
                            <td colspan="4"><b><?=$roleName?></b></td>
                        </tr>
            <?php foreach ($permissionList as $key => $value) : ?>
                        <tr>
                           <td><?=$value['id']?></td>
                           <td>
                               <label><input class="uk-checkbox" type="checkbox" name="permission[]" value="<?=$value['id']?>" <?=(isset($value['role_id'])) ? 'checked' : '' ?>> <?= $value['name']?> </label>
                           </td>
                           <td><?=$value['code']?></td>
                           <td>
                               <?=$value['description']?>
                           </td>
                       </tr>
            <?php endforeach;?>
    <?php endforeach;?>
                    </tbody>
                </table>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-small" type="submit">Save</button>
                </div>
            </form>
        </div>
    <?php } else { ?>
        <div class="uk-width-large" style="clear: both;"><h4 style="padding-top:20px;">Please select an option from the select box</h4></div>
    <?php }?>
</div>

<script>
    const form = roleCreateForm = jQuery('#rolePermission-formList');
    form.submit(function(e){
        e.preventDefault();
        $.ajax({
            url: App.baseUrl() + 'admin/rolePermission/assign/',
            type: 'POST',
            data : $(this).serialize(),
            success : function(resp){
                if(resp.success === true){
                   let success = '<div class="uk-alert-success" uk-alert><a class="uk-alert-close" uk-close></a><p>The role permission list has been successfully updated!</p></div>';
                    $('#message').html(success);
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                   //alert("The role permission list has been successfully updated!");
                }else{
                    let errors = '';
                    if(resp.errors !== undefined)
                        resp.errors.forEach(function(msg){
                            errors += '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' + msg + '</p></div>';
                        });
                    $('#message').html(errors);
                }
            }
        });
    });
</script>
<?php $this->end()?>
