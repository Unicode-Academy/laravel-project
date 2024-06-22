import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

export const showMessage = (message, type = "success") => {
    const successBg = `linear-gradient(to right, #00b09b, #96c93d)`;
    const errorBg = `linear-gradient(to right, #ff5f6d, #ffc371)`;
    Toastify({
        text: message,
        duration: 1000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: type === "success" ? successBg : errorBg,
        },
    }).showToast();
};
