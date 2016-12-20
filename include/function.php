<?php
    //function to create a navigation bar out of an Array
    //select an ID for the <nav> default is "headerNav"
    function makeNav($linkArray,$ID='headerNav'){
        $output='  <nav id='.$ID.'>'.PHP_EOL.'    <ul>'.PHP_EOL;
        foreach ($linkArray as $navElement => $link) {
            $output.="      <li><a href='$link'>$navElement</a></li>".PHP_EOL;
        }
        $output.='     </ul>'.PHP_EOL.' </nav>'.PHP_EOL;
        echo $output;
    }

    function banner($linkArray,$ID){
        echo "  <div id='logo'>".PHP_EOL."
            <h2>Department of Computer Science and Information System</h2>".PHP_EOL.
            "            <img id='logo' src='images\Birkbeck-Logo-Colour-330x104.jpg'>".PHP_EOL."
        </div>".PHP_EOL;
        makeNav($linkArray,$ID);
    }
    function footer(){
        
    }

 ?>
