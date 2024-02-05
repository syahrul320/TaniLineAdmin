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
        ajax: url + "/kategori/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                serachable: false,
                sClass: "text-center",
            },
            { data: "nama_kategori", name: "nama_kategori" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                serachable: false,
                sClass: "text-center",
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

    $("#add").click(function () {
        document.getElementById("form").reset();
        $("#id").val("");
        $("#submit").attr("disabled", false);
        $("#card-form").show(1000);
    });
    $("#close-form").click(function () {
        $("#card-form").hide(1000);
        document.getElementById("form").reset();
        $("#id").val("");
        $("#submit").html("Simpan");
    });

    $("#form").submit(function (e) {
        e.preventDefault();
        $("#submit").html("Tunggu...");
        $("#submit").attr("disabled", true);
        var urlSubmit, text, action;
        if ($("#id").val() != "") {
            text = "Update";
            action = "Update";
            urlSubmit = url + "/kategori-update-data";
        } else {
            text = "Simpan";
            action = "Simpan";
            urlSubmit = url + "/kategori-insert-data";
        }
        var formData = new FormData($("#form")[0]);
        $.ajax({
            method: "POST",
            url: urlSubmit,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#submit").attr("disabled", false);
                $("#nama_kategoriError").html("");
                if (data.errors) {
                    $("#submit").html(action);
                    if (data.errors.nama_kategori) {
                        $("#nama_kategoriError").html(data.errors.nama_kategori[0]);
                    }
                }

                if (data.success) {
                    table.draw();
                    document.getElementById("form").reset();
                    $("#id").val("");
                    swal("Success " + text + " Data", {
                        icon: "success",
                    });
                    $("#card-form").hide();
                    $("#submit").html("Simpan");
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});

function destroy(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: url + "/kategori-delete-data",
                data: { id: id },
                method: "POST",
                success: function (data) {
                    table.draw();
                    swal("Success Delete Data", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        } else {
            swal("Your data is safe!");
        }
    });
}

function edit(id) {
    $("#submit").attr("disabled", false);
    $.ajax({
        url: url + "/kategori-edit-data",
        data: { id: id },
        method: "POST",
        success: function (data) {
            $("#id").val(data.data.id);
            $("#nama_kategori").val(data.data.nama_kategori);
            $("#submit").html("Update");
            $("#card-form").show(1000);
        },
        error: function (data) {
            console.log("Error:", data);
        },
    });
}
