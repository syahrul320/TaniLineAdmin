var table;
$(document).ready(function () {
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
        ajax: url + "/saldo-merchant/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "name", name: "name" },
            { data: "alamat", name: "alamat" },
            { data: "saldo", name: "saldo" },
        ],
        columnDefs: [
            {
                targets: 3,
                render: $.fn.dataTable.render.number(",", ".", 0, ""),
            },
        ],
        initComplete: function () {
            this.api()
                .columns([1, 2, 3])
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