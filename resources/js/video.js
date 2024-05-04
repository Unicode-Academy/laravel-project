import videojs from "video.js";

window.addEventListener("DOMContentLoaded", () => {
    const modalEl = document.querySelector("#modal");
    const trialBtnList = document.querySelectorAll(".trial-btn");
    if (trialBtnList.length) {
        trialBtnList.forEach((trialBtn) => {
            trialBtn.addEventListener("click", (e) => {
                const initialBtn = e.target.innerText;
                const id = e.target.dataset.id;
                if (!id) {
                    alert("Không mở được video học thử");
                    return;
                }

                const modal = new bootstrap.Modal(modalEl);

                //Call tới Server để trả về video (csrf token)

                const url = trialUrl + "/" + id;
                e.target.innerText = "Đang mở...";
                fetch(url)
                    .then((response) => {
                        return response.json();
                    })
                    .then(({ success, data }) => {
                        if (!success) {
                            alert("Bài giảng không tồn tại");
                            return;
                        }
                        if (data.is_trial != 1) {
                            alert("Không được phép học thử");
                            return;
                        }
                        const name = data.name;
                        const videoUrl = data.video.url;
                        modal.show();
                        modalEl.querySelector(".modal-title").innerText = name;
                        modalEl.querySelector(".modal-body").innerHTML = `
                    <video id="my-video"
                    class="video-js"
                    preload="auto"
                    controls
                    data-setup="{}">
                        <source src="/data/stream?video=${videoUrl}" type="video/mp4" />
                <p class="vjs-no-js">
                To view this video please enable JavaScript
                </p>
                    </video>
                `;
                    })
                    .finally(() => {
                        e.target.innerText = initialBtn;
                        const myVideoEl = modalEl
                            .querySelector(".modal-body")
                            .querySelector("#my-video");
                        videojs(myVideoEl);
                    });
            });
        });
    }

    modalEl.addEventListener("hidden.bs.modal", (e) => {
        modalEl.querySelector(".modal-title").innerText = "";
        modalEl.querySelector(".modal-body").innerText = "";
    });
});
