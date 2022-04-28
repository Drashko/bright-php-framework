let Dom = {
    'element' : ''
}
Dom.createDomElement = function(par,el, attr, val){
    if(par){
        let parent = document.querySelectorAll(par)[0];
        if(el){
            this.element = document.createElement(el);
            if(attr){
                let attribute = document.createAttribute(attr);
                attribute.value = val;
                this.element.setAttributeNode(attribute);
            }
            parent.appendChild(this.element);
        }else{
            console.log('Error , please provide valid html tag');
        }
    }else{
        console.log('Please provide parent element in which the new element will be created!');
    }
    console.log(this.element);
    return this.element;
}