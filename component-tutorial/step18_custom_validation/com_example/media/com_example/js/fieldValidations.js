window.onload = (event) => {
    document.formvalidator.setHandler('plusMinus90',
        function (value, element) {
            f = parseFloat(value);
            return (f >= -90.0 && f <= 90.0);
        });
    document.formvalidator.setHandler('plusMinus180',
        function (value, element) {
            f = parseFloat(value);
            return (f >= -180.0 && f <= 180.0);
        });
};