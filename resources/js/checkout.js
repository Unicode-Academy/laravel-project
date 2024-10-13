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
}
