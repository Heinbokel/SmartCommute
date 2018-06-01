



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
                    <p>My Account</p>
                    <form method="GET" action="loginprocess.php">
                        <label for="modalEmail">Email:</label>
                        <input  type="email" id="modalEmail" name="modalEmail" placeholder="example@gmail.com">
                        <br>
                        <label for="modalPassword">Password:</label>
                        <input type="password" id="modalPassword" name="modalPassword" placeholder="*******">
                        <br>
                        <span class="errorText"><?php echo $errorMessage; ?></span>
                        <br>

                        <input type="submit" value="submit" name = "modalSubmit" id="modalSubmit">
                        <input type ="button" value="cancel" id="modalCanel" data-dismiss="modal">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>