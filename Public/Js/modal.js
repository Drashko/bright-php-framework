//js lib for creating modal popup dynamically
let Modal = {
    'modal' : '',
    'modal-container': ''
}
Modal.init = function(){
        /*let modalList = document.querySelectorAll("[data-type='modal']");
        modalList.forEach(function(element) {
            element.addEventListener('click', function(){
                if(!document.body.contains( document.getElementById('modal') ))
                    Modal.open( element.getAttribute('data-modal-id') , element.getAttribute('data-modal-url') );
            })
            ;
        });*/
}
Modal.open = function(id , url){
        this.modalConatiner = document.getElementById('modal-container');
        //create div modal element
        //this.modal  = Dom.createDomElement('#modal-container','section', 'id', 'ggggggggggggggggggggggggggggggggggggggggggggg');//'modal +id'
        //set div element in page where the modal will be opened
        //console.log(this.modal);
        if(this.modalConatiner){
            //get modal html+data from view using ajax
            Ajax.ajaxRequest('GET', url).then(function(data){
                Modal.modalConatiner.insertAdjacentHTML("afterbegin", data);
                //let closeBtn = Modal.modal.querySelectorAll("[data-close]");
                //closeBtn.forEach(function(button){
                //button.addEventListener('click', function(){
                //Modal.close(Modal.modal);
                //});
                // });
            });
        }


}
Modal.close = function(modal){
        let parent = modal.parentNode;
        return parent.removeChild(modal);
 }
