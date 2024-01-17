 <button type="button" class="btn btn-light mx-md-4 mx-sm-1" data-bs-toggle="modal" data-bs-target="#userLoginModal">
   Sign&nbsp;In
 </button>

 <div class="modal fade text-center text-dark" id="userLoginModal" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="modalTitle">Sign In</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body bg-light">
         <!---- Login ---->
         <h3>Login</h3>
         <?php if (isset($_GET['error'])) { ?>
           <h4 id="error" class="error"> <?php echo $_GET['error']; ?> </h4>
         <?php } ?>
         <form action="login/userLogin.php" method="post">
           <!-- Email -->
           <div class="mb-3 mt-3 text-start">
             <label class="text-start" for="email">
               Username or Email
             </label>
             <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
           </div>
           <!-- Password -->
           <div class="mt-3 mb-3 text-start">
             <label class="text-start" for="password">Password</label>
             <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
           </div>
           <!-- Submit -->
           <button type="submit" class="btn btn-dark">Log In</button>
         </form>
         <hr>
         <h4>OR</h4>
         <hr>
         <a href="./signup.php" class="btn btn-primary">Sign Up</a>
         <!-- Admin Log In Modal  -->
         <div class="container-fluid  ">
           <div class="container clearfix">
             <button type="button" class="btn btn-link float-end text-dark" data-bs-toggle="modal" data-bs-target="#adminLoginModal">
               Admin Log In
             </button>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>