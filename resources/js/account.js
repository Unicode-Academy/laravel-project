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
