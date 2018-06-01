


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter your Account Information to Login:</h4>
            </div>
            <div class="modal-body">
                <div id="modalLogin">
                    <h3>My Account</h3>
                    <br>
                    <form method="POST" action="loginprocess.php">
                        <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-2">
                        <label for="modalEmail">Email:</label>
                        </div>
                        <div class="col-lg-3">
                        <input  type="email" id="modalEmail" name="modalEmail" placeholder="example@gmail.com" >
                        </div>
                        <div class="col-lg-4"></div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-2">
                        <label for="modalPassword">Password:</label>
                        </div>
                        <div class="col-lg-3">
                        <input type="password" id="modalPassword" name="modalPassword" placeholder="*******">
                        </div>
                        </div>
                        <br>
                        <span class="errorText"><?php echo $errorMessage; ?></span>
                        <br>
                        <a href="forgotpassword.php"><p>Forgot your password?</p></a>
                        <input type="submit" value="submit" name = "modalSubmit" id="modalSubmit">
                        <input type ="button" value="cancel" id="modalCancel" data-dismiss="modal">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>