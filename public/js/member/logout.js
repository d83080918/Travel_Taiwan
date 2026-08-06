$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $("#logout1,#logout2").on("click", function () {
        Swal.fire({
            title: "確定要登出嗎?",
            showDenyButton: true,
            confirmButtonText: "確定",
            denyButtonText: `取消`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/member/logout",
                    type: "POST",

                    success: function (res) {

                        if (res.status == "success") {
                            Swal.fire({
                                title: "登出成功",
                                confirmButtonText: "確定",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = "/attraction/home";
                                }
                            });
                        }

                    }
                });
            }
        });
    });
});