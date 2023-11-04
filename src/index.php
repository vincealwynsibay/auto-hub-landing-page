<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/core-styles.css" />
  <link rel="stylesheet" href="../assets/css/index.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon-32x32.png">
  <title>AutoHub - Find Your Perfect Car</title>
</head>

<body>
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


  <section class="hero section container" id="home">
    <div class="left-wrapper" data-aos="fade-right">
      <h1 class="hero__header">Discover Your <span class="accent">Perfect</span> Car</h1>
      <p class="hero__details">Welcome to AutoHub, Your gateway to a world of automotive excellence. A place for you to connect with us and discover your ideal car.</p>
      <div class="hero__cta-container">
        <a href="/src/contact.php" class="btn btn--primary btn--logo"><i class="fa-solid fa-phone"></i> Contact Us</a>
        <a href="/src/catalog.php" class="btn btn--secondary btn--logo"><i class="fa-solid fa-magnifying-glass"></i> Find a Car</a>
      </div>
    </div>
    <div class="right-wrapper">
      <img data-aos="fade-left" src="../assets/images/hero-banner.png" alt="" />
    </div>
  </section>


  <article class="container find_car" data-aos="fade-up">
    <?php
    $mName = '';
    $sortBy = '';
    $make = '';
    $transmission = '';
    $fuel_type = '';
    $min = 0;
    $max = 10000000;
    if (isset($_GET['done'])) {
      $mName = $_GET['model_name'];
      $make = $_GET['make'];
      $transmission = $_GET['transmission'];
      $fuel_type = $_GET['fuel_type'];
      $min = $_GET['min'];
      $max = $_GET['max'];
    } ?>

    <form id="searchForm" class="form card" method="POST">
      <div class="form_field">
        <label for="">Make</label>
        <select name="make" id="make">
          <option value="">Choose</option>
          <option value="Honda">Honda</option>
          <option value="Toyota">Toyota</option>
          <option value="Ford">Ford</option>
          <option value="Lexus">Lexus</option>
          <option value="BMW">BMW</option>
          <option value="Mercedes Benz">Mercedes Benz</option>
          <option value="Nissan">Nissan</option>
          <option value="Porsche">Porsche</option>
          <option value="Tesla">Tesla</option>
          <option value="Audi">Audi</option>
          <option value="Jaguar">Jaguar</option>
          <option value="Subaru">Subaru</option>
          <option value="Volvo">Volvo</option>
          <option value="Ferrari">Ferrari</option>
          <option value="Volkswagen">Volkswagen</option>
          <option value="Bentley">Bentley</option>
        </select>
      </div>
      <div class="form_field">
        <label for="">Transmission Type</label>
        <select name="transmission" id="transmission">
          <option value="">Choose</option>
          <option value="automatic">Automatic</option>
          <option value="manual">Manual</option>
        </select>
      </div>
      <div class="form_field">
        <label for="">Fuel Type</label>
        <select name="fuel_type" id="fuel_type">
          <option value="">Choose</option>
          <option value="Regular">Regular</option>
          <option value="Diesel">Diesel</option>
          <option value="Premium">Premium</option>
        </select>
      </div>
      <div class="form_field">
        <label for="">Price Range</label>
        <div class="dual-slider">
          <div class="">
            <p class="range-display"><span>₱0</span> - <span>₱10,000,000</span></p>
          </div>
          <div class="slider">
            <div class="progress"></div>
          </div>
          <div class="range-input">
            <input type="range" id="minVal" class="range-min" min="0" max="10000000" value="0" step="10000">
            <input type="range" id="maxVal" class="range-max" min="0" max="10000000" value="10000000" step="10000">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn--logo btn--primary"><i class="fa-solid fa-magnifying-glass"></i>Find Car</button>
    </form>
  </article>

  <section class="section container catalog" data-aos="fade-up" id="catalog">
    <h2 class="section__title">Catalog</h2>

    <div class="catalog__list">
      <?php
      include('../admin/connect_to_database.php');
      $sql = "SELECT * FROM tblcars ORDER BY ID ASC LIMIT 4";

      $result = mysqli_query($conCD, $sql);

      function nFormatter($num, $digits)
      {
        $lookup = [
          ["value" => 1, "symbol" => ""],
          ["value" => 1e3, "symbol" => "k"],
          ["value" => 1e6, "symbol" => "M"]
        ];
        $rx = '/\.0+$|(\.[0-9]*[1-9])0+$/';
        $item = null;
        foreach (array_reverse($lookup) as $entry) {
          if ($num >= $entry["value"]) {
            $item = $entry;
            break;
          }
        }
        if ($item) {
          return preg_replace($rx, "$1", sprintf("%." . $digits . "f", $num / $item["value"])) . $item["symbol"];
        } else {
          return "0";
        }
      }


      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $price = number_format($row['price'], 2, ".", ",");
            // $price = "₱" . nFormatter($row['price'], strlen(strval($row['price'])));
            // $price = nFormatter($row['price'], strlen(strval($row['price'])));
            echo <<<HTML
                   <div class="catalog__item card">
                        <img src="{$row['image']}" alt="Car Image" width="200" height="200">
                        
                        <!-- <p class="catalog__price"><span><i class="fa-solid fa-peso-sign"></i></span>{$price}</p> -->
                        <p class="catalog__price"><span><i class="fa-solid fa-peso-sign"></i></span>{$price}</p>
                        
                        <div class="catalog__title">
                            <p class="catalog__make">{$row['make']}</p>
                            <p class="catalog__model-name">{$row['model_name']}</p>
                        </div>
                            <div class="catalog__details">
                        <p><span><i class="fa-solid fa-gauge-simple"></i></span>{$row['transmission']}</p>
                        <p><span><i class="fa-solid fa-gas-pump"></i></span>{$row['fuel_type']}</p>
                    </div>
                    <form method="POST" class="availForm" action="/src/contact.php">
                        <input type="hidden" name="message" value="{$row['make']} - {$row['model_name']}">
                        <button type="submit" class="btn btn--primary btn--logo" name="subject">Avail Now </button>
                      </form>
                    </div>
                HTML;
          }
        } else {
        }
      } else {
        // echo "Error: " . mysqli_error($conCD);
      }
      ?>
    </div>
    <a href="/src/catalog.php" class="btn btn--primary-outline btn--logo">Show All Vehicles <i class="fa-solid fa-arrow-right"></i></a>
  </section>

  <section class="section container testimonials" data-aos="fade-up" id="testimonial"><!-- REVIEWS -->
    <h2 class="section__title">Testimonials</h2>
    <div class="owl-carousel owl-carousel1 owl-theme">
      <div class="item card">
        <p class="item-text">“ Excellent and professional - from reading their reviews to driving away the car. A place where the cars, their approach and their service means the cars sell themselves, no salesperson's pitch needed here. Highly Recommended. ” </p>
        <div class="item-author">
          <img class="item-img-top" src="https://images.unsplash.com/photo-1572561300743-2dd367ed0c9a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=300&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=300" alt="">
          <h5>Ronne Galle
          </h5>
        </div>
      </div>

      <div class="item card">
        <p class="item-text">“ It was clean and very spotless. The service I got was fast and the sales lady helped me with everything I needed. They went out of their way to accomodate our needs. 5-Star Customer Service and Quality ” </p>
        <div class="item-author">
          <img class="item-img-top" src="https://images.unsplash.com/photo-1588361035994-295e21daa761?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=301&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=301" alt="">
          <h5>Missy Limana
          </h5>
        </div>
      </div>

      <div class="item card ">
        <p class="item-text">“ Good experience as a first time buyer. Friendly and great sales service. Glad to have purchased here. They are very up front from the start. Will recommend to friends and family. ” </p>
        <div class="item-author">
          <img class="item-img-top" src="https://images.unsplash.com/photo-1575377222312-dd1a63a51638?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=302&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=302" alt="">
          <h5>Martha Brown
          </h5>
        </div>
      </div>
      <div class="item card ">
        <p class="item-text">“ We were in need of a vehicle quickly and the folks at AutoHub rose to our needs. The whole process was smooth from start to finish. I will be back to buy again. ” </p>
        <div class="item-author">
          <img class="item-img-top" src="https://images.unsplash.com/photo-1549836938-d278c5d46d20?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=303&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=303" alt="">
          <h5>Hanna Lisem
          </h5>
        </div>
      </div>
    </div>

  </section>


  <footer class="footer" data-aos="fade-up">
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

  <!-- SCRIPTS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="../assets/js/form.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/carousel.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>