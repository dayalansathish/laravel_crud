// document.addEventListener("DOMContentLoaded", function () {
//     setTimeout(function () {
//         let alertElement = document.querySelector(".alert");
//         if (alertElement) {
//             alertElement.style.display = "none";
//         }
//     }, 5000);
// });

// popover
$(document).ready(function () {
    $(".delete-product").popover({
        content: $("#deletePopover").html(),
        html: true,
        trigger: "click",
        placement: "left",
    });

    $(document).on("click", ".cancel-delete", function () {
        $(".delete-product").popover("hide");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
});
