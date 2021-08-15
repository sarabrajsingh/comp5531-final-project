$(function () {
    $('#postNewJobTab').click(function (e) {
        $(".card-body").load("containers/post-new-job-page.php");
    });
    $('#searchJobTab').click(function (e) {
        $(".card-body").load("containers/search-for-jobs-page.php");
    });
    $('#recentJobsTab').click(function (e) {
        $(".card-body").load("containers/recent-jobs-page.php");
    });
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
                "upperSal   aryAmount": $('#upperSalaryAmount').val(),
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
    $('#addNewJobType').click(function (e) {
        e.preventDefault();
        if ($('#addCustomJob').val() == "") {
            $('#addNewJobTypeSpanMessage').html("enter a custom job type").css("color", "red");
        } else {
            $.ajax({
                url: "add-new-job-type.php",
                type: "POST",
                datatype: "JSON",
                data: {
                    "addCustomJob": $('#addCustomJob').val()
                },
                encode: true
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (!data.success) {
                    $('#addNewJobTypeSpanMessage').html("Error Creating Job Type - check values").css("color", "red");
                }
                if (data.success) {
                    // reset form after success
                    $('#saveJobForm').trigger("reset");
                    alert("Successfully Added Custom Job Type!");
                    location.reload();
                }
            });
        }
    });
});