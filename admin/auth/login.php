<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h2>Login</h2>

    <section class="login-form">

        <div class="login-form-form">

            <form action="includes/login.inc.php" method="post">

                <input type="text" name="uid" placeholder="Username/E-mail...">
                <input type="password" name="pwd" placeholder="Password...">

                <button type="submit" name="submit">Login</button>

            </form>

        </div>

        <?php

        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {

                echo "<p>Fill in all fields!</p>";

            } elseif ($_GET["error"] == "wronglogin") {

                echo "<p>Incorrect login information!</p>";

            }
        }

        ?>

    </section>

</body>

</html>