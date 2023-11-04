<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon-32x32.png">
    <title>AutoHub | Admin</title>
</head>

<body>
    <?php

    require_once('./auth/functions.inc.php');

    if (!is_authenticated()) {
        header("location: /src/login.php");
        exit();
    }

    $mName = '';
    $sortBy = '';
    $make = '';
    $transmission = '';
    $fuel_type = '';
    $min = '';
    $max = '';

    if (isset($_GET['done'])) {

        $mName = $_GET['model_name'];
        $make = $_GET['make'];
        $transmission = $_GET['transmission'];
        $fuel_type = $_GET['fuel_type'];
        $min = $_GET['min'];
        $max = $_GET['max'];
    }
    ?>
    <header class="header" id="home">
        <div class="container">
            <nav class="navigation-bar">
                <a href="/src/index.php" class="logo"><img src="../assets/images/racing.svg">AutoHub</a>

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
                    <form action="../admin/auth/logout.inc.php" method="POST">
                        <button type="submit" name="logout" class="btn btn--primary">Logout</button>
                    </form>
                </ul>

            </nav>
        </div>
    </header>

    <div class="container">
        <a href="/admin/Add.php" class="btn btn--logo btn--back btn--simplew"><span><i class="fa-solid fa-plus"></i></span> Add New Car</a>
    </div>

    <div class="container section">


        <?php
        include('../admin/connect_to_database.php');
        include('../admin/cars.inc.php');

        $sql = "SELECT * FROM tblcars ORDER BY ID ASC";

        if (isset($_GET['done'])) {
            $mName = $_GET['model_name'];
            $sortBy = $_GET['sortby'];

            $sql = searchCars($mName, $sortBy, $make, $transmission, $fuel_type, $min, $max);
        }

        $result = mysqli_query($conCD, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo '<table border="1">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Image</th>';
                echo '<th scope="col">Make</th>';
                echo '<th scope="col">Model Name</th>';
                echo '<th scope="col">Transmission</th>';
                echo '<th scope="col">Fuel Type</th>';
                echo '<th scope="col">Price</th>';
                echo '<th scope="col"></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';


                while ($row = mysqli_fetch_assoc($result)) {
                    $price = number_format($row['price'], 0, ".", ",");

                    echo '<tr>';
                    echo '<td scope="row" data-label="Image"><img src="' . $row['image'] . '" alt="Car Image" width="200" height="200"></td>';
                    echo '<td data-label="Make">' . $row['make'] . '</td>';
                    echo '<td data-label="Model Name">' . $row['model_name'] . '</td>';
                    echo '<td data-label="Transmission">' . $row['transmission'] . '</td>';
                    echo '<td data-label="Fuel Type">' . $row['fuel_type'] . '</td>';
                    echo '<td data-label="Price">' . $price . '</td>';
                    echo '<td data-label="" class="btn-container"> <a class="btn btn--logo text--secondary" href="Update.php?id=' . $row['id'] . '"><span><i class="fa-solid fa-pen"></i></span>Edit</a> <br> <a class="btn btn--logo text--danger" href="Delete.php?id=' . $row['id'] . '"><span><i class="fa-solid fa-trash"></i></span>Delete</a></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "No records found.";
            }
            // if (mysqli_num_rows($result) > 0) {
            //     echo '<table border="1">';
            //     echo '<thead>';
            //     echo '<tr>';
            //     echo '<th scope="col">Image</th>';
            //     echo '<th scope="col">Make</th>';
            //     echo '<th scope="col">Model Name</th>';
            //     echo '<th scope="col">Transmission</th>';
            //     echo '<th scope="col">Fuel Type</th>';
            //     echo '<th scope="col">Price</th>';
            //     echo '<th scope="col"></th>';
            //     echo '</tr>';
            //     echo '</thead>';
            //     echo '<tbody>';


            //     while ($row = mysqli_fetch_assoc($result)) {
            //         echo '<tr>';
            //         echo '<td><img src="' . $row['image'] . '" alt="Car Image" width="200" height="200"></td>';
            //         echo '<td>' . $row['make'] . '</td>';
            //         echo '<td>' . $row['model_name'] . '</td>';
            //         echo '<td>' . $row['transmission'] . '</td>';
            //         echo '<td>' . $row['fuel_type'] . '</td>';
            //         echo '<td>' . $row['price'] . '</td>';
            //         echo '<td class="btn-container"> <a class="btn btn--logo text--secondary" href="Update.php?id=' . $row['id'] . '"><span><i class="fa-solid fa-pen"></i></span>Edit</a> <br> <a class="btn btn--logo text--danger" href="Delete.php?id=' . $row['id'] . '"><span><i class="fa-solid fa-trash"></i></span>Delete</a></td>';
            //         echo '</tr>';
            //     }
            //     echo "<tfooter></tfooter>";
            //     echo '</tbody>';
            //     echo '</table>';
            // } else {
            //     echo "No records found.";
            // }
        } else {
            echo "Error: " . mysqli_error($conCD);
        }

        ?>
    </div>

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

    <!-- SCRIPTS -->
    <script src="../assets/js/script.js"></script>
</body>

</html>