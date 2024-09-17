const divide = (event) => {
    // the element ids are the field names prefixed by whatever is passed as 'control' in the loadForm call in the Model, plus "_"
    let a = document.getElementById("jform_a").value;
    let b = document.getElementById("jform_b").value;
    let data = { a: a, b: b };
    let answer = document.getElementById("jform_answer");
    
    // get the URL root which is passed down from the PHP code
    let vars = Joomla.getOptions('com_ajaxdemo.uri');
    let url = vars.root + 'index.php?option=com_ajaxdemo&format=json&task=ajax.divide';

    fetch(url, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:  new URLSearchParams(data).toString()
    })
    .then(response => response.json())
    .then(result => { 
        if (result.success)
        {
            answer.value = result.data; 
            // render the passed message as an Info message in the messages area
            Joomla.renderMessages({"info": [result.message]});
        }
        else
        {
            alert(result.message);
        }
        // display the enqueued messages in the message area
        // pass 3rd param as 'true' so that the previous message doesn't get removed
        if (result.messages) {
            Joomla.renderMessages(result.messages, undefined, true);
        }
    })
    .catch( err => {
        let errName = err.name;
        let errMsg = err.message;
        alert(`Ajax failed! error name: ${errName}, message: ${errMsg}`);
    });
};
