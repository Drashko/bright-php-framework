window.onload = function() {
    validate.init();
};

let validate = {
    'email ': '',
    'phone ': '',
    'password' :  '',
    'button' : '',
    //'self' : this
}
validate.init = function () {
    this.email = document.getElementById('email') ;
    this.phone = document.getElementById('phone');
    this.password = document.getElementById('password');
    this.button = document.getElementById('1');
    validate.check();
    validate.mail();
    validate.pass();
    validate.phone_nb();
}
//validate email address
validate.mail = function(){
    if(this.email)
      this.email.addEventListener('change', function(e){
        let email_value = e.target.value;
        let format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(email_value.match(format)) {
            validate.remove_error(this.email);
            return true;
        } else {
            let mess = "Please provide valid email address!";
            validate.show_error(self.email, mess);
            return false;
        }
    }.bind(this));
    return false;
}
//validate phone number
validate.phone_nb = function(){
    this.phone.addEventListener('onblur', function(e){
        let phone_value = e.target.value;
        let format = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if(phone_value.match(format)){
            validate.remove_error(this.phone);
            return true;
        } else {
            let mess = "Please provide valid phone format!";
            validate.show_error(this.phone, mess);
            return false;
        }
    }.bind(this));
    return false;
}
//validate password
validate.pass = function(){
    this.password.addEventListener('onblur', function(e){
        let password_value = e.target.value;
        let format =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
        if(password_value.match(format)) {
            validate.remove_error(this.password);
            return true;
        } else {
            let mess = "The password must be between 7 to 15 characters to contain at least one digit and a special character!";
            validate.show_error(this.phone, mess);
            return false;
        }
    }.bind(this));
    return false;
}

validate.check = function (){
    if(this.button)
      this.button.addEventListener('click', function(e){
        if(self.email.value === "" || validate.mail() === false){
            let mess = "Please provide valid email number!";
            validate.show_error(this.email, mess);
            e.stopPropagation();
        }
        else if(self.phone.value === "" || validate.phone_nb() === false){
            let mess = "Please provide valid phone number!";
            validate.show_error(this.email, mess);
            e.stopPropagation();
        }
        else if(self.password.value === "" || validate.pass() === false){
            let mess = "Please provide correct format password!!";
            validate.show_error(this.email, mess);
            e.stopPropagation();
        }else{
            return false;
        }
    }.bind(this),true);

}
validate.show_error = function(target_el,msg){
    let message = document.createElement('span');
    message.innerHTML = msg;
    message.classList.add('error');
    target_el.parentElement.appendChild(message);
}
validate.remove_error = function(element){
    return element.parentNode.removeChild(element.nextSibling);
}

console.log(validate.mail());
