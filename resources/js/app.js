import "./bootstrap";

import Swal from "sweetalert2";
window.Swal = Swal;

window.addEventListener("custom-alert", (event) => {
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

Livewire.on('uploadProgress', (progress) => {
    document.querySelector('[x-data]').__x.$data.progress = progress;
});
