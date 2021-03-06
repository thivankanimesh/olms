<div class="modal fade bg-example-modal-md" id="category-delete-modal<?php echo $row['category_id']?>" tabindex="-1" role="dialog" aria-labelledby="category-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-delete-modal-label">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="category.php?page=<?php echo $page?>" method="POST">
                    <p>Are you sure to delete that?</p>
                    <input type="hidden" name="category_id" value="<?php echo $row['category_id']?>" />
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal" />
                    <input class="btn btn-danger" style="font-size: 13px;" name="form-delete-category" type="submit" value="Delete" />
                </form>
            </div>
        </div>
    </div>
</div>