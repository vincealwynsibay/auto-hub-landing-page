<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Update</title>
</head>

<body>
    <?php
    require_once('./auth/functions.inc.php');

    if (!is_authenticated()) {
        header("location: /src/login.php");
        exit();
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
                    <form action="../admin/auth/logout.inc.php" method="POST">
                        <button type="submit" name="logout" class="btn btn--primary">Logout</button>
                    </form>
                </ul>

            </nav>
        </div>
    </header>

    <?php
    include('connect_to_database.php');


    if (isset($_GET['id'])) {
        $carID = $_GET['id'];

        $sql = "SELECT * FROM TBLCARS WHERE ID = '$carID'";
        $result = mysqli_query($conCD, $sql);

        if (!$result) {
            echo 'Error';
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                $model_name = $row['model_name'];
                $make = $row['make'];
                $transmission = $row['transmission'];
                $fuel_type = $row['fuel_type'];
                $price = $row['price'];
            }
        }
    }
    ?>

    <?php

    use Cloudinary\Api\Upload\UploadApi;

    $make = '';
    $model_name = '';
    $transmission = '';
    $fuel_type = '';
    $image = '';
    $price = '';

    if (isset($_POST['done'])) {
        $make = $_POST['make'];
        $model_name = $_POST['model'];
        $transmission = $_POST['transmission'];
        $fuel_type = $_POST['fuel_type'];
        $price = $_POST['price'];


        $whereClause = '';
        if (!empty($model_name)) {
            $whereClause .= "MODEL_NAME = '$model_name'";
        }
        if (!empty($image)) {
            $uploadApi = new UploadApi();
            $delete = $uploadApi->destroy($public_id);

            $uploadApi = new UploadApi();
            $response = $uploadApi->upload($_FILES['image']['tmp_name']);

            $image = $response['secure_url'];
            $image_id = $response['public_id'];

            $whereClause .= ", IMAGE = '$image', IMAGE_ID = '$image_id'";
        }
        if (!empty($make)) {
            $whereClause .= ", MAKE = '$make'";
        }
        if (!empty($transmission)) {
            $whereClause .= ", TRANSMISSION = '$transmission'";
        }
        if (!empty($fuel_type)) {
            $whereClause .= ", FUEL_TYPE = '$fuel_type'";
        }
        if (!empty($price)) {
            $whereClause .= ", PRICE = '$price'";
        }

        $sql = "UPDATE TBLCARS
                    SET $whereClause
                    WHERE ID = $carID";

        $result = mysqli_query($conCD, $sql);

        header('location: /admin/Admin.php');
        // if ($result) {
        // } else {
        //     echo "Error: " . mysqli_error($conCD);
        // }
    }
    ?>

    <div class="container">
        <a href="/admin/Admin.php" class="btn btn--logo btn--back btn--outline"><span><i class="fa-solid fa-arrow-left"></i></span> Back To Admin</a>
    </div>

    <main class="container">

        <form class="form card" method="post" enctype="multipart/form-data">
            <h2>Update</h2>

            <div class="form_field">
                <label for="">ID:</label>
                <input type="number" name="" id="" value="<?= $row['id'] ?>" disabled>
            </div>
            <div class="form_field">
                <label for="">Image:</label>
                <div class="form_group">

                    <img src="<?= $row['image'] ?>" alt="Car Image" width="200" height="200">
                    <input type="file" name="image" id="image" value="<?= $row['image'] ?>">
                </div>
            </div>

            <div class="form_field">
                <label for="">Make/Brand:</label>
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

                    foreach ($makes as $make) {
                        if (isset($row["make"]) && $row["make"] == $make)
                            echo "<option value='{$make}' selected>{$make}</option>";
                        else
                            echo "<option value='{$make}'>{$make}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form_field">
                <label for="">Model Name:</label>
                <input type="text" name="model" id="model" value="<?= $row['model_name'] ?>" maxlength="20">
            </div>
            <div class="form_group">
                <div class="form_field">
                    <label for="">Transmission:</label>
                    <select name="transmission" id="transmission">
                        <?php
                        $transmissions = array(
                            "Automatic",
                            "Manual",
                        );

                        foreach ($transmissions as $transmission) {
                            if (isset($row["transmission"]) && $row["transmission"] == $transmission)
                                echo "<option value='{$transmission}' selected>{$transmission}</option>";
                            else
                                echo "<option value='{$transmission}'>{$transmission}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_field">
                    <label for="">Fuel Type:</label>
                    <select name="fuel_type" id="fuel_type">
                        <?php
                        $fuel_types = array(
                            "Regular",
                            "Diesel",
                            "Premium",
                        );

                        foreach ($fuel_types as $fuel_type) {
                            if (isset($row["fuel_type"]) && $row["fuel_type"] == $fuel_type)
                                echo "<option value='{$fuel_type}' selected>{$fuel_type}</option>";
                            else
                                echo "<option value='{$fuel_type}'>{$fuel_type}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form_field">
                <label for="">Price: </label>
                <input type="number" name="price" id="price" value="<?= $row['price'] ?>" maxlength="20">
            </div>

            <input class="btn btn--primary" type="submit" value="Done" name="done">
        </form>
    </main>

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