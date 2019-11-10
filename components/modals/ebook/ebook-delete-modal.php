<div class="modal fade bd-example-modal-lg" id="ebook-delete-modal<?php echo $row["ebook_id"]?>" tabindex="-1" role="dialog" aria-labelledby="ebook-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ebook-delete-modal-label">Delete Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="ebook.php?page=<?php echo $page?>" method="POST">
                    <p>Are you sure to delete that?</p>
                    <input type="hidden" name="ebook_id" value="<?php echo $row['ebook_id']?>">
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input name="form-delete-ebook" class="btn btn-danger" type="submit" value="Delete" />
                </form>
            </div>
        </div>
    </div>
</div>