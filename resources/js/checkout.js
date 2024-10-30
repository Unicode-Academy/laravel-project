import { showMessage } from "./utils";
const checkoutPageEl = document.querySelector(".checkout-page");
if (checkoutPageEl) {
    const bankCopyList = checkoutPageEl.querySelectorAll(".bank-copy");
    if (bankCopyList.length) {
        bankCopyList.forEach((bankCopyEl) => {
            bankCopyEl.addEventListener("click", (e) => {
                e.preventDefault();
                const textCopy = e.target.previousElementSibling.innerText;
                navigator.clipboard.writeText(textCopy).then(() => {
                    e.target.classList.replace("fa-regular", "fa-solid");
                });
            });
        });
    }

    async function toDataURL(url) {
        const blob = await fetch(url).then((res) => res.blob());
        return URL.createObjectURL(blob);
    }

    const downloadQrEl = checkoutPageEl.querySelector(".download-qr");
    downloadQrEl.addEventListener("click", async (e) => {
        const qrUrl = e.target.previousElementSibling.src;
        const a = document.createElement("a");
        a.href = await toDataURL(qrUrl);
        a.download = "qr-code.png";
        a.click();
    });

    const expireObj = new Date(paymentDate);
    expireObj.setTime(
        expireObj.getTimezoneOffset() * 60 * 1000 + expireObj.getTime()
    );
    const expire = expireObj.getTime() + checkoutCountdown * 60 * 1000;
    const countdownEl = checkoutPageEl.querySelector(".countdown");
    const calculatorTimer = () => {
        const d = new Date();
        d.setTime(d.getTimezoneOffset() * 60 * 1000 + d.getTime());
        const now = d.getTime();
        const distance = expire - now;
        if (distance <= 0) {
            return;
        }
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        countdownEl.firstElementChild.innerText = `${
            minutes < 10 ? "0" + minutes : minutes
        }`;
        countdownEl.lastElementChild.innerText = `${
            seconds < 10 ? "0" + seconds : seconds
        }`;
    };
    setInterval(calculatorTimer, 1000);

    //Xử lý mã giảm giá
    const couponForm = checkoutPageEl.querySelector(".coupon-form");
    const couponUsage = checkoutPageEl.querySelector(".coupon-usage");
    if (couponForm && couponUsage) {
        couponForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const couponEl = couponForm.querySelector("input");
            const fieldset = couponEl.closest("fieldset");
            const coupon = couponEl.value;
            const error = couponForm.querySelector(".error");
            error.innerText = "";
            if (!coupon) {
                error.innerText = "Vui lòng nhập mã giảm giá";
                couponEl.focus();
                return;
            }
            //Call API
            const csrfToken =
                document.head.querySelector(`[name="csrf_token"]`).content;
            const verifyCoupon = async () => {
                try {
                    fieldset.disabled = true;
                    const response = await fetch(`/tai-khoan/coupon/verify`, {
                        method: "POST",
                        headers: {
                            "X-Csrf-Token": csrfToken,
                            "Content-Type": "application/json",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({
                            coupon,
                            orderId,
                        }),
                    });
                    const { success, errors, data } = await response.json();
                    if (!success) {
                        throw new Error(errors);
                    }
                    showMessage("Áp dụng mã giảm giá thành công");
                    couponForm.reset(); //Xóa dữ liệu trong form
                    couponForm.classList.add("d-none");
                    couponUsage.classList.remove("d-none");
                } catch (errors) {
                    error.innerText = errors.message;
                } finally {
                    fieldset.disabled = false;
                }
            };
            verifyCoupon();
        });
        const removeCoupon = couponUsage.querySelector(".js-remove-coupon");
        removeCoupon.addEventListener("click", () => {
            couponUsage.classList.add("d-none");
            couponForm.classList.remove("d-none");
            showMessage("Xóa mã giảm giá thành công");
        });
    }
}
