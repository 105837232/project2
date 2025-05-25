<!DOCTYPE html> 
<html lang= "en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Jobs description">
    <meta name="keywords" content="hiring, job, description, salary">
    <meta name="author" content="Tisang Lim">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Job Description</title>
</head>
<body id="body2">
    <!--replaced the header with a php include-->
    <?php include 'header.inc'; ?>
    <aside id="aside">
        <figure>
            <img src="images/Swinburne.png" alt="Swinburne logo" id="swinburne">
        </figure>
        <h2>Study online with Swinburne</h2>
        <p>Swinburne is a world leader in online education. We use interactive and innovative technologies to deliver our online courses and degrees. 
            From vocational education to undergraduate and postgraduate study, Swinburne has online study options at all level. 
            <a href="https://www.swinburne.edu.au/">Learn More</a></p>
    </aside>
    <?php
        require_once("settings.php");
        $conn = mysqli_connect($host, $username, $password, $database);//Database connection
        if(!$conn){
        echo"<p>Database connection failed: " . mysqli_connect_error() . "</p>";
        }else{
            $query ="SELECT * FROM jobs";
            $job = mysqli_query($conn, $query);
            function query($section, $conn, $job_id){
                $stmt = $conn->prepare("SELECT * FROM $section WHERE job_id?");
                $stmt ->bind_param("i", $job_id);
                $stmt ->excute(); 
                $result = $stmt
            }
            if($job && mysqli_num_rows($job) > 0){  //if statement to check the query is successful and there is data 
                while($jobs = mysqli_fetch_assoc($job)){
                    $job_id = htmlspecialchars($jobs['job_id']);
                    $title = htmlspecialchars($jobs['title']);
                    $role = htmlspecialchars($jobs['role']);
                    $type = htmlspecialchars($jobs['type']);
                    $salary_min = htmlspecialchars($jobs['salary_min']);
                    $salary_max = htmlspecialchars($jobs['salary_max']);
                    $location = htmlspecialchars($jobs['location']);
                    $reference_id = htmlspecialchars($jobs['reference_id']);
                    $report_to = htmlspecialchars($jobs['report_to']);
                    $about = htmlspecialchars($jobs['about']);
                    echo"<section class='job'>";
                    echo"<h1 class='h2job'>$title</h1>";
                    echo"<div class='job_description'>";
                    echo"<h3>Job Descriptions</h3>";
                    echo"<ol>";
                    echo"<li>Position: $role $title</li>";
                    echo"<li>Type of Job: $type</li>";
                    echo"<li>Salary Range: $salary_min - $salary_max</li>";
                    echo"<li>Location: $location</li>";
                    echo"<li>Reference Id: $reference_id</li>";
                    echo"<li>Successful Applicant Will Be Reported to: $report_to</li>";
                    echo"</ol>";
                    echo"</div>";                   
                    echo"<div class= \"info\">";
                    echo"<h3>About This Role</h3>";
                    echo"<p>$about</p>";
                    echo"</div>";
                    $responsibility = query("responsibilities", $conn, $job_id);// calling the query function
                    if($responsibility && mysqli_num_rows($responsibility) > 0){ //if statement to check the query is successful and there is data 
                        echo"<div class='responsibilities'>";                    
                        echo"<h3>Key Responsibilities</h3>";
                        echo"<ul>";
                        while($responsibilities = mysqli_fetch_assoc($responsibility)){ //while loop to take all the data 
                            $responsibilities_id = htmlspecialchars($responsibilities['responsibilities_id']);
                            $description = htmlspecialchars($responsibilities['description']);
                            echo"<li>$description</li>\n";
                        }
                        echo"</ul>";
                        echo"</div>";
                    }
                    $qualification = query("qualifications", $conn, $job_id);//calling the query function
                    if($qualification && mysqli_num_rows($qualification)>0){ //if statement to check the query is successful and there is data 
                        echo"<div class='qualification'>";
                        echo"<h3>Required Qualifications and Experiences</h3>";
                        echo"<ul>";
                        while($qualifications = mysqli_fetch_assoc($qualification)){ //while loop to retrive all the data 
                            $qualifications_id = htmlspecialchars($qualifications['qualifications_id']);
                            $description = htmlspecialchars($qualifications['description']);
                            echo"<li>$description</li>";
                        } 
                        echo"</ul>";
                        echo"</div>";
                    }    
                    $benefit = query("benefits", $conn, $job_id);
                    if($benefit && mysqli_num_rows($benefit)>0){ //if statement to check the query is successful and there is data 
                        echo"<div class='benefits'>";
                        echo"<h3>Benifits</h3>";
                        echo"<ul>";
                        while($benefits = mysqli_fetch_assoc($benefit)){ //while loop to retrive all the data 
                            $benefits_id = htmlspecialchars($benefits['benefits_id']);
                            $description = htmlspecialchars($benefits['description']);
                            echo"<li>$description</li>";
                        }
                        echo"</ul>";  
                        echo"</div>";   
                    }
                    echo"<p><a href='apply.php' class='job_apply'>Apply</a></p>";
                    echo"</section>";
                }
            }
        }
        mysqli_close($conn);// close the connection
    ?>
    <!--replaced the footer with a php include-->
      <?php include 'footer.inc'; ?>
      
</body>
</html>