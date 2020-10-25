<div class="modal fade bd-example-modal-lg" id="category-add-modal" tabindex="-1" role="dialog" aria-labelledby="category-add-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-add-modal-label">Add Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="category.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label class="col-form-label" for="name">Category Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter Category Name" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label class="col-form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" type="text" placeholder="Enter Description" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal" />
                    <input class="btn btn-primary" style="font-size: 13px;" name="form-add-category" type="submit" value="Add" />
                </form>
            </div>
        </div>
    </div>
</div>