<?php
    include_once 'header.php'
?>
<section>
        <div></div>
        <h2>Log In</h2>
        <form class="some-form" action="./includes/login.inc.php" method="post">
            <input name="username-or-email" type="text" placeholder="Username/Email..."></input>
            <input name="password" type="password" placeholder="Password..."></input>
            <button type="submit" name="submit">Log In</button>
        </form>
    <div></div>
 <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "wronglogin"){
            echo "<p>Username or email incorrect!</p>";
        }
        else if($_GET["error"] == "wrongpassword"){
            echo "<p>Password incorrect!</p>";
        }
        else if($_GET["error"] == "invalidemail"){
            echo "<p>Email invalid!</p>";
        }
        else if($_GET["error"] == "emptyinput"){
            echo "<p>Make sure every field is filled in!</p>";
        }
    }

?>

    </section>

<?php
    include_once 'footer.php'
?>
