const User = {
    'modalList' : '',
    'userCreateForm' : ''
}
User.init = function(){
    this.modalList = document.querySelectorAll('[data-modal="delete"]');
    this.delete();
    this.create();
    this.logout();
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

User.logout = function(){
     const logout = jQuery('#logout');
        logout.click(function(){
            if(confirm('You are about to log out! Are you sure?')){
                $.ajax({
                    url: App.baseUrl() + 'logout/index/',
                    type: 'GET',
                    success : function(resp){
                        if(resp.success){
                            //show message logout
                            window.location.href = App.baseUrl();
                        }else{
                            alert('Error loggin out');
                        }
                    }
                });
            }
        });

}





