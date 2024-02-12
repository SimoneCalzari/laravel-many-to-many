import "./bootstrap";

import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

const buttonImg = document.getElementById("update-img");
const inputImgDiv = document.getElementById("input-img");
const buttonEmptyImg = document.getElementById("empty-img-field");
const inputImg = document.getElementById("project-img");
const previewImg = document.getElementById("preview-img");
const img = document.querySelector("#preview-img img");

function isImage(url) {
    return /\.(jpg|jpeg|png|webp|bmp|gif|svg)$/.test(url);
}

if (buttonImg) {
    buttonImg.addEventListener("change", function () {
        inputImgDiv.classList.toggle("d-none");
        inputImg.value = "";
        img.src = "";
        previewImg.classList.add("d-none");
    });
}

if (inputImg) {
    inputImg.addEventListener("change", function () {
        if (isImage(inputImg.value)) {
            previewImg.classList.remove("d-none");
            img.src = window.URL.createObjectURL(this.files[0]);
        }
    });
}

if (buttonEmptyImg) {
    buttonEmptyImg.addEventListener("click", function () {
        inputImg.value = "";
        img.src = "";
        previewImg.classList.add("d-none");
    });
}
