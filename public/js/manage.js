function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
  }
  
  function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
  
    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
  
  }  

/*let banForm = document.querySelector("#banForm");
if(banForm != null){
    banForm.addEventListener("submit",banUser);
}



function banUser(event){
    event.preventDefault();

    let user_id = banForm.querySelector("input[name=id]").value;

    let ban = banForm.querySelector("#ban-target").innerHTML;
    console.log(ban);

    if(ban != null){
        banButton.display.style = "block";
        unbanButton.display.style = "none";
        ban_value = 1;
    }
    else{
        banButton.display.style = "block";
        unbanButton.display.style = "none";
        ban_value = 1;
    }

    return sendAjaxRequest('put','/user' + user_id + '/ban',{id: user_id, ban: ban_value},banUserHandler);
}

function banUserHandler(){
    let item = JSON.parse(this.responseText);
    let banButton = banForm.querySelector("#banButton");
    let unbanButton =banForm.querySelector("#unbanButton");
    if(item.ban === 1){
        banButton.display.style = "block";
        unbanButton.display.style = "none";
        ban = "0";
    }
    else{
        banButton.display.style = "block";
        unbanButton.display.style = "none";
        ban = "1";
    }
}
*/