const Task = {
    'taskList' : '',
}
Task.init = function(){
    this.taskList = document.querySelectorAll('[data-modal="delete-task"]');
    this.delete();
}
Task.delete = function(){
    this.taskList.forEach(function (el){
        el.addEventListener('click', function (e){
            let id = e.target.id;
            if(confirm('Do you want to delete this task?')){
                $.ajax({
                    url: App.baseUrl() + '/admin/task/delete/' + id,
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