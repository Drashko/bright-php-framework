const Project = {
    'projectList' : '',
}
Project.init = function(){
    this.projectList = document.querySelectorAll('[data-modal="delete-project"]');
    this.delete();
}
Project.delete = function(){
    this.projectList.forEach(function (el){
        el.addEventListener('click', function (e){
            let id = e.target.id;
            if(confirm('Do you want to delete this project?')){
                $.ajax({
                    url: App.baseUrl() + '/admin/project/delete/' + id,
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