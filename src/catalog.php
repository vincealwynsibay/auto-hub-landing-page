<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css" />
    <link rel="stylesheet" href="../assets/css/catalog.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <title>AutoHub | Catalog</title>
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


    <main class="catalog section container">
        <div class="left-wrapper">
            <form id="searchForm" class="form card" method="POST">
                <div class="form_field">
                    <label for="">Make</label>
                    <select name="make" id="make">
                        <?php
                        $makes = array(
                            "Honda",
                            "Toyota",
                            "Ford",
                            "Lexus",
                            "BMW",
                            "Mercedes Benz",
                            "Nissan",
                            "Porsche",
                            "Tesla",
                            "Audi",
                            "Jaguar",
                            "Subaru",
                            "Volvo",
                            "Ferrari",
                            "Volkswagen",
                            "Bentley",
                        );

                        if (!isset($_GET["make"]) || $_GET["make"] == "") {
                            echo "<option value='' selected>Choose</option>";
                        }

                        foreach ($makes as $make) {
                            if (isset($_GET["make"]) && $_GET["make"] == $make)
                                echo "<option value='{$make}' selected>{$make}</option>";
                            else
                                echo "<option value='{$make}'>{$make}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_field">
                    <label>Sort by:</label>
                    <select name="sortby" id="sortby">
                        <?php
                        $sorts = array(
                            "A to Z",
                            "Z to A",
                            "Ascending",
                            "Descending",
                        );

                        $sortsValues = array(
                            "asc",
                            "desc",
                            "asce",
                            "desce"
                        );

                        if (!isset($_GET["sortBy"]) || $_GET["sortBy"] == "") {
                            echo "<option value='' selected>Choose</option>";
                        }
                        for ($i = 0; $i < count($sorts); $i++) {
                            if (isset($_GET["sortBy"]) && $_GET["sortBy"] == $sort)
                                echo "<option value='{$sortsValues[$i]}' selected>{$sorts[$i]}</option>";
                            else
                                echo "<option value='{$sortsValues[$i]}'>{$sorts[$i]}</option>";
                        }

                        ?>
                        <!-- <option value="">Choose</option>
                        <option value="asc">A to Z</option>
                        <option value="desc">Z to A</option>
                        <option value="asce">Ascending</option>
                        <option value="desce">Descending</option> -->
                    </select>
                </div>
                <div class="form_field">
                    <label for="">Transmission Type</label>

                    <select name="transmission" id="transmission">
                        <?php
                        $transmissions = array(
                            "Automatic",
                            "Manual",
                        );

                        if (!isset($_GET["transmission"]) || $_GET["transmission"] == "") {
                            echo "<option value='' selected>Choose</option>";
                        }

                        foreach ($transmissions as $transmission) {
                            if (isset($_GET["transmission"]) && $_GET["transmission"] == $transmission)
                                echo "<option value='{$transmission}' selected>{$transmission}</option>";
                            else
                                echo "<option value='{$transmission}'>{$transmission}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_field">
                    <label for="">Fuel Type</label>
                    <select name="fuel_type" id="fuel_type">
                        <?php
                        $fuel_types = array(
                            "Regular",
                            "Diesel",
                            "Premium",
                        );
                        if (!isset($_GET["fuel_type"]) || $_GET["fuel_type"] == "") {
                            echo "<option value='' selected>Choose</option>";
                        }

                        foreach ($fuel_types as $fuel_type) {
                            if (isset($_GET["fuel_type"]) && $_GET["fuel_type"] == $fuel_type)
                                echo "<option value='{$fuel_type}' selected>{$fuel_type}</option>";
                            else
                                echo "<option value='{$fuel_type}'>{$fuel_type}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_field">
                    <label for="">Price Range</label>
                    <div class="dual-slider">
                        <div class="">
                            <?php

                            if (isset($_GET["min"]) && isset($_GET["max"]) && $_GET["min"] != "" && $_GET["max"] != "") {
                                $minInitialVal = "₱" . number_format($_GET["min"], 2, ".", ",");;
                                $maxInitialVal = "₱" . number_format($_GET["max"], 2, ".", ",");;
                                echo "<p class='range-display'><span>{$minInitialVal}</span> - <span>{$maxInitialVal}</span></p>";
                            } else {
                                echo "<p class='range-display'><span>₱0</span> - <span>₱10,000,000</span></p>";
                            }
                            ?>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <?php
                            if (isset($_GET["min"]) && isset($_GET["max"])) {
                                echo "<input type='range' class='range-min' name='min' id='minVal'  min='0' max='10000000' step='10000' value='{$_GET["min"]}'>";
                                echo "<input type='range' class='range-max' name='max' id='maxVal'  min='0' max='10000000' step='10000' value='{$_GET["max"]}'>";
                            } else {
                                echo "<input type='range' class='range-min' name='min' id='minVal' min='0' max='10000000' step='10000' value='0'>";
                                echo "<input type='range' class='range-max' name='max' id='maxVal' min='0' max='10000000' step='10000' value='10000000'>";
                            }
                            ?>
                            <!-- <input type="range" id="minVal" class="range-min" min="0" max="10000000" value="0" step="10000">
                            <input type="range" id="maxVal" class="range-max" min="0" max="10000000" value="10000000" step="10000"> -->
                        </div>
                    </div>
                </div>
                <div class="btn-container">
                    <a href="/src/catalog.php" class="btn btn--logo btn--secondary-outline"><i class="fa-solid fa-arrows-rotate"></i>Reset All</a>
                    <button type="submit" class="btn btn--logo btn--primary-outline"><i class="fa-solid fa-magnifying-glass"></i>Find Car</button>
                </div>
            </form>
        </div>
        <div class="right-wrapper">
            <div class="catalog__list">
                <?php
                include('../admin/connect_to_database.php');
                include('../admin/cars.inc.php');


                $result = searchCars(
                    isset($_GET["sortBy"]) ? $_GET["sortBy"] : "",
                    isset($_GET["make"]) ? $_GET["make"] : "",
                    isset($_GET["transmission"]) ? $_GET["transmission"] : "",
                    isset($_GET["fuel_type"]) ? $_GET["fuel_type"] : "",
                    isset($_GET["min"]) ? $_GET["min"] : "",
                    isset($_GET["max"]) ? $_GET["max"] : ""
                );
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
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price = number_format($row['price'], 0, ".", ",");
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
                                        </div>
                                    </form>
                                HTML;
                        }
                    } else {
                    }
                } else {
                    // echo "Error: " . mysqli_error($conCD);
                }
                ?>
            </div>
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

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/form.js"></script>
</body>

</html>