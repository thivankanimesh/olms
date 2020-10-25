<div class="modal fade bd-example-modal-md" id="author-delete-modal<?php echo $row["author_id"]?>" tabindex="-1" role="dialog" aria-labelledby="author-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="author-delete-modal-label">Delete Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="author.php?page=<?php echo $page?>" method="POST">
                    <p>Are you sure to delete that?</p>
                    <input type="hidden" name="author_id" value="<?php echo $row['author_id']?>">
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal"/>
                    <input class="btn btn-danger" style="font-size: 13px;" name="form-delete-author" type="submit" value="Delete" />
                </form>
            </div>
        </div>
    </div>
</div>