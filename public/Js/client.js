const Client = {
    'clientList' : '',
}
Client.init = function(){
    this.clientList = document.querySelectorAll('[data-modal="delete-client"]');
    this.delete();
}
Client.delete = function(){
    this.clientList.forEach(function (el){
        el.addEventListener('click', function (e){
            let id = e.target.id;
            if(confirm('Do you want to delete this client?')){
                $.ajax({
                    url: App.baseUrl() + '/admin/client/delete/' + id,
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