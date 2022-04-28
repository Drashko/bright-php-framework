<!-- This is the modal -->
<div class="uk-modal-custom">
    <div class="uk-modal-custom-dialog uk-modal-body">
        <button class="uk-modal-close-default close" data-close type="button"></button>
        <p>Do you want to delete this user?</p>
        <p class="uk-text-right">
         <form id="user-delete-form" class="form" method="post" onsubmit=""><!--User.delete();return false;-->
             <input id="user-id" type="hidden" name="delete" value="">
             <button class="uk-button uk-button-default" data-close type="button">Cancel</button>
             <button class="uk-button uk-button-primary" type="submit">Delete</button>
        </form>
        </p>
    </div>
</div>
