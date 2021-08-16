$(function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const jobID = urlParams.get('jobID');

    $.ajax({
        url: "db/get-job-from-db.php",// your username checker url
        type: "POST",
        datatype: "JSON",
        data: {
            "jobID": jobID
        },
        encode: true,
    }).done(function (data) {
        data = JSON.parse(data)
        console.log(data);
        if (data.success) {
            document.getElementById('jobTitle').value = data.response.jobName;
            document.getElementById('companyName').value = data.response.companyName;
            document.getElementById('datePosted').value = data.response.datePosted;
            document.getElementById('jobCategory').value = data.response.jobCategory;
            if (data.response.upperSalaryLimit) {
                document.getElementById('salaryRange').value = data.response.lowerSalaryLimit + "-" + data.response.upperSalaryLimit;
            } else {
                document.getElementById('salaryRange').value = data.response.lowerSalaryLimit;
            }
            document.getElementById('description').value = data.response.description;
        }
    });
    $('#applyButton').click(function (e) {
        $.ajax({
            url: "db/apply-for-job.php",// your username checker url
            type: "POST",
            datatype: "JSON",
            data: {
                "jobID": jobID,
                "companyName": document.getElementById('companyName').value
            },
            encode: true,
        }).done(function (data) {
            data = JSON.parse(data)
            if (data.success) {
                document.getElementById("applyButton").disabled = true;
                $('#applyButtonMessage').html("Successfully Applied for Job!").css("color", "green");
            }
        });
    });
});