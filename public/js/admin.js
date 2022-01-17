const pageName = $("#page-name").val();
const base_url = window.location.origin;
let _token = $('meta[name="csrf-token"]').attr('content');

function initShowDropdown(e) {
    // if (e.open) {
    //     $(e).find("summary").removeClass("text-blue-800")
    // } else {
    //     $(e).find("summary").addClass("text-blue-800")
    // }
}
let initValidate = () => {
    if ($(".init-validatation").length > 0) {
        $(".init-validatation").validate();
    }
}
function modal_toggler(id) {
    let modalID = $(`#${id}`)
    $(".modal").on('click', function (e) {
        if (e.target !== this) return;
        $(modalID).removeClass("modal-open");
    });
    if ($(modalID).hasClass("modal-open")) {
        $(modalID).removeClass("modal-open");
    } else {
        $(modalID).addClass("modal-open");
    }
}
let initFormSelect2 = () => {
    let form_select2_basic = $(".form-select2-basic");
    if (form_select2_basic.length != 0) {
        $(".form-select2-basic").each(function () {
            let modal_data = $(this).data("dropdownParent");
            let search_hidden = $(this).data("search-hidden");
            if (typeof search_hidden != "boolean") search_hidden = false;
            $(this).select2({
                placeholder: "Chose one",
                minimumResultsForSearch: search_hidden ? "Infinity" : 5,
                dropdownParent: modal_data ? modal_data : null,
            });
        })
    }
}
let installationManagement = () => {
    if (pageName != "admin-installation") return false;
    let form_accept = $("#form-accept");
    $(document).on("click", "#btn-accept", function () {
        let id = $(this).data("id");
        form_accept.attr("action", "/admin/installation/" + id);
    });
    $(document).on("click", "#btn-detail", function () {
        $(".table-detail #pelanggan").html($(this).data("pay")['user']['name'])
        $(".table-detail #alamat").html($(this).data("pay")['user']['alamat'])
        $(".table-detail #paket").html($(this).data("pay")['package']['name'])
        $(".table-detail #status").html($(this).data("pay")['status'])
        $(".table-detail #expired").html($(this).data("pay")['expired'] == null ? "-" :
            $(this).data("pay")['expired'])
        $("#pause-form").attr("action", "/admin/installation/" + $(this).data("pay")['id'])
        $(".table-detail #blok").html($(this).data("pay")['blok_id'] == null ? "-" :
            $(this).data("pay")['bloks']['name']
        )
        $("#delete-form").attr("action", "/admin/installation/" + $(this).data("pay")['id']);
        if ($(this).data("pay")['status'].toLowerCase() == "paused") {
            $("#pause-form button").val("continue");
            $("#pause-form button").html("Continue");
            $("#delete-form button").html("Berhenti Selamanya");
            $("#pause-form button").attr("hidden", false);
        } else if ($(this).data("pay")['status'].toLowerCase() == "installed") {
            $("#delete-form button").html("Berhenti Selamanya");
            $("#pause-form button").val("pause");
            $("#pause-form button").html("pause");
            $("#pause-form button").attr("hidden", false);
        } else {
            $("#delete-form button").html("Tolak");
            $("#pause-form button").attr("hidden", true);
        }
        $(".table-detail #penagih").html($(this).data("pay")['blok_id'] == null ? "-" :
            $(this).data("pay")['bloks']['collectors']['name']
        )
        $(".table-detail #teknisi").html($(this).data("pay")['technician'] == null ? "-" : $(this).data("pay")['technician']['name'])

        $(".table-detail #createdat").html($(this).data("pay")['created_at'].slice(0, 10))

    })
    $(document).on("click", "#btn-print", function () {
        let item = $(this).data("item")
        // console.log(item)
        let paper = $("#print-paper-installation");
        paper.find("td#username_pdf").text(item.username ? item.username : "-")
        paper.find("td#nama_pdf").text(item.user ? item.user.name : "-")
        paper.find("td#date_pdf").text(item.created_at ? new Date(item.created_at) : "-")
        paper.find("td#teknisi_pdf").text(item.technician ? item.technician.name : "-")
        let original = document.body.innerHTML;
        document.body.innerHTML = paper.html();
        window.print()
        document.body.innerHTML = original;
    })

}
let paymentManagement = () => {
    if (pageName != "payment") return false;

    $(document).on("submit", "form#delete-payment", function (e) {
        e.preventDefault()
        let action = $(this).attr("action")
        Swal.fire({
            title: 'Lanjutkan hapus?',
            text: "Jika dihapus data akan hilang permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#d33',
            cancelButtonText: `Batal`,
            confirmButtonText: 'HAPUS',
        })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: base_url + action,
                        data: { "_token": _token, "_method": "delete" },
                        success: function (response) {
                            window.location = base_url + "/admin/payment"
                        }
                    });
                }
            })
    });
    $(document).on("click", "#btn-check", function () {
        let pay = $(this).data("pay");
        let id = pay['id']
        let img = pay['transfer_img'];
        $(".check-form").attr('action', "/admin/payment/" + id);
        $(".check-form img").attr("src", "/storage/" + img);
    })
}
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
$(document).ready(function () {
    paymentManagement();
    installationManagement();
    initFormSelect2();
});
