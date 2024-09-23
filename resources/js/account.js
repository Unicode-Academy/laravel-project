import "select2/dist/css/select2.min.css";
import $ from "jquery";
import select2 from "select2";
import html2canvas from "html2canvas-pro";
import jsPDF from "jspdf";
select2();
import { showMessage } from "./message";
const profileBtn = document.querySelector(".js-profile-btn");
if (profileBtn) {
    let status = "table";
    const renderButton = () => {
        profileBtn.innerText =
            status === "table" ? "Cập nhật thông tin" : "Hủy";
        if (status === "form") {
            profileBtn.classList.replace("btn-warning", "btn-danger");
        } else {
            profileBtn.classList.replace("btn-danger", "btn-warning");
        }
    };
    const renderTableForm = () => {
        const profileList = document.querySelectorAll(".js-profile");
        var indexActive = null;
        profileList.forEach((profile, index) => {
            if (profile.classList.contains("active")) {
                indexActive = index;
            }
        });
        profileList[indexActive].classList.remove("active");
        if (indexActive === 0) {
            profileList[1].classList.add("active");
        } else {
            profileList[0].classList.add("active");
        }
    };
    profileBtn.addEventListener("click", (e) => {
        e.preventDefault();
        status = status === "table" ? "form" : "table";
        renderButton();
        renderTableForm();
    });
}

//Xử lý update profile
const profileForm = document.querySelector("form.js-profile");
if (profileForm) {
    const button = profileForm.querySelector(".js-btn-update");

    const initialTextBtn = button.innerText;
    const updateProfile = async (formData, token) => {
        button.innerText = "Đang cập nhật...";
        button.disabled = true;
        const response = await fetch(`/tai-khoan/thong-tin`, {
            method: "POST",
            headers: {
                "X-Csrf-Token": token,
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify(formData),
        });
        const { errors, success } = await response.json();
        button.innerText = initialTextBtn;
        button.disabled = false;
        if (errors) {
            showErrors(errors);
        } else {
            //Hiển thị thông báo khi cập nhật DB
            const msgSuccess = `Cập nhật thông tin thành công`;
            const msgError = `Không thể cập nhật vào lúc này`;
            if (success) {
                showMessage(msgSuccess, "success");
            } else {
                showMessage(msgError, "error");
            }
        }
    };
    const showErrors = (errors) => {
        const errorList = profileForm.querySelectorAll(".error");
        errorList.forEach((error) => {
            error.innerText = "";
        });
        Object.keys(errors).forEach((key) => {
            const errorEl = profileForm.querySelector(`.error-${key}`);
            errorEl.innerText = errors[key][0];
        });
    };
    profileForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = Object.fromEntries(new FormData(e.target));
        const csrfToken =
            document.head.querySelector(`[name="csrf_token"]`).content;
        updateProfile(formData, csrfToken);
    });
}

//Select2
$(".js-select2").select2();

//Đơn hàng
const downloadBtn = document.querySelector(".download-btn");
if (downloadBtn) {
    downloadBtn.addEventListener("click", () => {
        const orderDetailEl = document.querySelector(".order-detail");
        html2canvas(orderDetailEl).then((canvas) => {
            const image = canvas.toDataURL("image/png");
            const pdf = new jsPDF({
                orientation: "landscape",
            });
            const imgProps = pdf.getImageProperties(image);
            const pdfWidth = pdf.internal.pageSize.getWidth() - 30;
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(image, "PNG", 15, 15, pdfWidth, pdfHeight);
            pdf.save("don-hang.pdf");
        });
    });
}
