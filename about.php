<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta name="description" content="About us page" >
    <meta name="keywords" content="HTML, About Members," >
    <meta name="author" content="Anna Sakaida"  >
    <title>About JigSaw</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <!--replaced the header with a php include-->
    <?php include 'header.inc'; ?>

    <main>
        <div class="photo-info-container">

            <!--Required description list for contributions of team members-->
            <section class="contribution">
                <h2>Team members contribution to this project</h2>  
                <dl>
                    <dt><strong>Anna Sakaida</strong></dt>
                        <dd>Developed the about.html page. Led the team as the Group Leader by setting internal deadlines, ensuring all project requirements were met, and maintaining progress in line with the initial timeline. Contributed to the design of the header. Created an EOI table, that stores the Job reference number, first name, last name, Adresses etc. And finaly created adding a validated records for the EOI table </dd>
                    <dt><strong>Teagan O'Shannassy</strong></dt>
                        <dd>Developed the index.html page and served as the primary liaison with tutors by posting queries on the discussion board. Contributed to the foundational structure for the header and footer. Added the documnet managment.php which holds a HR mannager querries</dd>
                    <dt><strong>Joshua Thai</strong></dt>
                        <dd>Developed the apply.html page and contributed in designing the header and footer, and provided ongoing support for HTML and CSS troubleshooting across all pages. Added a header.inc and footer.inc replacing the common html comments, creating a settings.php and finally updating the contribution on the about page</dd>
                    <dt><strong>Tisang Lim</strong></dt>
                        <dd>Developed the job.html page and managed the Jira board, ensuring tasks were correctly structured and aligned with project standards. Further enhanced the jobs description page</dd>
                </dl>
            </section>
 
        <!--Group Information and Picture stacked-->
        <!--Group Picture-->
            <div class="info">
                <figure class="group-photo">
                    <img src="images/group-photo.jpg" alt="group photo of G04">
                </figure>

            <!--Required Nestled List for Class and Member info-->
                <section class="Class-info">
                    <dl>
                        <dt><strong>G04 Thursday 12:30-2:30pm</strong></dt>
                        <dd><h3>Tutor: Rahul Raghavan</h3>
                            <ul>
                                <li>Anna Sakaida 105837232</li>
                                <li>Teagan O'Shannassy 105919855</li>
                                <li>Joshua Thai 105934191</li>
                                <li>Tisang Lim 105736847</li>
                            </ul>
                        </dd>
                    </dl>
                </section>
            </div>
        </div>

    <!--Table for members interests-->
    <section class="members-interests">
        <table>
            <caption><h2><strong>Introduction to the team</strong></h2></caption>
            <thead>
                <tr>
                    <td class="mphoto"><img src="images/anna.jpg" alt="Pic of Anna"></td>
                    <td class="mphoto"><img src="images/teagan.jpg" alt="Pic of Teagan"></td>
                    <td class="mphoto"><img src="images/josh.jpg" alt="Pic of Josh"></td>
                    <td class="mphoto"><img src="images/tisang.jpg" alt="Upside down pic of Tisang"></td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th>Anna Sakaida</th>
                    <th>Teagan O'Shannassy</th>
                    <th>Joshua Thai</th>
                    <th>Tisang Lim</th>
                </tr>
                <!-- Anna's Interest-->
                <tr>
                    <td class="interest-info">
                        <p><strong>20 | She/Her | Japanese &amp; English | Japan, Tokyo</strong></p>
                        <p>Aspiring to be a game designer!</p>
                        <p>Things that I love: </p>
                        <ul>
                            <li>Gaming
                                <ul>
                                    <li>Marvel Rivals</li>
                                    <li>Sims 4</li>
                                </ul>
                            </li>
                            <li>Dancing
                                <ul>
                                    <li>K-pop</li>
                                    <li>Cheerleading</li>
                                </ul>
                            </li>
                            <li>Listening to Music
                                <ul>
                                    <li>Conan Gray</li>
                                    <li>Stray Kids</li>
                                    <li>Billie Eilish</li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                    <!-- Teagan's Interest-->
                    <td class="interest-info">
                        <p><strong>19 | She/Her | English | Australia, Mornington Peninsula</strong></p>
                        <p>Aspiring to be a Cyber Security Analyst!</p>
                        <p>Things that I love: </p>
                        <ul>
                            <li>Movie:
                                <ul>
                                    <li>Grown Ups</li>
                                </ul>
                            </li>
                            <li>Anime:
                                <ul>
                                    <li>Dr Stone</li>
                                    <li>One Piece</li>
                                    <li>Attack On Titan</li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                    <!-- Joshua's Interest-->
                    <td class="interest-info">
                        <p><strong>18 | He/Him | Cantonese &amp; English | Australia, Sydney</strong></p>
                        <p>Aspiring to own a mechanic shop!</p>
                        <p>Things that I love: </p>
                        <ul>
                            <li>Movie
                                    <ul>
                                        <li>Interstellar</li>
                                    </ul>
                                </li>
                                <li>Anime
                                    <ul>
                                        <li>Horimiya</li>
                                    </ul>
                            </li>
                        </ul>
                    </td>
                    <!-- Tisang's Interest-->
                    <td class="interest-info">
                        <p><strong>18 | He/Him | Khmer &amp; English | Cambodia, Phnom Penh</strong></p>
                        <p>Aspiring to be a Software Developer!</p>
                        <p>Things that I love: </p>
                        <ul>
                            <li>Movie
                                <ul>
                                    <li>The Gladiator II
                                </ul>
                            </li>
                            <li>Anime
                                <ul>
                                    <li>One Piece</li>
                                    <li>Naruto</li>
                                    <li>Initial D</li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

    <!--Footer Section-->
    <!--replaced the footer with a php include-->
      <?php include 'footer.inc'; ?>
</body>



</html>