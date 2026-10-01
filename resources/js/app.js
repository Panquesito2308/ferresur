import './bootstrap';
import Swal from 'sweetalert2';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    let dropdown = document.getElementById("productosDropdown");

    if (dropdown) {
        dropdown.addEventListener("mouseenter", function () {
            let menu = this.querySelector(".dropdown-menu");
            menu.classList.add("show");
        });

        dropdown.addEventListener("mouseleave", function () {
            let menu = this.querySelector(".dropdown-menu");
            menu.classList.remove("show");
        });
    }
});