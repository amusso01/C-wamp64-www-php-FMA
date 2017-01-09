<!DOCTYPE html>
<!--Musso Andrea 09-12-2016 FMA
Student number : 13026841
Course : Web Programming using PHP
P1 FMA
Tutor : Tobi Brodie  -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <?php
        require_once 'include/function.php';
        include 'include/head.php'
     ?>
    <body>
     <header role="banner">
         <?php include 'include/header.php'; ?>
     </header>
     <div class="wrapper">
         <?php  include 'include/mainNav.php' ?>
         <main id='info'>
             <h4>Department of Computer Science and Information Systems</h4>
             <p>The Department of Computer Science and Information Systems at Birkbeck traces its roots back to 1946 when Dr A Booth started building the College’s first computer in his Computer Laboratory.
                 The Department of Computer Science was established in 1957. Today the Department continues as a leading centre of computing expertise, specialising in information and knowledge management, web and pervasive technologies,
                 computational intelligence and information systems development.</p>
         </main>
         <section role="main">
             <article class="homepage">
                 <h5>Section title</h5>
                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
             </article>
             <article class="homepage">
                 <h5>Section title</h5>
                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

             </article>
         </section>
     </div>
         <footer>
             <?php include 'include/footer.php' ?>
         </footer>

    </body>
</html>
