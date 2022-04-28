<?php $this->start('body')?>
<!-- CONTENT -->
<?php
$roleList = $roleList ?? [];
$rolePermissionList = $rolePermissionList ?? [];
?>
<h2>Role/Permission list</h2>
<hr>
<div class="uk-overflow-auto">
    <form id="rolePermission-filter"  method="POST">
        <div class="uk-margin uk-left">
            <label  class="uk-form-label"></label>
            <select class="uk-select uk-width-medium uk-form-small" id="role_id" name="role_id">
                <option value="">Choose Role</option>
                <?php foreach($roleList as $role) :?>
                    <option value="<?=$role->getId()?>" <?=isset($_POST['role_id']) && !empty($_POST['role_id'] == $role->getId()) ? "selected='selected'" : ""?>><?=$role->getName()?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit"  class="uk-button uk-button-primary uk-button-small">Select</button>
        </div>
    </form>
    <?php if(!empty($_POST['role_id'])) { ?>
        <div>
            <form id="rolePermission-formList" action="" method="post">
                <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                    <thead><tr><th class="uk-width-small">Id</th><th class="uk-width-small">Code</th><th>Name</th><th class="uk-width-large">Description</th></tr></thead>
                    <tbody>
            <?php foreach ($rolePermissionList as $key => $value) : ?>
                       <tr>
                           <td><?=$value['Id']?></td>
                           <td><?=$value['code']?></td>
                           <td>
                               <label><input class="uk-checkbox" type="checkbox" name="permission[]" value="<?=$value['Id']?>" <?=(isset($value['roleId'])) ? 'checked' : '' ?>> <?= $value['permissionName']?> </label>
                           </td>
                           <td>
                               <?=$value['description']?>
                           </td>
                       </tr>
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
                    alert(resp);
                }else{
                    let errors = '';
                    if(resp.errors !== undefined)
                        resp.errors.forEach(function(msg){
                            errors += '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' + msg + '</p></div>';
                        });
                    $('#errors').html(errors);
                }
            }
        });
    });
</script>
<?php $this->end()?>
