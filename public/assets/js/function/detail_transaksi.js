var table;
var id_produk = "";
var start_date;
var end_date;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    table = $("#dt_tbl").DataTable({
        processing: true,
        scrollY: "68vh",
        scrollX: true,
        serverSide: true,
        orderCellsTop: true,
        lengthMenu: [10, 50, 100, 1000],
        ajax : {
            url : window.location,
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "name", name: "name" },
            { data: "nama_produk", name: "nama_produk" },
            { data: "harga_jual", name: "harga_jual" },
            { data: "qty", name: "qty" },
        ],
        columnDefs: [
            {
                targets: 3,
                render: $.fn.dataTable.render.number(",", ".", 0, ""),
            },
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
