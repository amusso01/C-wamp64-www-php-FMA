<?php session_start();
require_once 'include/function.php';
logOut();
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
             <main class='main' id='logOut'>
                 <h3>You log out successfully</h3>
                 <p>Thanks for using our service</p>
                 <p>You will be redirect to the Homepage in 4 sec</p>
                 <?php header( "refresh:4;url=index.php" ); ?>
                 <p>if not redirect click <a href="index.php">here</a></p>
             </main>
         </div>
         <footer>
             <?php include 'include/footer.php' ?>
         </footer>
    </body>
</html>
