jQuery(function() {
    document.formvalidator.setHandler('noUppercase',
        function (value) {
            // look for any uppercase characters 
            let regex = /[A-Z]/g;
            // we should return false if any uppercase characters are found
            // ie, it has failed validation
            return !regex.test(value);
        });
});
