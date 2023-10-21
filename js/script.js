$(document).ready(function () {
    $('.menu-btn').click(function () {
        $('.header__nav').toggleClass('display-none-mobile');
        $('.menu-btn').toggleClass('menu-btn-active');
    });
    $("#phone").mask("+375(99) 999-99-99");
});

// $('.feedback-button').on('click', function () {
//     $.get("mail.php");
// });








