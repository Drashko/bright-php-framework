const App = {}

App.baseUrl = function(){
    let url;
    const pathparts = location.pathname.split('/');
    if (location.host === 'localhost') {
            url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
        }else{
            url = location.origin; // http://mysite.com
        }
        return url;
}