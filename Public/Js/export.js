
const Export = {
    'print ': '',
    'pdf ': '',
    'excel' :  '',
    'csv' : ''
}
Export.init = function (){
    this.print = document.getElementById('print');
    this.pdf   = document.getElementById('pdf');
    this.excel = document.getElementById('excel');
    this.csv   = document.getElementById('csv');
    Export.exportPrint();
    Export.exportPdf();
    //call all print export methods here

}
Export.exportPrint = function (){
    if(this.print)
        this.print.addEventListener('click', function(){
            window.print();
        });

}
Export.exportPdf = function (){
    if(this.pdf)
    this.pdf.addEventListener('click', function(){
        Modal.open('pdf', "http://localhost/Framework/admin/user/exportPdf/");

        //wait for the dom element to show up
        setTimeout( function(){
            let modalContainer = document.getElementById('modal-container');
            let modalForm = modalContainer.querySelector('#pdf-form');
                modalForm.addEventListener('submit', function (e){
                    e.preventDefault();
                    //use ajax to submit the form
                    //url
                    //post
                    //data
                });

        },500)


            //htmlCollection.prototype.forEach = Array.prototype.forEach;

        //let form = htmlCollection.prototype.querySelectorAll("pdf-form");
        //console.log(form);
       /* htmlCollection.prototype.querySelectorAll  = function(pdf-form){
            var all = [];
            this.forEach( function( el ){
                if( el )
                    all.concat( el.getElementsByClassName( name ) );
            });
            return all;
        }*/

        //console.log(form);
            /*.submit(function(event){
            event.preventDefault();
             alert();*/
        //});
    });
}