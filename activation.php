<head>
<?php 
    include_once 'head.html';
    include_once 'functions.php';
?>
</head>

<?php
if (isset($_GET['email']) and isset($_GET['hash'])) {
    if (!empty($_GET['email']) and !empty($_GET['hash'])) {
        $email = mysql_escape_string($_GET['email']);
        $hash = mysql_escape_string($_GET['hash']);

        $bdd = connect();
        $sql = $bdd->query("SELECT email,hash FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0' ");
        $match = $sql->rowCount();
        if ($match == 1) {
            $bdd->exec("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0' ");
            echo '<p class="verified" > Account successfully activated, heading to login page </p>';
            header('refresh:5;url=index.php');
        } else {
            echo '<p class="error" > Something went wrong, heading back to the main menu </p>';
            header('refresh:5;url=index.php');
        }
    }
}
