<div class="modal fade bd-example-modal-lg" id="category-update-modal<?php echo $row['category_id']?>" tabindex="-1" role="dialog" aria-labelledby="category-update-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-update-modal-label">Update Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="category.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label class="col-form-label" for="name">Category Name</label>
                            <input class="form-control" name="name" type="text" value="<?php echo $row['name']?>" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label class="col-form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" type="text" required><?php echo $row['description']?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="category_id" value="<?php echo $row['category_id']?>" />
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal" />
                    <input class="btn btn-primary" style="font-size: 13px;" name="form-update-category" type="submit" value="Update" />
                </form>
            </div>
        </div>
    </div>
</div>