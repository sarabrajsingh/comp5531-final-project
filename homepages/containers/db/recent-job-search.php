<?php
    require "../../../database/db.php";

    $sql = 'SELECT * FROM jobs order by datePosted desc LIMIT 5;';   
    $result = $con->query($sql);

    $output = array();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $output[] = array(
                "jobID" => $row["jobID"],
                "jobName" => $row["jobName"], 
                "companyName" => $row["companyName"], 
                "datePosted" => $row["datePosted"], 
                "jobStatus" => $row["jobStatus"],
                "description" => $row["description"],
                "lowerSalaryLimit" => $row["lowerSalaryLimit"],
                "upperSalaryLimit" => $row["upperSalaryLimit"],
                "jobCategory" => $row["jobCategory"]);
        }
    }
    $con->close();
    echo(json_encode($output));
?>