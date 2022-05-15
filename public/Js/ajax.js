Ajax = {}

Ajax.ajaxRequest = function (method, url, data){
    return new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                resolve(xhr.response);
            } else {
                reject({
                    status: this.status,
                    statusText: xhr.statusText
                });
            }
        };
        xhr.onerror = function () {
            reject({
                status: this.status,
                statusText: xhr.statusText
            });
        };
        if(method === "POST" && data){
            xhr.send(data);
        }else{
            xhr.send();
        }
    });
}
//ajax call example
Ajax.call = function(url){
    this.ajaxRequest('GET', url).then(function(data){
       return data;
    });
}