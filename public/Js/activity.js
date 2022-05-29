const Activity = {
    'activityList' : '',
}
Activity.init = function(){
    this.activityList = document.querySelectorAll('[data-modal="delete-activity"]');
    this.delete();
}
Activity.delete = function(){
    this.activityList.forEach(function (el){
        el.addEventListener('click', function (e){
            let id = e.target.id;
            if(confirm('Do you want to delete this activity?')){
                $.ajax({
                    url: App.baseUrl() + '/admin/activity/delete/' + id,
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