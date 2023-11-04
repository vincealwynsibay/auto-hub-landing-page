<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Delete</title>
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
    <script>
        const searchForm = document.getElementById('searchForm');

        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const model_name = document.getElementById('model_name').value;
            const sort = document.getElementById('sort').value;
            const make = document.getElementById('make').value;
            const transmission = document.getElementById('transmission').value;
            const fuel_type = document.getElementById('fuel_type').value;

            const queryParams = new URLSearchParams();
            queryParams.append('model_name', model_name);
            queryParams.append('sort', sort);
            queryParams.append('make', make);
            queryParams.append('transmission', transmission);
            queryParams.append('fuel_type', fuel_type);

            const actionURL = 'Admin.php' + '?' + queryParams.toString();

            searchForm.action = actionURL;

            searchForm.submit();
        });
    </script>
    <?php


    include('connect_to_database.php');

    use Cloudinary\Api\Upload\UploadApi;

    $query = "SELECT * FROM tblcars";
    $post_result = mysqli_query($conCD, $query);

    if (!$post_result) {
        return ["message" => "Post does not exist.", "status_code" => 401];
    }

    $post = $post_result->fetch_all(MYSQLI_ASSOC);

    $response = ["message" => "Posts fetched successfully.", "status_code" => 400, "data" => $post];

    if (isset($_GET['id'])) {
        $carID = $_GET['id'];
    }

    $sql = "SELECT * FROM TBLCARS WHERE ID = '$carID'";
    $result = mysqli_query($conCD, $sql);

    if (!$result) {
    } else {
        if ($row = mysqli_fetch_assoc($result)) {
            $model_name = $row['model_name'];
            $make = $row['make'];
            $transmission = $row['transmission'];
            $fuel_type = $row['fuel_type'];
            $price = $row['price'];
        }
    }

    if (isset($_POST['yes'])) {
        $public_id = $row['image_id'];

        $uploadApi = new UploadApi();
        $delete = $uploadApi->destroy($public_id);

        if ($delete) {
            $sql = "DELETE FROM TBLCARS
                    WHERE ID = $carID";

            $result = mysqli_query($conCD, $sql);
            if ($result) {
                echo "<script> alert ('Deletion success.') </script>";
                header('Location: Admin.php');
            } else {
                echo "Error: " . mysqli_error($conCD);
            }
        } elseif (isset($_POST['no'])) {
            echo "<script> alert ('Deletion terminated.') </script>";
            header('Location: Admin.php');
            exit;
        }
    }


    ?>
    <div class="container">
        <a href="/admin/Admin.php" class="btn btn--logo btn--back btn--outline"><span><i class="fa-solid fa-arrow-left"></i></span> Back To Admin</a>
    </div>

    <main class="container">

        <form class="form card" method="post" enctype="multipart/form-data">
            <div>
                <label class="form__title">
                    Are you sure you want to delete ID #<?= $carID ?>?
                </label>
                <div class="form__delete">
                    <input class="btn" type="submit" value="Yes" name="yes">
                    <input class="btn" type="submit" value="No" name="no">
                </div>
            </div>

            <div class="form_field">
                <label for="">ID:</label>
                <input type="number" name="" id="" value="<?= $row['id'] ?>" disabled>
            </div>
            <div class="form_field">
                <label for="image">Image:</label>
                <img src="<?= $row['image'] ?>" alt="Car Image" width="200" height="200">
            </div>
            <div class="form_field">
                <label for="">Make/Brand:</label>
                <select name="make" id="make" disabled>
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
                <input type="text" name="model" id="model" value="<?= $row['model_name'] ?>" disabled>
            </div>
            <div class="form_group">

                <div class="form_field">
                    <label for="">Transmission:</label>
                    <select name="transmission" id="transmission" disabled>
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
                    <select name="fuel_type" id="fuel_type" disabled>
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
                <label for="">Price:</label>
                <input type="number" name="price" id="price" value="<?= $row['price'] ?>" disabled>
            </div>
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