const User = {
    'modalList' : '',
    'userCreateForm' : ''
}
User.init = function(){
    this.modalList = document.querySelectorAll('[data-modal="delete"]');
    this.delete();
    this.create();
}
User.delete = function(){
    this.modalList.forEach(function (el){
        el.addEventListener('click', function (e){
            let id = e.target.id;
            if(confirm('Do you want to delete this user?')){
                $.ajax({
                    url: App.baseUrl() + 'admin/user/delete/' + id,
                    type: 'POST',
                    data : { id : id },
                    success : function(resp){
                        if(resp.success){
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
}
User.create = function(){
    this.userCreateForm = jQuery('#user-create-form');
    this.userCreateForm.submit(function(e){
        e.preventDefault();
        $.ajax({
            url: App.baseUrl() + 'admin/user/create/',
            type: 'POST',
            data : $(this).serialize(),
            success : function(resp){
                if(resp.success === true){
                    window.location.reload();
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
}





