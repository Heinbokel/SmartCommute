

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!-- Modal -->
<div id="logoutModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirm Logout</h4>
            </div>
            <div class="modal-body">
                <div id="modalLogout">
                    <p>Are you sure you want to log out?</p>
                    <form method="GET" action="logout.php">
                        <input type="submit" value="Yes" name = "modalSubmit" id="modalSubmit">
                        <input type ="button" value="No" id="modalCancel" data-dismiss="modal">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>