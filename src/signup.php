<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css" />
    <link rel="stylesheet" href="../assets/css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>AutoHub | Register</title>
</head>

<body>
    <header class="header" id="home">
        <div class="container">
            <nav class="navigation-bar">
                <a href="/src/index.php" class="logo"><img src="../assets/racing.svg"> AutoHub</a>

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

    <main class="container section">
        <form class="form card form--login" method="post" action="../admin/auth/signup.inc.php">
            <h2 class="">Register Admin</h2>
            <div class="form_field">
                <label for="">Name</label>
                <div class="">
                    <span><i class="fa-solid fa-lg fa-envelope"></i></span>
                    <input type="text" name="name" placeholder="Full Name">
                </div>
            </div>
            <div class="form_field">
                <label for="">Email</label>
                <div class="">
                    <span><i class="fa-solid fa-lg fa-envelope"></i></span>
                    <input type="text" name="email" placeholder="name@mail.com">
                </div>
            </div>
            <!-- <div class="form_field">
                <label for="">Username</label>
                <div class="">
                    <span><i class="fa-solid fa-lg fa-envelope"></i></span>
                    <input type="text" name="uid" placeholder="Username">
                </div>
            </div> -->
            <div class="form_field">
                <label for="">Password</label>
                <div class="">
                    <span><i class="fa-solid fa-lg fa-user-lock"></i></span>
                    <input type="password" name="pwd" placeholder="Password">
                </div>
            </div>
            <div class="form_field">
                <label for="">Repeat Password</label>
                <div class="">
                    <span><i class="fa-solid fa-lg fa-user-lock"></i></span>
                    <input type="password" name="pwdRepeat" placeholder="Repeat Password">
                </div>
            </div>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p class='error'>Fill in all fields!</p>";
                } elseif ($_GET["error"] == "invaliduid") {

                    echo "<p class='error'>Choose a proper username!</p>";
                } elseif ($_GET["error"] == "invalidemail") {

                    echo "<p class='error'>Choose a proper email!</p>";
                } elseif ($_GET["error"] == "passwordsdontmatch") {

                    echo "<p class='error'>Passwords doesn't match!</p>";
                } elseif ($_GET["error"] == "stmtfailed") {

                    echo "<p class='error'>Something went wrong, try again!</p>";
                } elseif ($_GET["error"] == "emailtaken") {

                    echo "<p class='error'>Username already taken!</p>";
                } elseif ($_GET["error"] == "none") {

                    echo "<p class='error'>You have signed up!</p>";
                }
            }
            ?>

            <button type="submit" name="submit" class="btn btn--primary">Sign Up</button>
            <p>Already Have an Account? <a href="/src/login.php" class="accent">Login Now</a></p>
        </form>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="left-wrapper">
                <div class="">
                    <a href="/src/index.php" class="logo"><img src="../assets/racing.svg"> AutoHub</a>
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

    <!-- SCRIPTS -->
    <script src="../assets/js/form.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>