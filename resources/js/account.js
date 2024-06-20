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
    const updateProfile = async (formData, token) => {
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
        if (errors) {
            showErrors(errors);
        } else {
            //Hiển thị thông báo khi cập nhật DB
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
