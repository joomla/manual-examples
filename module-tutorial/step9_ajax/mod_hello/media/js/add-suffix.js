jQuery(document).ready(function() {
    let arr = Joomla.getOptions('vars');
    let hello = document.getElementsByClassName('mod_hello');
    if (hello != null) {
        for (let i = 0; i < hello.length; i++) {
            hello[i].innerText = hello[i].innerText + arr['suffix'];
        }
    }
});
function count_users() {
    console.log(event.target);
    let nusers = event.target.parentElement.querySelector('span');
    console.log(nusers);
    request = {
        'option' : 'com_ajax',
        'module' : 'hello',
        'method' : 'count',
        'data'   : null,
        'format' : 'json'
        };
    jQuery.ajax({
    type   : 'POST',
    data   : request,
    success: function (response) {
        console.log(response);
        if (response.success) {
            nusers.innerText = response.data;
        } else {
            const messages = {"error": [response.message]};
            Joomla.renderMessages(messages);
        }
    },
    error: function(response) {
        alert('Ajax call failed');
    }
    });
}