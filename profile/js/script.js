$(function () {
    $('#contBtn').click(function (e) {
        e.preventDefault();
        window.location.href = '../profile/profile.php';
    });
    $('#deleteBtn').click(function (e) {
        e.preventDefault();
        window.location.href = '../index.html';
    });
});