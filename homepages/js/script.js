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
    $('#createJobOfferTab').click(function (e) {
        $(".card-body").load("containers/create-job-offer.php");
    });
    $('#userManagementTab').click(function (e) {
        $(".card-body").load("containers/user-management.php");
    });
    $('#contactUsTab').click(function (e) {
        $(".card-body").load("containers/contact-us.php");
    });
    $('#myJobOffersTab').click(function (e) {
        $(".card-body").load("containers/my-job-offers.php");
    });
    $('#myAppliedJobs').click(function (e) {
        $(".card-body").load("containers/my-applied-jobs.php");
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
                "upperSalaryAmount": $('#upperSalaryAmount').val(),
                "description": $('#description').val(),
                "numVacancies": $('#numVacancies').val()
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
    $('#searchButton1').click(function (e) {
        $.ajax({
            url: "containers/db/search-job-db.php",
            type: "POST",
            datatype: "JSON",
            data: {
                "jobTitle": $('#jobName').val(),
                "jobCategory": $('#jobCategory').val()
            },
            encode: true
        }).done(function (data) {
            data = JSON.parse(data);
            var resultsContainer = document.getElementById("searchResults1");
            resultsContainer.innerHTML = "";
            for (var i = 0; i < data.length; i++) {
                resultsContainer.innerHTML += "<div id='result_" + i + "'><a href='../../jobs/jobs.php?jobID=" + data[i].jobID + "'><h3>" + data[i].jobName + "</h3>" + data[i].companyName + "</a><div>";
            }
        });
    });
    $('#resetButton1').click(function (e) {
        resultsContainer = document.getElementById("searchResults1");
        resultsContainer.innerHTML = "";
    });
    $('#searchButton2').click(function (e) {
        $.ajax({
            url: "containers/db/search-job-category.php",
            type: "POST",
            datatype: "JSON",
            data: {
                "jobCategory": $('#jobCategory').val()
            },
            encode: true
        }).done(function (data) {
            data = JSON.parse(data);
            var resultsContainer = document.getElementById("searchResults2");
            resultsContainer.innerHTML = "";
            for (var i = 0; i < data.length; i++) {
                resultsContainer.innerHTML += "<div id='result_" + i + "'><a href='../../jobs/jobs.php?jobID=" + data[i].jobID + "'><h3>" + data[i].jobName + "</h3>" + data[i].companyName + "</a><div>";
            }
        });
    });
    $('#resetButton2').click(function (e) {
        resultsContainer = document.getElementById("searchResults2");
        resultsContainer.innerHTML = "";
    });
    $('#showRecentJobsButton').click(function (e) {
        $.ajax({
            url: "containers/db/recent-job-search.php",
            encode: true
        }).done(function (data) {
            data = JSON.parse(data);
            var resultsContainer = document.getElementById("showRecentJobsResults");
            resultsContainer.innerHTML = "";
            for (var i = 0; i < data.length; i++) {
                resultsContainer.innerHTML += "<div id='result_" + i + "'><a href='../../jobs/jobs.php?jobID=" + data[i].jobID + "'><h3>" + data[i].jobName + "</h3>" + data[i].companyName + "</a><div>";
            }
        });
    });
    $('#createJobOfferButton').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "containers/db/submit-job-offer.php",
            type: "POST",
            datatype: "JSON",
            data: {
                "companyName": $('#companyName').val(),
                "selectedJobFromCompany": $('#selectedJobFromCompany').val(),
                "jobOfferForUser": $('#jobOfferForUser').val()
            },
            encode: true
        }).done(function (data) {
            data = JSON.parse(data);
            if (data.success) {
                $('#createJobOfferSpanMessage').html("Successfully Submitted Job Offer to Candidate").css("color", "green");
            }
        });
    });
    $('#enabledSelected').click(function (e) {
        e.preventDefault();
        $('table [type="checkbox"]').each(function (i, chk) {
            if (chk.checked && chk.name === "enabledCheck") {
                console.log("enabled Checked!", i, chk);
                $.ajax({
                    url: "containers/db/submit-job-offer.php",
                    type: "POST",
                    datatype: "JSON",
                    data: {
                        "companyName": $('#companyName').val(),
                        "selectedJobFromCompany": $('#selectedJobFromCompany').val(),
                        "jobOfferForUser": $('#jobOfferForUser').val()
                    },
                    encode: true
                }).done(function (data) {
                    data = JSON.parse(data);
                    if (data.success) {
                        $('#createJobOfferSpanMessage').html("Successfully Submitted Job Offer to Candidate").css("color", "green");
                    }
                });
            }
        });
    });
    $('#disabledSelected').click(function (e) {
        e.preventDefault();
        $('table [type="checkbox"]').each(function (i, chk) {
            if (chk.checked && chk.name === "disabledCheck") {
                console.log("disabled Checked!", i, chk);
                // $.ajax({
                //     url: "containers/db/submit-job-offer.php",
                //     type: "POST",
                //     datatype: "JSON",
                //     data: {
                //         "companyName": $('#companyName').val(),
                //         "selectedJobFromCompany": $('#selectedJobFromCompany').val(),
                //         "jobOfferForUser": $('#jobOfferForUser').val()
                //     },
                //     encode: true
                // }).done(function (data) {
                //     data = JSON.parse(data);
                //     if (data.success) {
                //         $('#createJobOfferSpanMessage').html("Successfully Submitted Job Offer to Candidate").css("color", "green");
                //     }
                // });
                var rows = document.getElementById('table').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                console.log(rows);
            }
        });
    });
});