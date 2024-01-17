<!DOCTYPE html>
<html lang="en">
    <?php include './modules/head.php'; ?>

    <body>
        <?php include './modules/header.php'; ?>

        <main>

            <!--Log in -->
            <div class="container my-3">
    
                <div class="mx-auto" style="width:150px">
                    <h2>Log In</h2>
                </div>
    
                <form action="#">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                        <label for="email">Email</label>
                    </div>
    
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                        <label for="pwd">Password</label>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            </div>


            <!--Register -->
            <div class="container mt-3">
    
                <div class="mx-auto" style="width:150px">
                    <h2 class="mx-auto">Register</h2>
                </div>
                
                <form action="#">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                        <label for="email">Email</label>
                    </div>
    
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="pwd" placeholder="Enter Password" name="pswd">
                        <label for="pwd">Password</label>
                    </div>
    
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
                        <label for="fname">First Name</label>
                    </div>
    
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
                        <label for="lname">Last Name</label>
                    </div>
    
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="bday" placeholder="Enter Birthday" name="bday">
                        <label for="bday">Birthday</label>
                    </div>
    
                    
                    <div class="form-floating mt-3 mb-3">
                        <input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone">
                        <label for="phone">Phone Number</label>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>

        </main>

        <?php include './modules/footer.php'; ?>
    </body>
</html>