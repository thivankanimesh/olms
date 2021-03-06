<div class="modal fade bg-example-modal-md" id="publisher-delete-modal<?php echo $row['publisher_id']?>" tabindex="-1" role="dialog" aria-labelledby="publisher-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publisher-delete-modal-label">Delete Publisher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="publisher.php?page=<?php echo $page?>" method="POST">
                    <p>Are you sure to delete that?</p>
                    <input type="hidden" name="publisher_id" value="<?php echo $row['publisher_id']?>" />
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal" />
                    <input class="btn btn-danger" style="font-size: 13px;" name="form-delete-publisher" type="submit" value="Delete" />
                </form>
            </div>
        </div>
    </div>
</div>