$(function () {
    // $('#saveButton').click(function e() {
    //     $('#saveJobForm').submit();
    // });
    $('#saveButton').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "post-job.php",
            type: "POST",
            datatype: "JSON",
            data: {
                "jobName": $('#jobName').val(),
                "jobCategory": $('#jobCategory').val(),
                "companyName": $('#companyName').val(),
                "lowerSalaryAmount": $('#lowerSalaryAmount').val(),
                "upperSalaryAmount": $('#upperSalaryAmount').val(),
                "description": $('#description').val()
            },
            encode: true
        }).done(function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (!data.success) {
                $('#saveButtonMessage').html("Error Saving Job - check values").css("color", "red");
            }
            if (data.success) {
                $('#saveButtonMessage').html("Successfully Created Job!").css("color", "green");
                // reset form after success
                $('#saveJobForm').trigger("reset");
            }
        });
    });
});