<?php
session_start();
session_regenerate_id(true);
require_once 'include/function.php';
    echo '<!DOCTYPE html>';
if ((isset($_SESSION['user']))&&($_SESSION['user']=='Log in')) {
    echo'<!--Musso Andrea 09-12-2016 FMA
    Student number : 13026841
    Course : Web Programming using PHP
    P1 FMA
    Tutor : Tobi Brodie  -->

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';

            include 'include/head.php';

    echo     '<body>
             <header role="banner">';
                 include 'include/header.php';
    echo    '</header>
             <div class="wrapper">';
             include 'include/mainNav.php';
                echo' <main class="intranet">
                     <div class="greatings">
                         <h3>Welcome '.ucfirst($_SESSION['fName']).' '.ucfirst($_SESSION['sName']).'</h3>
                     </div>
                     <div>
                        <h5>Courses</h5>
                     ';$nav=dataFile(); makeNav($nav,'intranetNav');
                     echo ' </div>
                 </main>
             </div>
             <footer>';
                 include 'include/footer.php';

    echo    '</footer>
        </body>
   </html>';
}else {
    echo'<!--Musso Andrea 09-12-2016 FMA
    Student number : 13026841
    Course : Web Programming using PHP
    P1 FMA
    Tutor : Tobi Brodie  -->

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';

            include 'include/head.php';

    echo "<h1>You have no right to be here</h1>
    <p>You will be redirect to the Homepage in 4 sec</p>";
    header( 'refresh:4;url=index.php' );
}
?>
