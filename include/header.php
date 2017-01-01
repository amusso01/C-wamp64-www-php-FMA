<?php
    $header1LogOut=array();//Array for the function makeNav to create top dynamical nav
    if (isset($_SESSION['admin'])) {
        $header1LogOut=array(
            'Welcome Admin' => 'addmember.php',
            'Log-out' => 'logout.php',
            'Intranet for members'=>'intranetlogin.php'
        );
    }elseif (isset($_SESSION['user'])) {
        $header1LogOut=array(
            $_SESSION['username']=>'intranet.php',
            'Log-out' => 'logout.php',
        );
    }else {
        $header1LogOut=array(
            'Administrator' => 'adminlogin.php',
            'Intranet for members'=>'intranetlogin.php'
        );

    }

    makeNav($header1LogOut); //This create a top Navigation for the index.php
 ?>
