<div class="modal fade bd-example-modal-lg" id="author-add-modal" tabindex="-1" role="dialog" aria-labelledby="author-add-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="author-add-modal-label">Add Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="author.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="fname">First Name</label>
                            <input class="form-control" name="fname" type="text" placeholder="Enter First Name" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="lname">Last Name</label>
                            <input class="form-control" name="lname" type="text" placeholder="Enter Last Name" required/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label" for="email">Enter Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter Email" required/>
                    </div>
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input name="form-add-author" type="submit" class="btn btn-primary" value="Add" />
                </form>
            </div>
        </div>
    </div>
</div>