(function ($) {
    var defaultOptions = {
        debug: true,
        errorElement: "span",
        errorClass: "invalid-data",
        validClass: "valid-data",
        ignore: ["display: none;"],
        errorPlacement: function (error, element) {
            //            element.siblings("span.field-validation-msg").html($(error).text());
            $("#error_" + element.attr("id")).html($(error).text());
        },
        highlight: function (element, errorClass, validClass) {
            $(element).closest(".form-group")
                .addClass(errorClass)
                .removeClass(validClass);

            //add class in error-container-span
            $("#error_" + $(element).attr("id")).addClass("dBi");
        },
        unhighlight: function (element, errorClass, validClass) {

            $(element).closest(".form-group")
            .removeClass(errorClass)
            .addClass(validClass);

            //remove class in error-container-span
            $("#error_" + $(element).attr("id")).removeClass("dBi").text("");
        }

    };

    $.validator.setDefaults(defaultOptions);

    /*$.validator.unobtrusive.options = {
        errorClass: defaultOptions.errorClass,
        validClass: defaultOptions.validClass,
    };*/
})(jQuery);