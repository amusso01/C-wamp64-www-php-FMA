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
    //This function create the header with the main navigation bar
    function banner($linkArray,$ID){
        echo "  <div id='logo'>".PHP_EOL."
            <h2>Department of Computer Science and Information System</h2>".PHP_EOL.
            "            <img id='logo' src='images\Birkbeck-Logo-Colour-330x104.jpg'>".PHP_EOL;
        makeNav($linkArray,$ID);
        echo "</div>".PHP_EOL;
    }
    //This function return an array of the file in the dir ../../private/$fileName. Each line
    //or a message if the file is missing
    function openfile($fileName){
        $content=array();
        $handle = fopen('../../private/'.$fileName, 'r');
        if ($handle===false) {
            echo '<p>Session corrupt: The '.$fileName.' file is missing or dameged</p>'.PHP_EOL;
        }else {
            while (!feof($handle)) {
                $content []= fgets($handle, 1024);
            }
        }
        fclose($handle);
        return $content;
    }
    function intranetFile($fileName){
        $content=array();
        $handle = fopen('Data/'.$fileName, 'r');
        if ($handle===false) {
            echo '<p>Session corrupt: The '.$fileName.' file is missing or dameged</p>'.PHP_EOL;
        }else {
            while (!feof($handle)) {
                $content []= fgets($handle, 1024);
            }
        }
        fclose($handle);
        return $content;
    }

    $self = htmlentities($_SERVER['PHP_SELF']);//path of page itself wherever I call it

//This function is used ti check admin password on log-in against the store value
//md5 encription is used on both password to enhance security
    function getAdminPass(){
        $error='';
        // global $self;
        $storePass = openfile('admin.txt')[0];
        $storePass = trim($storePass);
        if (isset($_POST['submit'])) {
            if (isset($_POST['password'])) {
                $inputPass=md5(htmlentities(($_POST['password'])));
                if ($inputPass==$storePass) {
                    $_SESSION['admin']= 'Log in';
                    header("Location: addmember.php");
                }else {
                    logOut();
                    $error.= '<span class=\'red \'>Incorrect password</span> ';
                }
            }
        }
        return $error;
    }

    function getUserName(){
        $error = array();
        $validData = array();
        if (isset($_POST['logIn'])){
            if ((!empty($_POST['username']))&&(!empty($_POST['password']))) {
                $userName=$_POST['username'];
                $userName=trim($userName);
                $userName=strtolower($userName);
                $password=$_POST['password'];
                $password=md5($password);
                $fileUsername=openfile('users.txt');
                $count=count($fileUsername);
                $matchUser = false;
                $matchPass = false;
                for ($i=0; $i <$count-1 ; $i++){
                    $storedInfo= explode(':',$fileUsername[$i]);
                    if ($storedInfo[0]==$userName) {
                        $matchUser=true;
                        foreach ($storedInfo as $key => $value) {
                            $validData[]=$value;
                        }
                    }
                }
                if ($matchUser==false) {
                    $error['user']='<span class=\'red\'>Username is incorrect!!</span>';
                }
                if (($matchUser==true)&&($password==$validData[1])) {
                    $_SESSION['user']='Log in';
                    $_SESSION['fName']=$validData[4];
                    $_SESSION['sName']=$validData[3];
                    $_SESSION['username']=htmlentities($userName);
                    header('location:intranet.php');
                }else {
                    $error['password']='<span class="red">Password is wrong!!</span>';
                }
            }else {
                $error['both']='<span class="red">Fill in both fields to Log in</span>';
            }
        }
        return $error;
    }


    function logOut(){
        $_SESSION = array();
        session_destroy();
        session_regenerate_id(true);
    }

//Check validity of name and Surname
    function checkName($Name){
        $error=array('not valid'=>'Field required!');
        $clean = array();
        $valid=false;
        if (!empty($Name)) {//check if there is an input in the field
            if (strlen($Name)>40) {//check if name lenght is exceed 40 characters
                $error['not valid']='Not valid! Too long';
            }else {
                if (!strpos($Name,'  ') === false) {//check for withe space
                    $error['not valid']='Not valid! White space check';
                }else {
                    $Name=str_replace(' ','A' , $Name);//ctype _alpha return false in case of white space(as per instance "Jo Allen") or ' (O'Connor).So replace with capital A
                    $Name= str_replace("'","B", $Name);//ctype _alpha return false in case of ' (O'Connor).So replace with capital B
                    if (ctype_alpha($Name)==false) {//Check for digit in the name
                        $error['not valid']='Not valid! Must contains only letters';
                    }else {
                        $Name =str_replace('A', ' ', $Name);//replace back capital A with withe space. No danger to replace other letter cause the variable as been strtolower before
                        $Name =str_replace('B', '\'', $Name);
                        $clean['valid']=$Name;
                        $valid=true;
                    }
                }
            }
        }
        if ($valid==true) {
            return $clean;
        }else {
            return $error;
        }
    }

//Return the key of the first element of an array
function firstKey($array){
    reset($array);
    $nameKey=key($array);
    return $nameKey;
}

//Check the username
function getUname($uName){
    $error=array('not valid'=>'Field required!');
    $clean = array();
    $valid=false;
    $exist=false;
    if ($uName!='') {
        if ((strlen($uName)<5) || (strlen($uName)>12)) {
            $error['not valid']='Not valid! Min 5 and max 12 characters allowed';
        }else {
            $count=countDigits($uName);
            if ($count<2) {
                $error['not valid']='Not valid! Must contains 2 numbers';
            }else{
                $range=range(0,9);
                $uNoNumber = str_replace($range, 'A', $uName);//replace number to check letters
                if (!ctype_alpha($uNoNumber)) {
                    $error['not valid']='Not valid! No special characters allowed';
                }else {
                    $fileUsername=openfile('users.txt');
                    $count=count($fileUsername);
                    for ($i=0; $i <$count-1 ; $i++) {
                        $storedInfo= explode(':',$fileUsername[$i]);
                        if ($storedInfo[0]==$uName) {
                            $exist=true;
                            $error['not valid']='Username already exist!';
                        }
                    }
                    if ($exist==false) {
                        $clean['valid']=$uName;
                        $valid=true;
                    }
                }
            }
        }
    }
    if ($valid==true) {
        return $clean;
    }else {
        return $error;
    }
}

//function count digit in a string. This function has been adopted from a post on Stack overflow
/***************************************************************************************
*    Title: Function to count number of digits in string
*    Author: D. Strout
*    Date: 13/06/2012
*    Availability: https://stackoverflow.com/questions/11023753/function-to-count-number-of-digits-in-string
*
***************************************************************************************/
function countDigits($str) {
    $noDigits=0;
    for ($i=0;$i<strlen($str);$i++) {
        if (is_numeric($str{$i})) $noDigits++;
    }
    return $noDigits;
}

function getPassword($password){
    $safePass=trim($password);
    $clean = array();
    $haystackC=true;
    $haystackL=true;
    $valid=false;
    $outputArray=array('not valid'=>'Password is required');
    if ($safePass!='') {
        if ((strlen($safePass)<7) || (strlen($safePass)>35)) {
            $outputArray['not valid']='Not valid! Password must be between 7 and 35 characters';
        }else{
            $count=countDigits($safePass);
            if ($count<1) {
                $outputArray['not valid']='Not Valid! Password must contain at least 1 digit';
            }else{
                $range=range(0,9);
                $passNoNumb=str_replace($range,'A', $safePass);
                if (!ctype_alpha($passNoNumb)) {
                    $outputArray['not valid']='Not valid! No special characters allowed';
                }else {

                    if (strtolower($safePass)==$safePass) {
                        $haystackC=false;
                        $outputArray['not valid']=' Not valid at least one capital letter';
                    }elseif (strtoupper($safePass)==$safePass) {
                        $haystackL=false;
                         $outputArray['not valid']='Not valid at least one lower letter';
                    }
                    if (($haystackC==true)&&($haystackL==true)) {
                        $clean['valid']=$safePass;
                        $valid=true;
                    }
                }
            }
        }
    }
    if ($valid==true) {
        return $clean;
    }else {
        return $outputArray;
    }
}


//This function control a new user data
    function getNewUser(){
        $errorArray=array();
        $cleanArray=array();
        $submitted=false;
        $hasError=false;
        $nameArray=array();
        if (isset($_POST['submitRegistration'])) {//control if the form has been submitted
            $submitted=true;
            if (isset($_POST['title'])) {//Check the title value
                $value = $_POST['title'];
                switch ($value) {
                    case '0'://if 0 hasError and populate errorArray 0 is the key
                        $hasError=true;
                        $errorArray['selected']=$value;
                        break;
                    case '1'://if other value populate cleanArray $value has key 'selected' value
                        $cleanArray['title']='Dr';
                        break;
                    case '2':
                        $cleanArray['title']='Mr';
                        break;
                    case '3':
                    	$cleanArray['title']='Mrs';
                        break;
                    case '4':
                        $cleanArray['title']='Miss';
                        break;
                }
            }
            if (isset($_POST['fName'])) {//control first name
                $fName = $_POST['fName'];
                $trimName= trim($fName);//trim for white space
                $htmlName= strtolower($trimName);
                $nameArray=checkName($htmlName);
                $nameKey = firstKey($nameArray);
                if ($nameKey=='valid') {
                    $nameArray[$nameKey] = htmlentities($nameArray[$nameKey],ENT_QUOTES,'UTF-8');//create a safe html output to store in the array
                    $cleanArray['fName']=$nameArray[$nameKey];
                }else {
                    $errorArray['fName']=$nameArray[$nameKey];
                    $hasError=true;
                }
            }
            $nameArray=array();

            if (isset($_POST['sName'])) {//control Surname
                $sName = $_POST['sName'];
                $trim= trim($sName);//trim for white space
                $htmlsName= strtolower($trim);
                $nameArray=checkName($htmlsName);
                $nameKey = firstKey($nameArray);
                if ($nameKey=='valid') {
                    $nameArray[$nameKey] = htmlentities($nameArray[$nameKey],ENT_QUOTES,'UTF-8');
                    $cleanArray['sName']=$nameArray[$nameKey];
                }else {
                    $errorArray['sName']=$nameArray[$nameKey];
                    $hasError=true;
                }
            }

            $nameArray=array();

            if (isset($_POST['email'])) {
                $email = $_POST['email'];
                $email = trim($email);
                $safeEmail = htmlentities($email,ENT_QUOTES,'UTF-8');
                if ($safeEmail!='') {
                    $email = filter_var($safeEmail,FILTER_VALIDATE_EMAIL);
                    if (!$email) {
        				$hasError=true;
                        $errorArray['email']=' This is not a valid email ';
        			}else {
                        $cleanArray['email']=$safeEmail;
        			}
                }else {
                    $errorArray['email']='Field is required!';
                }
            }

            if (isset($_POST['userName'])) {
                $userName=$_POST['userName'];
                $userName= trim($userName);
                $userName= strtolower($userName);
                $nameArray=getUname($userName);
                $nameKey = firstKey($nameArray);
                if ($nameKey=='valid') {
                    $nameArray[$nameKey]=htmlentities($nameArray[$nameKey],ENT_QUOTES,'UTF-8');
                    $cleanArray['userName']=$nameArray[$nameKey];
                }else {
                    $errorArray['userName']=$nameArray[$nameKey];
                    $hasError=true;
                }
            }
            $nameArray=array();
            if (isset($_POST['password'])) {
                $password=$_POST['password'];
                $nameArray=getPassword($password);
                $nameKey = firstKey($nameArray);
                if ($nameKey=='valid') {
                    $nameArray[$nameKey]=htmlentities($nameArray[$nameKey],ENT_QUOTES,'UTF-8');
                    $cleanArray['password']= $nameArray[$nameKey];
                }else {
                    $errorArray['password']=$nameArray[$nameKey];
                    $hasError=true;
                }
            }
        }

        $newUserArray=array(
            $cleanArray,
            $errorArray
        );

        if (($hasError==false) && ($submitted==true)) {
            $_SESSION['title']=$cleanArray['title'];
            $_SESSION['fName']=$cleanArray['fName'];
            $_SESSION['sName']=$cleanArray['sName'];
            $_SESSION['email']=$cleanArray['email'];
            $_SESSION['userName']=$cleanArray['userName'];
            $_SESSION['password']=$cleanArray['password'];
            header('location:register.php');
        }else{
            return $newUserArray;
        }
    }

//split a two dimension array in a single array depending by the index $key , default 0
    function splitArray($array, $key='0'){
        if (is_array($array)) {
            $returnArray=$array[$key];
            return $returnArray;
        }else {
            echo "<p>Internal error the array pass to the function splitArray is not an array</p>";
        }
    }

    function confirmUser(){
        $data=array(
            $_SESSION['userName'] ,
            $_SESSION['password'] ,
            $_SESSION['title'] ,
            $_SESSION['sName'] ,
            $_SESSION['fName'] ,
            $_SESSION['email'] ,
        );
        $userData=$data['0'].":".md5($data['1']).":".$data['2'].":".$data['3'].":".$data['4'].':'.$data['5'];
        if (isset($_POST['back'])){
            header('location:addmember.php');
        }elseif (isset($_POST['confirmed'])) {
            writeOnFile($userData);
            unset($userData);
            header('location:addmember.php');
        }elseif (isset($_POST['confirmexit'])) {
            writeOnFile($userData);
            unset($userData);
            header('location:logout.php');
        }
    }


    function writeOnFile($data){
            $fo = fopen('../../private/users.txt', 'a+') or die('users File Not found!!');
            fwrite($fo, $data."\r\n");
            fclose($fo);
    }

    function tablePopulate($csvFilename){
        $tableArray=intranetFile($csvFilename);//open the file and return array of it
        echo '<table>'.PHP_EOL;
        foreach ($tableArray as $key => $value) {
            $tempData= explode(',', $tableArray[$key]);
            echo "<tr>";
                foreach ($tempData as $dataKey => $dataValue) {
                    if ($key==0) {
                            echo "<th scope='col'>$dataValue</th>".PHP_EOL;
                    }else {
                            if ($dataKey==0) {
                                echo "<th scope='row'>$dataValue</th>".PHP_EOL;
                            }else {
                                echo "<td>$dataValue</td>".PHP_EOL;
                            }
                    }
                }
            echo "</tr>";
        }
        echo '</table>'.PHP_EOL;
    }

    function dataFile(){
        $navArray=array();
        if (file_exists('Data')) {
            $dir= opendir('Data');
            while (false !== ($file=readdir($dir))){//store the name of the read file in $file and read the content off all the dir
               if (($file == ".") || ($file == "..")){//skip the . and .. file
                   continue;
               }else{
                   $pureFile=explode('.', $file);
                   $navArray[$pureFile[0]]=$pureFile[0].'.php';
               }
           }
           closedir($dir);
           return $navArray;
       }else {
           echo "<p>Error! Directory does not exist</p>";
       }
    }
 ?>
