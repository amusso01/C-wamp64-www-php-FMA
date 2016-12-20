<?php
include 'function.php';
$path=dirname(__FILE__);
    //Array for the function makeNav to create top dynamical nav
    $header1LogOut=array(
        'Administrator' => 'adminlogin.php',
        'Intranet for members'=>'intranetlogin.php'
    );
    //Array for the function makeNav to create a fix page navigation
    $header2=array(
        'Home'=>'index.php',
        'Courses'=>'#',
        'News'=>'#',
        'Research'=>'#',
        'About'=>'#',
    );
    makeNav($header1LogOut); //This create a top Navigation for the index.php
 ?>
