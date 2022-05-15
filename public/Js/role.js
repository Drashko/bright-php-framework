const Role = {
    'modalList' : '',
    'roleCreateForm' : ''
}
Role.init = function(){
    this.modalList = document.querySelectorAll('[data-modal="delete-role"]');
    this.delete();
    this.create();
}
Role.delete = function(){
    this.modalList.forEach(function (el){
        el.addEventListener('click', function (e){
            let id = e.target.id;
            if(confirm('Do you want to delete this role?')){
                $.ajax({
                    url: App.baseUrl() + '/admin/role/delete/' + id,
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
Role.create = function(){
    this.roleCreateForm = jQuery('#role-create-form');
    this.roleCreateForm.submit(function(e){
        e.preventDefault();
        $.ajax({
            url: App.baseUrl() + '/admin/role/create/',
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





