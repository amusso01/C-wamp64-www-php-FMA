<?php
    session_start();
    session_regenerate_id(true);
    require_once 'include/function.php';
    echo '<!DOCTYPE html>';
    if ( (isset($_SESSION['admin']))&&($_SESSION['admin'] == 'Log in')) {

echo'        <!--Musso Andrea 09-12-2016 FMA
        Student number : 13026841
        Course : Web Programming using PHP
        P1 FMA
        Tutor : Tobi Brodie  -->

        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';

                include 'include/head.php';

        echo     '<body>
                 <header role="banner">';
                     include 'include/header.php';
                     $newUser= getNewUser();
                     $cleanForm=splitArray($newUser);
                     $errorForm=splitArray($newUser,'1');
                     if (isset($cleanForm['title'])) {
                         $titleSelect=$cleanForm['title'];
                     }else{
                         $titleSelect='0';
                     }

        echo    '</header>
                 <div class="wrapper">';
                 include 'include/mainNav.php';
                echo     ' <main class=\'main\'>
                         <div class="logIn">
                             <h3>Welcome Administrator</h3>
                         </div>
                         <form class="registration" action="'.$self.'" method="post">
                             <fieldset>
                                 <legend>User registration form</legend>
                                 <div>
                                     <label for="title">Title*</label>
                                     <select name="title">
                                         <option value="0"></option>
                                         <option value="1"';if($titleSelect == 'Dr'){echo'selected';};echo'>Dr</option>
                                         <option value="2"';if($titleSelect == 'Mr'){echo'selected';};echo'>Mr</option>
                                         <option value="3"';if($titleSelect == 'Mrs'){echo'selected';};echo'>Mrs</option>
                                         <option value="4"';if($titleSelect == 'Miss'){echo'selected';};echo'>Miss</option>
                                     </select>';if(isset($errorForm['selected'])){echo'<span class="red">Title is required</span>';} echo'
                                 </div>
                                 <div>
                                     <label for="fName">First Name*</label>
                                     <input type="text" name="fName" value="';if (isset($cleanForm['fName'])) {
                                         echo $cleanForm['fName'];
                                     };echo'" id="fName"><span class="red">';if (isset($errorForm['fName'])) {
                                         echo $errorForm['fName'];
                                     };echo'</span>
                                 </div>
                                 <div>
                                     <label for="sName">Surname*</label>
                                     <input type="text" name="sName" value="';if (isset($cleanForm['sName'])) {
                                         echo $cleanForm['sName'];};echo'" id="sName"><span class="red">';if (isset($errorForm['sName'])) {
                                         echo $errorForm['sName'];
                                     };echo'</span>
                                 </div>
                                 <div>
                                     <label for="email">Email*</label>
                                     <input type="text" name="email" value="';if (isset($cleanForm['email'])) {
                                         echo $cleanForm['email'];
                                     };echo'" id="email"><span class="red">';if (isset($errorForm['email'])) {
                                         echo $errorForm['email'];
                                     };echo'</span>
                                 </div>
                                 <div>
                                     <label for="userName">Username*</label>
                                     <input type="text" name="userName" value="';if (isset($cleanForm['userName'])) {
                                         echo $cleanForm['userName'];
                                     };echo'" id="userName" >';if (isset($errorForm['userName'])) {
                                         echo '<span class="red">'.$errorForm['userName'].'</span>';
                                     }else{
                                         echo'<span class="hint">5 characters min. At least 2 digit.</span>';};echo'

                                 </div>
                                 <div>
                                     <label for="password">Password*</label>
                                     <input type="text" name="password" id="password">';if(isset($errorForm['password'])){
                                         echo'<span class="red">'.$errorForm['password'].'</span>';}else{
                                         echo'<span class=\'hint\'>Characters and digit.1 capital and 1 lower letter</span>';
                                     }echo'
                                 </div>
                                 <div>
                                     <input type="submit" name="submitRegistration" value="Register">
                                 </div>
                             </fieldset>
                         </form>

                     </main>
                 </div>
                 <footer>';
                     include 'include/footer.php';

        echo    '</footer>
            </body>
       </html>';

    }else {
        echo'        <!--Musso Andrea 09-12-2016 FMA
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
