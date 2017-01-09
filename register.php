<?php session_start();session_regenerate_id(true); ?>

<!DOCTYPE html>
<?php if ((!isset($_SESSION['admin']))&&(!$_SESSION['admin']=='Log in')) {
    echo'<!--Musso Andrea 09-12-2016 FMA
    Student number : 13026841
    Course : Web Programming using PHP
    P1 FMA
    Tutor : Tobi Brodie  -->

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
            include 'include/head.php';
    header( 'location:index.php' );
} ?>
<!-- Musso Andrea 09-12-2016 FMA
Student number : 13026841
Course : Web Programming using PHP
P1 FMA
Tutor : Tobi Brodie -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <?php
        include 'include/head.php';
        require_once 'include/function.php';
     ?>
    <body>
         <header role="banner">
             <?php include 'include/header.php';
             confirmUser();?>
         </header>
         <div class="wrapper">
             <main id="register">
                 <h2>Confirm to save the user</h2>
                 <form class="registration" action="<?php echo $self ?>" method="post">
                     <fieldset>
                         <legend>New user</legend>
                         <label for="title">Title</label>
                         <input class="confirm" type="text" name="title" disabled="disabled" value="<?php echo $_SESSION['title'] ?>">
                         <label for="fName">First name</label>
                         <input  class="confirm" type="text" name="fName" disabled="disabled" value="<?php echo $_SESSION['fName'] ?>">
                         <label for="sName">Surname</label>
                         <input  class="confirm" type="text" name="sName" disabled="disabled" value="<?php echo $_SESSION['sName'] ?>">
                         <label for="userName">Username</label>
                         <input  class="confirm" type="text" name="userName" disabled="disabled" value="<?php echo $_SESSION['userName'] ?>">
                         <label for="password">Password</label>
                         <input  class="confirm" type="text" name="password" disabled="disabled" value="<?php echo $_SESSION['password'] ?>">
                         <div>
                             <input type="submit" name="confirmed" value="Confirm">
                             <input type="submit" value="Discard" name="back" >
                             <input type="submit" name="confirmexit" value="Confirm and Log Out">
                         </div>
                     </fieldset>
                     <p>Please take a note of username and password!!</p>
                 </form>
             </main>
         </div>
         <footer>
             <?php include 'include/footer.php' ?>
         </footer>
    </body>
</html>
