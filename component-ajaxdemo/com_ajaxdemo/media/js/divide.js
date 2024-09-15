const divide = (event) => {
    // the element ids get prefixed by whatever is passed as 'control' in the loadForm call in the Model, plus "_"
    let a = document.getElementById("jform_a").value;
    let b = document.getElementById("jform_b").value;
    let answer = document.getElementById("jform_answer");
    // get the URL root which is passed down from the PHP code
    var vars = Joomla.getOptions('com_ajaxdemo.uri');
    jQuery.ajax({   
            url: vars.root + 'index.php?option=com_ajaxdemo&format=json&task=ajax.divide',
            data: { a: a, b: b },  // passed as HTTP POST parameters
        })
        .done(function(result, textStatus, jqXHR)
        {
            if (result.success)
            {
                jQuery("#jform_answer").val(result.data); 
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
        .fail(function(jqXHR, textStatus, errorThrown)
        {
            console.log('ajax call failed' + textStatus);
        });
};
