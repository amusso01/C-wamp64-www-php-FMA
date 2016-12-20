<?php
    //function to create a navigation bar out of an Array
    //select an ID for the <nav> default is "mainHeader"
    function makeNav($linkArray,$ID='mainHeader'){
        $output='<nav>'.PHP_EOL.'<ul>'.PHP_EOL;
        foreach ($linkArray as $navElement => $link) {
            $output.="<li><a href='$link'>$navElement</a></li>".PHP_EOL;
        }
        $output.='</ul>'.PHP_EOL.'</nav>'.PHP_EOL;
        echo $output;
    }


 ?>
