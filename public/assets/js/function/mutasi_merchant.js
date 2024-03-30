$document.ready(function () {
    //Merchant
    $("#id_merchant").select2({
        ajax: {
            url: url + "/merchant-select",
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    });
});
