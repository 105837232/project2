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
    <form method="GET" id = "searchbar"> <!-- for the search function -->
        <input type="text" name="search" placeholder="Search jobs...">
        <button type="submit" id ="search">Search</button>
    </form>
    <?php
        require_once("settings.php");
        $conn = mysqli_connect($host, $username, $password, $database);//Database connection
        if(!$conn){
        echo"<p>Database connection failed: " . mysqli_connect_error() . "</p>";
        }else{  
            $query = "SELECT * FROM aside"; // retrive info from the aside table 
            $aside = mysqli_query($conn, $query); 
            $asides = mysqli_fetch_assoc($aside); 
            $intro = $asides['title'];
            $body = $asides['description'];
            $link = $asides['link'];
            $image = $asides['image_path'];
            $css = $asides['css_id'];
            echo "<aside id='aside'>";
            echo "<figure><img src= $image alt='Swinburne logo' id='swinburne'></figure>";
            echo "<h2>$intro</h2>";
            echo "<p>";
            echo "$body";
            echo "<a href=$link>Learn More</a>";
            echo "</p>";
            echo "</aside>";
            $search = htmlspecialchars(trim(isset($_GET['search'])));
            if (!empty($search)){  // use of AI to change from isset to empty for better functionality     
                $query = "SELECT * FROM jobs WHERE title LIKE ?";
                $stmt = $conn->prepare($query);
                $searchTerm = "%$search%";
                $stmt->bind_param("s", $searchTerm);
                $stmt->execute();
                $job = $stmt->get_result();
            } else {  
                $query = "SELECT * FROM jobs";
                $job = mysqli_query($conn, $query);
            }
            function listSectionOfJob($section, $conn, $job_id, $title, $class){ // function to take the job_id and echo all of the section
                $stmt = $conn->prepare("SELECT * FROM $section WHERE job_id = ?"); // prepare statement use to prevent sql injection
                $stmt ->bind_param("i", $job_id);
                $stmt ->execute(); 
                $result = $stmt->get_result();
                if($result && mysqli_num_rows($result) > 0){ //if statement to check the query is successful and there is data 
                        echo"<div class='$class'>";                    
                        echo"<h3>$title</h3>";
                        echo"<ul>";
                        while($row = mysqli_fetch_assoc($result)){ //while loop to take all the data 
                            $description = htmlspecialchars($row['description']);
                            echo"<li>$description</li>\n";
                        }
                        echo"</ul>";
                        echo"</div>";
                }
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
                    echo"<h2 class='h2job'>$title</h2>";
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
                    listSectionOfJob("responsibilities", $conn, $job_id, "Key Responsibilities", "responsibilities"); //function called 
                    listSectionOfJob("qualifications", $conn, $job_id, "Qualifications and Experiences", "qualification");
                    listSectionOfJob("benefits", $conn, $job_id, "Benefits", "benefits");
                    echo"<p><a href='apply.php' class='job_apply'>Apply</a></p>";
                    echo"</section>";
                }
            }else{ 
                echo"<p> We currently not hiring</p>";
            }
        }
        mysqli_close($conn);// close the connection
    ?>
    <!--replaced the footer with a php include-->
    <?php include 'footer.inc'; ?>
      
</body>
</html>