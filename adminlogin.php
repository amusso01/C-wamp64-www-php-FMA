<?php session_start();
require_once 'include/function.php';
if (isset($_SESSION['admin'])||isset($_SESSION['user'])) {
        logOut();
}
?><!DOCTYPE html>
<!--Musso Andrea 09-12-2016 FMA
Student number : 13026841
Course : Web Programming using PHP
P1 FMA
Tutor : Tobi Brodie  -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <?php

        include 'include/head.php';
     ?>
    <body>
         <header role="banner">
             <?php include 'include/header.php';?>
         </header>
         <div class="wrapper">
             <?php include 'include/mainNav.php' ;
             $logError= getAdminPass() ?>
             <main class='main'>
                 <div class="logIn">
                     <h3>Administrator</h3>
                 </div>
                    <form action="<?php echo $self; ?>" method="post">
                        <fieldset>
                            <legend>Admin Log in</legend>
                            <div>
                                <label for="password">Enter password</label>
                                <input type='password' id="password" name="password"<?php if (!isset($_SESSION['status'])) {
                                    echo " autofocus";
                                } ?> ><?php echo "$logError"; ?>
                            </div>
                            <div>
                                <input type="submit" name="submit" value="Log-In">
                            </div>
                        </fieldset>
                    </form>
             </main>
         </div>
         <footer>
             <?php include 'include/footer.php' ?>
         </footer>
    </body>
</html>
