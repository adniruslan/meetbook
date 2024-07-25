<!-- POPUP APPEAR WHEN CLICKED -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this room?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="" method="post" id="deleteForm">
                    <input type="hidden" value="" name="roomID" id="roomID">
                    <button type="submit" class="btn btn-danger" id="deleteButton" onclick="deleteLink()">Delete</a><!--ON CLICK, CALLED FUNTION-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JS FOR POPUP -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

    // DECLARE
    var roomID;

    // GET CLASS
    var deleteLinks = document.getElementsByClassName('deleteLink');

    for (var i = 0; i < deleteLinks.length; i++) {
        // GET DATA-ID VALUE FOR THE CLICKED
        deleteLinks[i].addEventListener('click', function() {
            roomID = this.getAttribute('data-id');
        });
    }
    // FUNCTION TO SET ROOMID TO INPUT AND URL
    function deleteLink() {
        document.getElementById('roomID').value = roomID;
        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = 'backend/delete-room.php?id=' + roomID;
    }
</script>