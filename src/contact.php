<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Document</title>
</head>

<body>
    <?php
    $subject = "";

    if (isset($_POST['subject'])) {
        $subject = $_POST['message'];
    }
    ?>

    <header class="header" id="home">
        <div class="container">
            <nav class="navigation-bar">
                <a href="/src/index.php" class="logo"><img src="../assets/images/racing.svg"> AutoHub</a>

                <a class="mobile-nav-toggle" aria-controls="primary-navigation" aria-expanded="false">
                    <svg stroke="var(--button-color)" fill="none" class="hamburger" viewBox="-10 -10 120 120" width="75">
                        <path class="line" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" d="m 20 40 h 60 a 1 1 0 0 1 0 20 h -60 a 1 1 0 0 1 0 -40 h 30 v 70">
                        </path>
                    </svg>
                </a>

                <ul data-visible="false" class="nav__list">
                    <li><a href="/src/index.php" class=""><i class="fa-solid fa-house"></i><span>HOME</span></a></li>
                    <li><a href="/src/catalog.php"><i class="fa-solid fa-border-all"></i><span>CATALOG</span></a></li>
                    <li><a href="/src/contact.php"><i class="fa-solid fa-phone"></i><span>CONTACT</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="section container contact-us" id="contact">
        <h2 class="section__title">Get In Touch</h2>
        <div class="contact-us__inner card even-columns">
            <div class="left_wrapper contact-info">
                <div>
                    <h4 class="contact__title">Contact Us</h4>
                    <div class="contact-info__details"><span class=""><i class="fa-regular fa-envelope"></i> </span>
                        <p>cardealer@gmail.com</p>
                    </div>
                    <div class="contact-info__details"><span class=""><i class="fa-solid fa-phone"></i> </span>
                        <p>+63 1234 567 891</p>
                    </div>
                    <div class="contact-info__details"><span class=""><i class="fa-solid fa-location-dot"></i></span>
                        <p>Visayan Village. Brgy. Canocotan</p>
                    </div>
                </div>

                <div>
                    <h4 class="contact__title">Working Hours</h4>
                    <p>Mon - Fri: 09:00AM - 09:00PM</p>
                    <p>Sat: 09:00AM - 07:00PM</p>
                    <p>Sun: Closed</p>
                </div>
            </div>
            <div class="right-wrapper ">
                <form class="form" action="mailto:vincealwynsibay1@gmail.com">
                    <div class="form_field"><label for="">Subject</label>
                        <input type="text" name="subject" placeholder="Subject" value="<?= $subject ?>" />
                    </div>
                    <div class="form_field"><label for="">Message</label>
                        <textarea name="" id="" cols="30" rows="10" name="body" placeholder="Write Message"></textarea>
                    </div>
                    <button class="btn  btn--primary">Send</button>
                </form>

            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="left-wrapper">
                <div class="">
                    <a href="/src/index.php" class="logo"><img src="../assets/images/racing.svg"> AutoHub</a>
                    <p>Use securing confined his shutters. Delightful as he it acceptance an solicitude discretion.</p>
                </div>
                <div class="footer__links">
                    <h4 class="footer__title">USEFUL LINKS</h4>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Catalog</a></li>
                        <li><a href="">Contact Us</a> </li>
                    </ul>
                </div>
                <div class="footer__work-hours">
                    <h4 class="footer__title">WORKING HOURS</h4>
                    <ul>
                        <li>Mon - Fri: 09:00AM - 09:00PM</li>
                        <li>Sat: 09:00AM - 07:00PM</li>
                        <li>Sun: Closed</li>
                    </ul>
                </div>
                <div class="footer__contact">
                    <h4 class="footer__title">CONTACT US</h4>
                    <ul>
                        <li class="footer__contact-details">
                            <span><i class="fa-regular fa-envelope"></i></span>
                            <p>cardealer@gmail.com</p>
                        </li>
                        <li class="footer__contact-details">
                            <span><i class="fa-solid fa-phone"></i></span>
                            <p>+63 1234 567 891</p>
                        </li>
                        <li class="footer__contact-details">
                            <span><i class="fa-regular fa-location-dot"></i></span>
                            <p>Visayan Village. Brgy. Canocotan</p>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="right-wrapper">
                <p>© 2023 Car Shop. All rights reserved.</p>
                <a href="/src/login.php" class="btn btn--primary">Access Admin</a>
            </div>

        </div>
    </footer>

    <script src="../assets/js/script.js"></script>
</body>

</html>