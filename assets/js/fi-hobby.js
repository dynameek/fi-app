/*
 *
 *
 *
 *
*/
function appendHobby(hobby)
{
    var parentList = document.getElementById('hobby-list');
    var span = document.createElement('span');
    span.innerHTML = hobby;
    
    parentList.appendChild(span);
}


window.addEventListener('load', function(){
    var logoutBtn = document.getElementById('logout');
   var addHobbyBtn = document.getElementById('add-hobby-btn');
   var addHobbyForm = document.forms.add_hobby; //  Get the form
   var token = addHobbyForm.csrf_token;   //  Get the csrf token value
   var hobby = document.getElementById('hobby');   //  Get the hobby value
   
   addHobbyBtn.addEventListener('click', function(){
        var request = System.createAjaxObject();
        
        request.open('post', './processes/add-hobby.process.php');
        request.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
        request.send('csrf_token='+token.value+'&hobby='+hobby.value);
        
        request.onreadystatechange = function()
        {
            if(request.readyState === 4)
            {
                console.log(request.responseText);
                let response = JSON.parse(request.responseText);
                if(response.isSuccessful)
                {
                    appendHobby(hobby.value);
                    System.displayFormMessage('form-message', response.body, 1);
                }else System.displayFormMessage('form-message', response.body, 3);
                
                // reset the token
                token.value = response.token;
            }
        };
   });
   
   logoutBtn.addEventListener('click', function(){
        var request = System.createAjaxObject();
        
        request.open('get', './processes/logout.process.php');
        request.send(null);
        
        request.onreadystatechange = function()
        {
            if(request.readyState === 4)
            {
                window.location = "./index.php";
            }
        };
   });
});