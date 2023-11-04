<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/core-styles.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Car Dealer</title>
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

    $make = '';
    $model_name = '';
    $transmission = '';
    $fuel_type = '';
    $image = '';
    $price = '';

    if (isset($_POST['done'])) {
        $make = $_POST['brand'];
        $model_name = $_POST['model'];
        $transmission = $_POST['transmission'];
        $fuel_type = $_POST['fuel_type'];
        $price = $_POST['price'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadApi = new UploadApi();
            $response = $uploadApi->upload($_FILES['image']['tmp_name']);

            $image = $response['secure_url'];
            $image_id = $response['public_id'];

            $sqlquery = "INSERT INTO TBLCARS(IMAGE, IMAGE_ID, MODEL_NAME, MAKE, TRANSMISSION, FUEL_TYPE, PRICE)
                            VALUES('" . $image . "', '" . $image_id . "', '" . $model_name . "', '" . $make . "', '" . $transmission . "', '" . $fuel_type . "', '" . $price . "')";

            mysqli_query($conCD, $sqlquery);

            echo "<script> alert('Added Successfully.') </script>";
            header('Location: Admin.php');
        }
    }

    ?>

    <div class="container">
        <a href="/admin/Admin.php" class="btn btn--logo btn--back btn--outline"><span><i class="fa-solid fa-arrow-left"></i></span> Back To Admin</a>
    </div>

    <main class="container">
        <form class="form card" method="post" enctype="multipart/form-data">
            <h2>Add New Car</h2>

            <div class="form_field">
                <label for="">Image:</label>
                <input type="file" name="image" id="image">
            </div>

            <div class="form_field">
                <label for="">Make/Brand:</label>
                <select name="brand" id="brand">
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
                <label for="">Model Name:</label>
                <input type="text" name="model" id="model" placeholder="eg. micro, sedan...">
            </div>

            <div class="form_group">
                <div class="form_field">
                    <label for="">Transmission:</label>
                    <select name="transmission" id="transmission">
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select>
                </div>

                <div class="form_field">
                    <label for="">Fuel Type:</label>
                    <select name="fuel_type" id="fuel_type">
                        <option value="">Choose</option>
                        <option value="Regular">Regular</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Premium">Premium</option>
                    </select>
                </div>
            </div>
            <div class="form_field">
                <label for="">Price:</label>
                <input type="number" name="price" id="price" placeholder="₱">
            </div>
            <input type="submit" class="btn btn--primary" value="Done" name="done">
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