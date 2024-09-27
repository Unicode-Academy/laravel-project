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

    const expire = new Date(paymentDate).getTime() + 1000 * 60 * 5;
    const countdownEl = checkoutPageEl.querySelector(".countdown");
    const calculatorTimer = () => {
        const now = new Date().getTime();
        const distance = expire - now;
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
