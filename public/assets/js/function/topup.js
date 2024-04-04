var table;
$(document).ready(function () {
    $("#card-form").hide();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    table = $("#dt_tbl").DataTable({
        processing: true,
        scrollX: true,
        serverSide: true,
        orderCellsTop: true,
        ajax: url + "/topup/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "name", name: "name" },
            { data: "title", name: "title" },
            { data: "amount", name: "amount" },
            { data: "status", name: "status" },
            { data: "external_id", name: "external_id" },
            { data: "url", name: "url" },
            { data: "created_at", name: "created_at" },
        ],
        initComplete: function () {
            this.api()
                .columns([])
                .every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.className = "form-control";
                    $(input)
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            column
                                .search($(this).val(), false, false, true)
                                .draw();
                        });
                });
        },
    });
});