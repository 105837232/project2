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

    <p id="caption">We're looking for</p>
    <aside id="aside">
        <figure>
            <img src="images/Swinburne.png" alt="Swinburne logo" id="swinburne">
        </figure>
        <h2>Study online with Swinburne</h2>
        <p>Swinburne is a world leader in online education. We use interactive and innovative technologies to deliver our online courses and degrees. 
            From vocational education to undergraduate and postgraduate study, Swinburne has online study options at all level. 
            <a href="https://www.swinburne.edu.au/">Learn More</a></p>
    </aside>
    <section class="job"> 
        <?php
            require_once("settings.php");
            $conn = mysqli_connect($host, $username, $password, $database);
            if(!$conn){
                echo"<p>Database connection failed: " . mysqli_connect_error() . "</p>";
            }else{
                $query ="SELECT * FROM jobs";
                $job = mysqli_query($conn, $query);
                function query($section, $conn, $job_id){
                    $query = "SELECT * FROM $section WHERE job_id = $job_id";
                    return mysqli_query($conn, $query);
                }
                if($job && mysqli_num_rows($job) > 0){
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
                        echo"<h2 class='h2job'>$title</h2>";
                        echo"<h3>Job Descriptions</h3>";
                        echo"<ol>";
                        echo"<li>Position: $role $title</li>";
                        echo"<li>Type of Job: $type</li>";
                        echo"<Li>Salary Range: $salary_min - $salary_max</Li>";
                        echo"<li>Location: $location</li>";
                        echo"<li>Reference Id: $reference_id</li>";
                        echo"<li>Successful Applicant Will Be Reported to: $report_to</li>";
                        echo"</ol>";
                        echo"<h3>About This Role</h3>";
                        echo"<p>$about</p>" ;
                        $responsibility = query("responsibilities", $conn, $job_id);
                        echo"<h3>Key Responsibilities</h3>";
                        if($responsibility && mysqli_num_rows($responsibility) > 0){
                            echo"<ul>";
                            while($responsibilities = mysqli_fetch_assoc($responsibility)){
                                $responsibilities_id = htmlspecialchars($responsibilities['responsibilities_id']);
                                $description = htmlspecialchars($responsibilities['description']);
                                echo"<li>$description</li>\n";
                            }
                            echo"</ul>";
                        }
                        $qualification = query("qualifications", $conn, $job_id);
                        if($qualification && mysqli_num_rows($qualification)>0){
                            echo"<h3>Required Qualifications and Experiences</h3>";
                            echo"<ul>";
                            while($qualifications = mysqli_fetch_assoc($qualification)){ 
                                $qualifications_id = htmlspecialchars($qualifications['qualifications_id']);
                                $description = htmlspecialchars($qualifications['description']);
                                echo"<li>$description</li>";
                            } 
                            echo"</ul>";
                        }    
                        $benefit = query("benefits", $conn, $job_id);
                        if($benefit && mysqli_num_rows($benefit)>0){
                            echo"<h3>Benifits</h3>";
                            echo"<ul>";
                            while($benefits = mysqli_fetch_assoc($benefit)){
                                $benefits_id = htmlspecialchars($benefits['benefits_id']);
                                $description = htmlspecialchars($benefits['description']);
                                echo"<li>$description</li>";
                            }
                            echo"</ul>";    
                        }
                    }
                }
            }
        ?>
            <h2 class="h2job">Cybersecurity Specialist</h2><!--search prompt was job description for hiring senior cybersecurity specialist-->
                <h3>Job Descriptions</h3>
                <ol>
                    <li>Position: Senior Cybersecurity Specialist</li>
                    <li>Type of Job: Full Time</li>
                    <Li>Salary Range: &dollar;140 000 - &dollar;200 000</Li><!--search prompt was job salary for senior cybersecurity specialist-->
                    <li>Location: Hawthorn, Melbourne, VIC</li>
                    <li>Reference Id: REF001</li>
                    <li>Successful Applicant Will Be Reported to: Chief Information Security Officer</li><!--search prompt wasThe title of the position to whom the senior cybersecurity applicant will report-->
                </ol> 
                <h3>About This Role</h3>
                    <p>As a Senior Cyber Security Specialist, you will be responsible for proactively identifying, assessing, and mitigating cyber security risks, 
                        leading incident response efforts, and contributing to the development and implementation of our cybersecurity strategy. You will work closely 
                        with other IT and business teams to ensure a robust and resilient security posture.  
                    </p>            
                <h3>Key Responsibilities</h3>
                    <ul>
                        <li>Monitor security systems and tools for suspicious activity, analyzing events and alerts to identify potential threats.</li>
                        <li>Contribute to the development and implementation of cybersecurity policies, standards, and procedures.</li>
                        <li>Possess in-depth knowledge of various security technologies, including firewalls, intrusion detection/prevention systems, SIEM tools, and endpoint security solutions.</li>
                        <li>Collaborate with other IT and business teams to ensure security requirements are met.</li>
                        <li>Conduct root cause analysis of security incidents to identify vulnerabilities and prevent future occurrences.</li>
                    </ul>
                <h3>Required Qualifications and Experiences</h3>
                    <ul>
                        <li>Bachelor's degree in Computer Science, Information Technology, or a related field. </li>
                        <li>7+ years of experience in cybersecurity, with a focus on incident response, threat detection, and security strategy. </li>
                        <li>Experience with security tools and technologies, including firewalls, intrusion detection/prevention systems, SIEM tools, and endpoint security solutions. </li>
                        <li>Excellent communication, interpersonal, and problem-solving skills. </li>
                        <li>Relevant industry certifications (e.g., CISSP, CEH, CISM) are preferred. </li>
                    </ul>              
                <h3>Benifits</h3>
                    <ul>
                        <li>Competitive salary and benefits package.</li>
                        <li>Professional development and training opportunities.</li>
                        <li>A challenging and rewarding career path in cybersecurity.</li>
                    </ul>
                    
            <p><strong>Interested?</strong> Please apply through this <a href="apply.html">links</a></p>
    </section>

    
    <!--replaced the footer with a php include-->
      <?php include 'footer.inc'; ?>
      
</body>