if (!window.Joomla) {
  throw new Error('Joomla API was not properly initialised');
}

const { suffix } = Joomla.getOptions('vars');
document.querySelectorAll('.mod_hello').forEach(element => {
  element.innerText += suffix;
});

function count_users() {
    let nusers = event.target.parentElement.querySelector('span');
    Joomla.request({
        url: 'index.php?option=com_ajax&module=hello&method=count&format=json',
        method: 'GET',
        onSuccess(data) {
            const response = JSON.parse(data);
            if (response.success) {
                nusers.innerText = response.data;
                const confirmation = Joomla.Text._('MOD_HELLO_AJAX_OK').replace('%s', response.data);
                Joomla.renderMessages({'info': [confirmation]});
            } else {
                const messages = {"error": [response.message]};
                Joomla.renderMessages(messages);
            }
        },
        onError(xhr) {
            Joomla.renderMessages(Joomla.ajaxErrorsMessages(xhr));
            const response = JSON.parse(xhr.response);
            Joomla.renderMessages({"error": [response.message]}, undefined, true);
        }
    });
}
