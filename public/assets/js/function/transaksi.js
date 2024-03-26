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
        ajax: {
            url: url + "/transaksi-pembeli/",
            data: function (d) {
                (d.start_date = start_date),
                    (d.end_date = end_date),
                    (d.id_user = $("#id_user option:selected").val());
            },
        },
        // ajax: url + "/produk/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "kode_transaksi", name: "kode_transaksi" },
            { data: "name", name: "name" },
            { data: "biaya_admin", name: "biaya_admin" },
            { data: "tgl_transaksi", name: "tgl_transaksi" },
            { data: "status_transaksi", name: "status_transaksi" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
        ],
        columnDefs: [
            {
                targets: 3,
                render: $.fn.dataTable.render.number(",", ".", 0, ""),
            },
        ],
        initComplete: function () {
            this.api()
                .columns([1, 2, 3, 4, 5])
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

    //Kategori
    $("#id_user").select2({
        ajax: {
            url: url + "/transaksi-card-select",
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

    $("#id_user").on("change", function () {
        id_user = $("#id_user").val();
        table.draw();
    });
});

$(function () {
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#reportrange span").html(
            start.format("YYYY-MM-DD") + " &#8594; " + end.format("YYYY-MM-DD")
        );
    }

    $("#reportrange").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);
    $("#reportrange").on("apply.daterangepicker", function (ev, picker) {
        console.log(picker.startDate.format("YYYY-MM-DD"));
        console.log(picker.endDate.format("YYYY-MM-DD"));
        start_date = picker.startDate.format("YYYY-MM-DD");
        end_date = picker.endDate.format("YYYY-MM-DD");
        table.draw();
    });
});
