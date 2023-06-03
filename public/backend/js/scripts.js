/*!
 * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2022 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }

    const tableList = document.querySelector("#datatable");
    const deleteForm = document.querySelector(".delete-form");
    if (tableList) {
        tableList.addEventListener("click", (e) => {
            if (e.target.classList.contains("delete-action")) {
                e.preventDefault();
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Nếu xóa bạn không thể khôi phục!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok, Đồng ý xóa!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const action = e.target.href;
                        deleteForm.action = action;
                        deleteForm.submit();
                    }
                });
            }
        });
    }

    const getSlug = (title) => {
        //Đổi chữ hoa thành chữ thường
        let slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
        slug = slug.replace(/đ/gi, "d");
        //Xóa các ký tự đặt biệt
        slug = slug.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
            ""
        );
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-/gi, "-");
        slug = slug.replace(/\-\-/gi, "-");
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = "@" + slug + "@";
        slug = slug.replace(/\@\-|\-\@|\@/gi, "");
        return slug;
    };

    const slug = document.querySelector(".slug");
    const title = document.querySelector(".title");
    let isChangeSlug = false;

    if (slug) {
        if (slug.value === "") {
            title.addEventListener("keyup", (e) => {
                if (!isChangeSlug) {
                    const titleValue = e.target.value;
                    slug.value = getSlug(titleValue);
                }
            });
        }

        slug.addEventListener("change", () => {
            if (slug.value === "") {
                const title = document.querySelector(".title");
                const titleValue = title.value;
                slug.value = getSlug(titleValue);
            }
            isChangeSlug = true;
        });
    }

    const logoutAction = document.querySelector(".logout-action");
    const logoutForm = document.querySelector(".logout-form");

    if (logoutAction && logoutForm) {
        logoutAction.addEventListener("click", (e) => {
            e.preventDefault();
            const action = e.target.href;
            logoutForm.action = action;
            logoutForm.submit();
        });
    }
});
