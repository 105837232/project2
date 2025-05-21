<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Job Application Page">
    <meta name="keywords" content="Job, Application, Form, HTML, CSS">
    <meta name="author" content="Joshua Thai">
    <title>Job Application</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>

    <br>
    <h2 id="applyh2">Job Application Form</h2>
    <div class="container">
        <main>
            <form action="process_eoi.php" method="post" novalidate="novalidate">
            <fieldset class="jobref">
                <legend>Job Reference Number</legend>
                <p> <label for = "referenceNumber">Select a Job Reference Number</label>
                    <select name = "referenceNumber" id = "referenceNumber" required="required">
                        <option value="" disabled selected>Select a Reference Number</option>
                        <option value="REF001">REF001: Senior Cybersecurity Specialist</option>
                        <option value="REF002">REF002: Junior Software Developer</option> 
                        <option value="REF003">REF003: Entry-Level Data Analyst</option>
                    </select>
                </p>
            </fieldset>
            <fieldset class="personal">
                <legend>Personal Details</legend>
                <p>
                    <label for = "firstName">First Name</label>
                    <input type = "text" name = "firstName" id = "firstName" maxlength = "20" required="required" placeholder="e.g., John">
                </p>
                <p>
                    <label for = "lastName">Last Name</label>
                    <input type = "text" name = "lastName" id = "lastName" maxlength = "20" required="required" placeholder="e.g., Doe">
                </p>
                <p>
                    <label for="date">Date of Birth</label>
                    <input type="date" name="date" id="date" required>
                </p>
            </fieldset>
            <fieldset class="gender">
                <legend>Gender</legend>
                <input type = "radio" name = "gender" id = "Male" value = "Male" required="required">
                <label for = "Male">Male</label>

                <input type = "radio" name = "gender" id = "Female" value = "Female" required="required">
                <label for = "Female">Female</label>

                <input type = "radio" name = "gender" id = "Other" value = "Other" required="required">
                <label for = "Other">Other</label>
            </fieldset> 
            <fieldset class="postal">
                <legend>Current Address</legend>
                <p>
                    <label for = "address">Address</label>
                    <input type = "text" name = "address" id = "address" maxlength = "40" required="required" placeholder="e.g., 123 Main St">
                </p>
                <p>
                    <label for = "suburb">Suburb/Town</label>
                    <input type = "text" name = "suburb" id = "suburb" maxlength = "40" required="required" placeholder="e.g., Somewhere">
                </p>
                <p>
                    <label for = "state">State</label>
                    <select name = "state" id = "state" required="required">
                        <option value="" disabled selected>Select a State</option>
                        <option value="ACT">Australian Capital Territory</option>
                        <option value="NSW">New South Wales</option>
                        <option value="NT">Northern Territory</option>
                        <option value="QLD">Queensland</option>
                        <option value="SA">South Australia</option>
                        <option value="TAS">Tasmania</option>
                        <option value="VIC">Victoria</option>
                        <option value="WA">Western Australia</option>
                    </select>
                </p>
                <p>
                    <label for = "postcode">Postcode</label>
                    <input type = "text" name = "postcode" id = "postcode" maxlength = "4" minlength = "4" required placeholder="e.g., 3000">
                </p>
            </fieldset>
            <fieldset class="contactdetails">
                <legend>Contact Details</legend>
                <p>
                    <label for="email">Email</label>
                    <input type="email" name = "email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="e.g., name@example.com" required>
                </p>
                <p>
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" pattern="[0-9]{8,10}" maxlength="10" placeholder="e.g., 0412345678" required>
                </p>
            </fieldset>
            <fieldset class="education">
                <legend>Skills </legend>
                <h3>Technical Skills</h3>
                <p>
                    <input type = "checkbox" name = "skills[]" id = "html" value = "HTML">
                    <label for = "html">HTML</label>

                    <input type = "checkbox" name = "skills[]" id = "css" value = "CSS">
                    <label for = "css">CSS</label>

                    <input type = "checkbox" name = "skills[]" id = "javascript" value = "JavaScript">
                    <label for = "javascript">JavaScript</label>

                    <input type = "checkbox" name = "skills[]" id = "php" value = "PHP">
                    <label for = "php">PHP</label>

                    <input type = "checkbox" name = "skills[]" id = "mysql" value = "MySQL">
                    <label for = "mysql">MySQL</label>
                </p>
                <p>
                    <input type="checkbox" name="other_skills_checkbox" id="other_skills_checkbox">
                    <label for="other_skills_checkbox">Other Skills</label>
                </p>
                <p>
                    <textarea name = "otherSkillsDescription" id = "otherSkillsDescription" rows = "5" cols = "60" placeholder = "Please list any other skills you have, e.g., Project Management, Public Speaking..." disabled></textarea>
                </p>
            </fieldset>
            <div class="submition">
                <input type = "submit" value = "Apply Now">
                <input type = "reset" value = "Reset Form">
            </div>
            </form>
        </main>
    </div>
    <br>
    <?php include 'footer.inc'; ?>

    <script src="scripts/apply.js"></script>
</body>
</html>