<?php
    include_once 'header.php'
?>
    <section>
        <div></div>
        <h2>Sign Up</h2>
        <form class="some-form" action="./includes/signup.inc.php" method="post">
            <input name="name" type="text" placeholder="Name..."></input>
            <input name="email" type="text" placeholder="Email..."></input>
            <input name="username" type="text" placeholder="Username..."></input>
            <input name="password" type="password" placeholder="Password..."></input>
            <input name="passwordrpt" type="password" placeholder="Repeat password..."></input>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    <div></div>

    <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Make sure all fields are filled in!</p>";
        }
        else if($_GET["error"] == "invalidusername"){
            echo "<p>Username invalid!</p>";
        }
        else if($_GET["error"] == "invalidemail"){
            echo "<p>Email invalid!</p>";
        }
        else if($_GET["error"] == "passwordsdontmatch"){
            echo "<p>Passwords don't match!</p>";
        }
        else if($_GET["error"] == "usernametaken"){
            echo "<p>Username taken!</p>";
        }
        else if($_GET["error"] == "stmtfailed"){
            echo "<p>Something went wrong. Try again!</p>";
        }
        else if($_GET["error"] == "none"){
            echo "<p>Successfully signed up!</p>";
        }
    }

?>

    </section>



<?php
    include_once 'footer.php'
?>
