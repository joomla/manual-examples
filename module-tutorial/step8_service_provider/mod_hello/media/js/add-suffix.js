jQuery(document).ready(function() {
    let arr = Joomla.getOptions('vars');
    let hello = document.getElementsByClassName('mod_hello');
    if (hello != null) {
        for (let i = 0; i < hello.length; i++) {
            hello[i].innerText = hello[i].innerText + arr['suffix'];
        }
    }
});