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
}
