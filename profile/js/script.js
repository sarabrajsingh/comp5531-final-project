$(function () {
    $('#contBtn').click(function (e) {
        e.preventDefault();
        window.location.href = '../profile/profile.php';
    });
    $('#deleteBtn').click(function (e) {
        e.preventDefault();
        window.location.href = '../index.html';
    });
    $('#makePayment').click(function (e) {
        $.ajax({
            url: "db/make-payment.php",// your username checker url
            encode: true,
        }).done(function (data) {
            data = JSON.parse(data)
            console.log(data);
            if (data.success) {
                $('#makePaymentButton').html("Succesfully Made Payment!").css("color", "green");
            }
        });
    });
});