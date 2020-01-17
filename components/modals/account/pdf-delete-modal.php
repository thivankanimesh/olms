<div class="modal fade bd-example-modal-md" id="pdf-delete-modal<?php echo $row["ebook_ebook_id"]?>" tabindex="-1" role="dialog" aria-labelledby="pdf-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdf-delete-modal-label">Delete eBook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="account.php?page=<?php echo $page?>" method="POST">
                    <p>Are you sure to delete that?</p>
                    <input type="hidden" name="ebook_ebook_id" value="<?php echo $row['ebook_ebook_id']?>">
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input name="form-delete-pdf" class="btn btn-danger" type="submit" value="Delete" />
                </form>
            </div>
        </div>
    </div>
</div>