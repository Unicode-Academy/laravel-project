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
    const csrfToken =
        document.head.querySelector(`[name="csrf_token"]`).content;
    const discountValueEl = checkoutPageEl.querySelector(".discount-value");
    const totalValueList = checkoutPageEl.querySelectorAll(`.total-value`);
    const qrImgEl = checkoutPageEl.querySelector(".qr-img");
    let qrUrl = qrImgEl.src;
    let controller = new AbortController();
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

                    //Cập nhật giao diện
                    couponUsage.querySelector(".coupon-value").innerText =
                        coupon;

                    discountValueEl.innerText =
                        data.discount.toLocaleString() + " đ";
                    totalValueList.forEach((el) => {
                        el.innerText =
                            data.total_after_discount.toLocaleString() + " đ";
                    });

                    //Cập nhật mã qr mới
                    qrUrl = qrUrl.replace(
                        /amount=(\d+)/,
                        "amount=" + data.total_after_discount
                    );
                    qrImgEl.src = qrUrl;
                    pollingCoupon();
                } catch (errors) {
                    error.innerText = errors.message;
                } finally {
                    fieldset.disabled = false;
                }
            };
            verifyCoupon();

            const pollingCoupon = async () => {
                try {
                    const response = await fetch(`/tai-khoan/coupon/polling`, {
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
                        signal: controller.signal,
                    });
                    if (!response.ok) {
                        throw new Error("Server Error");
                    }
                    const data = await response.json();

                    if (data.errors_server) {
                        throw new Error("Server Error");
                    }

                    if (data && !data.success) {
                        couponUsage.classList.add("d-none");
                        couponForm.classList.remove("d-none");
                        showMessage("Xóa mã giảm giá thành công");

                        //Cập nhật giao diện
                        discountValueEl.innerText = "0";
                        totalValueList.forEach((el) => {
                            el.innerText = data.total.toLocaleString() + " đ";
                        });
                        qrUrl = qrUrl.replace(
                            /amount=(\d+)/,
                            "amount=" + data.total
                        );
                        qrImgEl.src = qrUrl;
                        // isPolling = false;
                    }
                } catch (error) {
                    if (error.message == "Server Error") {
                        pollingCoupon();
                    }
                }
            };
        });
        const removeCouponEl = couponUsage.querySelector(".js-remove-coupon");
        removeCouponEl.addEventListener("click", () => {
            const removeCoupon = async () => {
                controller.abort(); //Hủy request polling
                controller = new AbortController();
                const response = await fetch(`/tai-khoan/coupon/remove`, {
                    method: "POST",
                    headers: {
                        "X-Csrf-Token": csrfToken,
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                    body: JSON.stringify({
                        orderId,
                    }),
                });
                const { success, data } = await response.json();
                if (!success) {
                    return showMessage("Xóa mã giảm giá không thành công");
                }
                couponUsage.classList.add("d-none");
                couponForm.classList.remove("d-none");
                showMessage("Xóa mã giảm giá thành công");

                //Cập nhật giao diện
                discountValueEl.innerText = "0";
                totalValueList.forEach((el) => {
                    el.innerText = data.total.toLocaleString() + " đ";
                });
                qrUrl = qrUrl.replace(/amount=(\d+)/, "amount=" + data.total);
                qrImgEl.src = qrUrl;
                // isPolling = false;
            };
            removeCoupon();
        });
    }

    //Xử lý cập nhật trạng thái đơn hàng
    const orderStatusEl = checkoutPageEl.querySelector(".js-status");
    if (orderStatusEl) {
        const requestOrderStatus = async () => {
            const response = await fetch(
                `http://127.0.0.1:8002/api/students/check-payment/${orderId}`
            );
            if (!response.ok) {
                throw new Error("Server Error");
            }
            const { success, data } = await response.json();
            if (success) {
                const initBg = orderStatusEl.classList[2];
                const newBg = `bg-${data.color}`;
                if (orderStatusEl.innerText !== data.name) {
                    orderStatusEl.classList.replace(initBg, newBg);
                    orderStatusEl.innerText = data.name;
                }
                setTimeout(() => {
                    if (data.is_success) {
                        controller.abort();
                        window.location.href = `/tai-khoan/don-hang/${orderId}`;
                    }
                }, 1000);
            }
        };
        setInterval(requestOrderStatus, 5000);
    }
}
