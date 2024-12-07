import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import Swal from "sweetalert2";
window.Swal = Swal;

window.addEventListener("alert", (event) => {
    let data = event.detail;
    Swal.fire({
        position: data.position,
        icon: data.type,
        title: data.title,
        showConfirmButton: false,
        timer: data.timer,
    });
});

window.addEventListener("refreshPage", (event) => {
    // Melakukan refresh setelah notifikasi
    location.reload();
});
