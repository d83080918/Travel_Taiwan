$(function () {
    $("#login").on("click", function () {
        location.href =
            "/member/login?redirect=" +
            encodeURIComponent(location.href);
    });
});
