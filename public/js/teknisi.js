function modal_toggler(id) {
    let modalID = $(`#${id}`)
    if ($(modalID).hasClass("modal-open")) {
        $(modalID).removeClass("modal-open");
    } else {
        $(modalID).addClass("modal-open");
    }
}
let installerManagement = function () {
    

    // SHOW DETAL MEMBER
    $(document).on("click", "#btn-show", function () {
        let member = $(this).data("user");
        $(".table-show-member td#name").text(member.name)
        $(".table-show-member td#phone").text(member.phone)
        $(".table-show-member td#email").text(member.email)
        $(".table-show-member td#address").text(member.alamat)
        $(".table-show-member td#maps").text(member.location)
    })
}
$(document).ready(function () {
    installerManagement();
    $('.table-datatable').DataTable({
        "order": [],
        "scrollX": true,
        "scrollCollapse": true,
    });
});