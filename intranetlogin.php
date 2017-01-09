<?php session_start();
require_once 'include/function.php';
if ((isset($_SESSION['user']) || (isset($_SESSION['admin'])))) {
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
             <?php include 'include/header.php'; ?>
         </header>
         <div class="wrapper">
             <?php include 'include/mainNav.php' ;
             $error= getUserName(); ?>
             <main class='main'>
                 <div class="logIn">
                     <h3>Member Log-in</h3>
                 </div>
                    <form action="<?php echo $self; ?>" method="post">
                        <fieldset>
                            <legend>Log in</legend>
                            <div>
                                <label for="username">Username</label>
                                <input placeholder="e.g. jonsnow01" id='username' type="text" name="username" value="<?php if (isset($error['matchUser'])){echo $error['matchUser'];} ?>"><span class="red"><?php if(isset($error['user'])){echo $error['user'];} ?></span>
                            </div>
                            <div>
                                <label for="password">Enter password</label>
                                <input type='password' id='password' name="password"><span class="red"><?php if((!isset($error['user'])&& isset($error['password']))){echo $error['password'];} ?></span>
                            </div>
                            <div>
                                <p class="red"><?php if (isset($error['both'])) {
                                    echo $error['both'];
                                } ?></p>
                            </div>
                            <div>
                                <input type="submit" name="logIn" value="Log-In">
                            </div>
                        </fieldset>
                    </form>
                    <aside class="noPassword">
                        <p>If you lost your password please contact the <a href="mailto:administrator@dcsbbk.co.uk">Administrator</a></p>
                    </aside>
             </main>
         </div>
         <footer>
             <?php include 'include/footer.php' ?>
         </footer>
    </body>
</html>
