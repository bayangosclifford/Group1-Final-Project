<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ITech Solutions</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
</head>

<body id="page-top">

    <?php

    //Kinukuha yung data mula sa Medium API
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://medium2.p.rapidapi.com/article/c3437dd7556b",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: medium2.p.rapidapi.com",
            "x-rapidapi-key: 230ba6ec2cmsh5f9556d541eb517p1027a9jsnce12aa57b792"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "Error: " . $err;
        exit;
    }

    $data = json_decode($response, true);

    $title = $data['title'] ?? 'No Title';
    $url = $data['url'] ?? '#';
    $image = $data['image_url'] ?? 'default.jpg';
    $author = $data['author'] ?? 'Unknown Author';
    $subtitle = $data['subtitle'] ?? 'No subtitle';
    $published_at = $data['published_at'] ?? 'No date';
    $formattedDate = date('m/d/Y', strtotime($published_at));

    //ETO PHP FUNCTION FOR FEATURED POST
    
    $curl = curl_init();

    $userId = "7189755a43b5";

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://medium2.p.rapidapi.com/user/" . $userId . "/articles",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: medium2.p.rapidapi.com",
            "x-rapidapi-key: 230ba6ec2cmsh5f9556d541eb517p1027a9jsnce12aa57b792"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        die("cURL Error #:" . $err);
    } else {
        // Dinedecode yung JSON response into associative array
        $data = json_decode($response, true);

        if (isset($data['associated_articles'][1], $data['associated_articles'][2], $data['associated_articles'][3], $data['associated_articles'][4])) {
            $first_article = $data['associated_articles'][1];
            $second_article = $data['associated_articles'][2];
            $third_article = $data['associated_articles'][3];
            $fourth_article = $data['associated_articles'][4];
        } else {
            echo "Some keys are missing in the response.";
        }
    }

    // SECOND PROCESS
// FIRST FEAT POST
    
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://medium2.p.rapidapi.com/article/$first_article",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: medium2.p.rapidapi.com",
            "x-rapidapi-key: 230ba6ec2cmsh5f9556d541eb517p1027a9jsnce12aa57b792" // Keep this secure
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $data = json_decode($response, true);

        if (isset($data["title"], $data["url"], $data["author"], $data["published_at"])) {
            $title2 = $data["title"] ?? 'No Title';
            $url2 = $data["url"] ?? '#';
            $author2 = $data["author"] ?? 'Unknown Author';
            $published_at2 = $data["published_at"] ?? 'No date';
            $formattedDate2 = date('m/d/Y', strtotime($published_at2));
        }
    }

    //SECOND FEAT. POST
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://medium2.p.rapidapi.com/article/$second_article",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: medium2.p.rapidapi.com",
            "x-rapidapi-key: 230ba6ec2cmsh5f9556d541eb517p1027a9jsnce12aa57b792" // Keep this secure
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $data = json_decode($response, true);

        if (isset($data["title"], $data["url"], $data["author"], $data["published_at"])) {
            $title3 = $data["title"] ?? 'No Title';
            $url3 = $data["url"] ?? '#';
            $author3 = $data["author"] ?? 'Unknown Author';
            $published_at3 = $data["published_at"] ?? 'No date';
            $formattedDate3 = date('m/d/Y', strtotime($published_at3));
        }
    }

    // THIRD FEAT POST
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://medium2.p.rapidapi.com/article/$third_article",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: medium2.p.rapidapi.com",
            "x-rapidapi-key: 230ba6ec2cmsh5f9556d541eb517p1027a9jsnce12aa57b792" // Keep this secure
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $data = json_decode($response, true);

        if (isset($data["title"], $data["url"], $data["author"], $data["published_at"])) {
            $title4 = $data["title"] ?? 'No Title';
            $url4 = $data["url"] ?? '#';
            $author4 = $data["author"] ?? 'Unknown Author';
            $published_at4 = $data["published_at"] ?? 'No date';
            $formattedDate4 = date('m/d/Y', strtotime($published_at4));
        }
    }

    //FOURTH FEAT POST
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://medium2.p.rapidapi.com/article/$fourth_article",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: medium2.p.rapidapi.com",
            "x-rapidapi-key: 230ba6ec2cmsh5f9556d541eb517p1027a9jsnce12aa57b792" // Keep this secure
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $data = json_decode($response, true);

        if (isset($data["title"], $data["url"], $data["author"], $data["published_at"])) {
            $title5 = $data["title"] ?? 'No Title';
            $url5 = $data["url"] ?? '#';
            $author5 = $data["author"] ?? 'Unknown Author';
            $published_at5 = $data["published_at"] ?? 'No date';
            $formattedDate5 = date('m/d/Y', strtotime($published_at5));
        }
    }
    ?>

    <!-- Navigation -->
    <nav id="mainNav" class="">
        <div class="container">
            <a class="navigA" href="#page-top">ITech Solutions</a>
            <div class="cont">
                <a class="navigA" href="#home">Home</a>
                <a class="navigA" href="#services">Services</a>
                <a class="navigA" href="#portfolio">Blogs</a>
                <a class="navigA" href="#testimonials">Feedback</a>
                <a class="navigA" href="#about">About Us</a>
                <a class="navigA" href="#contact">Inquiry</a>
            </div>
        </div>
    </nav>

    <!-- Home-->
    <header class="masthead" id="home">
        <h1>ITech Solutions</h1>
        <p>"Building Connections, Crafting Solutions, Empowering Growth."</p>
        <a class="btn" href=<?php echo htmlspecialchars($url); ?>>Find Out More</a>
    </header>

    <!-- Services -->
    <section class="services-section" id="services">
        <h2 class="ss">Services We Offer</h2>
        <div class="service-contain">
            <div class="service-block-one">
                <img src="assets/services/WebDev.png" alt="">
                <p id="title">Website Development</p>
                <p id="description">We create responsive, user-friendly websites to help your business stand out online.
                </p><br>
                <a href="" id="learnMore">Learn more...</a>
            </div>
            <div class="service-block-two">
                <img src="assets/services/SoftDev.png" alt="">
                <p id="title">Software Development</p>
                <p id="description">We develop custom, reliable software solutions to streamline your processes and
                    drive business growth.</p>
                <a href="" id="learnMore">Learn more...</a>
            </div>
            <div class="service-block-three">
                <img src="assets/services/Network.webp" alt="">
                <p id="title">Networking Solutions</p>
                <p id="description">We provide secure, efficient networking solutions to keep your business connected
                    and running
                    smoothly.</p>
                <a href="" id="learnMore">Learn more...</a>
            </div>
        </div>
    </section>
    <hr class="b-ser&port">

    <!-- Blogs -->

    <section id="portfolio" class="portfolio-section" class="blog-featured-posts cl-page-width -marketing">
        <div class="blog">
            <h2>Blogs</h2>
        </div>
        <div class="port-container">
            <div class="blog-post-card-featured ">

                <div class="blog-post-card-featured-image">
                    <img class="blog-image" src="<?php echo htmlspecialchars($image); ?>"
                        alt="<?php echo htmlspecialchars($title); ?>" width="602" height="300">
                </div>

                <div class="blog-card-body">

                    <h2 class="blog-post-card-title">
                        <a href="<?php echo htmlspecialchars($url); ?>" target="_blank">
                            <?php echo htmlspecialchars($title); ?>
                        </a>
                    </h2>

                    <p class="blog-post-card-description"><?php echo htmlspecialchars($subtitle); ?></p>

                    <div class="blog-post-card-footer-first">
                        <p class="blog-post-card-author">Author: ITech Solutions</p>
                        <p class="blog-post-card-date">Date Published: <?php echo htmlspecialchars($formattedDate); ?>
                        </p>
                        <span class="visually-hidden">Updated</span>
                    </div>
                </div>
            </div>

            <!--Featured Post-->


            <div class="blog-featured-category-posts -home">
                <div class="blog-featured-category-posts-header">
                    <h2>Featured Posts</h2>
                    <hr class="footer-feature">
                </div>
                <div class="blog-featured-category-posts-content -home">

                    <div class="blog-post-card  -horizontal   -noImage  ">

                        <div class="blog-post-card-body">

                            <h3 class="blog-post-card-title"> <a href="<?php echo htmlspecialchars(string: $url2); ?>"
                                    class="keychainify-checked"><?php echo htmlspecialchars(string: $title2); ?></a>
                            </h3>
                            <div class="blog-post-card-footer">
                                <p class="blog-post-card-author">ITech Solutions
                                </p>
                                <p class="blog-post-card-date"><?php echo htmlspecialchars($formattedDate); ?>
                                </p>
                                <hr class="blog-footer">
                            </div>
                        </div>
                    </div>

                    <div class="blog-post-card  -horizontal   -noImage  ">

                        <div class="blog-post-card-body">

                            <h3 class="blog-post-card-title"> <a href="<?php echo htmlspecialchars($url3); ?>"
                                    class="keychainify-checked"><?php echo htmlspecialchars($title3); ?></a>
                            </h3>

                            <div class="blog-post-card-footer">
                                <p class="blog-post-card-author">ITech Solutions</p>
                                <p class="blog-post-card-date"><?php echo htmlspecialchars($formattedDate); ?>
                                </p>
                                <hr class="blog-footer">
                            </div>
                        </div>
                    </div>

                    <div class="blog-post-card  -horizontal   -noImage  ">

                        <div class="blog-post-card-body">

                            <h3 class="blog-post-card-title">
                                <a href="<?php echo htmlspecialchars($url4); ?>"
                                    class="keychainify-checked"><?php echo htmlspecialchars($title4); ?>
                                </a>
                            </h3>

                            <div class="blog-post-card-footer">
                                <p class="blog-post-card-author">ITech Solutions</p>
                                <p class="blog-post-card-date"><?php echo htmlspecialchars($formattedDate); ?>
                                </p>
                                <hr class="blog-footer">
                            </div>
                        </div>
                    </div>

                    <div class="blog-post-card  -horizontal   -noImage  ">

                        <div class="blog-post-card-body">

                            <h3 class="blog-post-card-title"> <a href="<?php echo htmlspecialchars($url5); ?>"
                                    class="keychainify-checked"><?php echo htmlspecialchars($title5); ?></a></h3>

                            <div class="blog-post-card-footer">
                                <p class="blog-post-card-author">ITech Solutions</p>
                                <p class="blog-post-card-date"><?php echo htmlspecialchars($formattedDate); ?>
                                </p>
                                <hr class="blog-footer">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="blog-highlighted-posts">

                <ul class="blog-post-list ">

                    <li class="blog-post-list-item">
            </div>
    </section>
    <hr>
    <!-- Feedbacks-->
    </section>
    <section class="testimonials-section" id="testimonials">
        <div class="testimonial-header">
            <h2>What Our Clients Say</h2>
        </div>
        <div class="slideshow-container">
            <div class="slide fade">
                <div class="testimonial-content">
                    <div class="image-box">
                        <img src="assets/feedback/JohnDoe.jpg" alt="Person 1" class="testimonial-image" />
                    </div>
                    <div class="testimonial-text-wrapper">
                        <div class="testimonial-text">
                            "This service has exceeded my expectations. Highly recommended!"
                        </div>
                        <div class="author">- John Doe</div>
                    </div>
                </div>
            </div>
            <div class="slide fade">
                <div class="testimonial-content">
                    <div class="image-box">
                        <img src="assets/feedback/JaneSmith.jpg" alt="Person 2" class="testimonial-image" />
                    </div>
                    <div class="testimonial-text-wrapper">
                        <div class="testimonial-text">
                            "Absolutely fantastic experience. Will be using again!"
                        </div>
                        <div class="author">- Jane Smith</div>
                    </div>
                </div>
            </div>
            <div class="slide fade">
                <div class="testimonial-content">
                    <div class="image-box">
                        <img src="assets/feedback/AlexJohnson.jpg" alt="Person 3" class="testimonial-image" />
                    </div>
                    <div class="testimonial-text-wrapper">
                        <div class="testimonial-text">
                            "The team was professional and the results were incredible!"
                        </div>
                        <div class="author">- Alex Johnson</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dots-container">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </section>

    <!-- About Us -->
    <section id="about" class="cta-section">
        <div class="groupname">
            <h2>Management Team</h2>
        </div>
        <div class="mycard">
            <div class="card1">
                <div class="card">
                    <div class="card-image">
                        <a href="https://www.linkedin.com/in/clifford-bayangos-bab8a92b5/" target="_blank"><img
                                src="./assets/about-us/ford.jpg" alt="Profile image"></a>
                    </div>
                    <p class="name">Clifford Bayangos</p>
                    <p>Network Administrator</p>
                </div>
            </div>
            <div class="card">
                <div class="card-image">
                    <a href="https://www.linkedin.com/in/marion-jay-amian-248726322//" target="_blank"><img
                            src="./assets/about-us/jay.jpg" alt="Profile image"></a>
                </div>
                <p class="name">Marion Jay Amian</p>
                <p>Senior Web Developer</p>


            </div>

            <div class="card">
                <div class="card-image">
                    <a href="https://www.linkedin.com/in/micah-briones-a6b6312aa?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=an"
                        target="_blank"><img src="./assets/about-us/rald.jpg" alt="Profile image"></a>
                </div>
                <p class="name">Micah Gerald Briones</p>
                <p>Software Developer</p>

            </div>

            <div class="card">
                <div class="card-image">
                    <a href="https://www.linkedin.com/in/christa-mae-carandang-7010122b1/" target="_blank"><img
                            src="./assets/about-us/tame.jpg" alt="Profile image"></a>
                </div>
                <p class="name">Christamae Carandang</p>
                <p>System Administrator</p>
            </div>

            <div class="card">
                <div class="card-image">
                    <a href="https://www.linkedin.com/in/jonas-alabarta-595a32322?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
                        target="_blank"><img src="./assets/about-us/nas.jpg" alt="Profile image"></a>
                </div>
                <p class="name">Jonas Alabarta</p>
                <p>Web Designer</p>

            </div>
    </section>

    <!-- Inquiry -->
    <section id="contact">
        <div class="container-contact">
            <h2>Let's Get In Touch!</h2>
            <p>Send us a message, and we will get back to you as soon as possible!</p>
            <form id="contactForm" action="php/process_form.php" onsubmit="showAlert()" method="post">
                <div class="form-floating">
                    <input type="text" id="name" name="name" placeholder=" " required />
                    <label class="cname" for="name">Full name</label>
                </div>
                <div class="form-floating">
                    <input type="email" id="email" name="email" placeholder=" " required />
                    <label class="cname" for="email">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="tel" id="phone" name="phone" placeholder=" " required />
                    <label class="cname" for="phone">Phone number</label>
                </div>
                <div class="form-floating">
                    <label id="inquire" class="cname" for="inquiryType">Inquiry Type</label>
                    <select id="inquiryType" name="inquiryType" required>
                        <option value="" disabled selected></option>
                        <option value="general">General Inquiry</option>
                        <option value="feedback">Feedback</option>
                    </select>

                </div>
                <div class="form-floating">
                    <textarea id="message" name="message" placeholder=" " required></textarea>
                    <label class="cname" for="message">Message</label>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div>&copy; 2024 - ITech Solutions</div>
    </footer>

    <!-- JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/scripts2.js"></script>
    <script>
        function showAlert() {
            alert("Form submitted successfully!");
        }
    </script>
</body>

</html>