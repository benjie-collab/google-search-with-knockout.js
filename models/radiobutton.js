ko.bindingHandlers.RadioButton = {
    init: function (element, valueAccessor) {
        $(element).iCheck({
            checkboxClass: 'icheckbox_minimal',
		    radioClass: 'iradio_minimal',
		    increaseArea: '20%' // optional
        });

        $(element).on('ifChecked', function () {
            var observable = valueAccessor();
            observable.checked(true);

        });
		$(element).on('ifUnchecked', function () {	
            var observable = valueAccessor();
            observable.checked(false);

        });
    },
    update: function (element, valueAccessor) {		
        var observable = valueAccessor();
    }
};