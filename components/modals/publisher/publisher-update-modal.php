<div class="modal fade bd-example-modal-lg" id="publisher-update-modal<?php echo $row['publisher_id']?>" tabindex="-1" role="dialog" aria-labelledby="publisher-update-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publisher-update-modal-label">Update Publisher</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="publisher.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="fname">First Name</label>
                            <input class="form-control" name="fname" type="text" value="<?php echo $row['fname']?>" placeholder="Enter First Name" minlength="3" maxlength="50" pattern="^[a-zA-Z]+$" title="First name must be 3 or more letters & need to be letters only" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="lname">Last Name</label>
                            <input class="form-control" name="lname" type="text" value="<?php echo $row['lname']?>" placeholder="Enter First Name" minlength="3" maxlength="50" pattern="^[a-zA-Z]+$" title="Last name must be 3 or more letters & need to be letters only" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-form-label" for="email">Enter Email</label>
                        <input class="form-control" name="email" type="email" value="<?php echo $row['email']?>" required/>
                    </div>
                    <input type="hidden" name="publisher_id" value="<?php echo $row['publisher_id']?>" />
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal" />
                    <input class="btn btn-primary" style="font-size: 13px;" name="form-update-publisher" type="submit" value="Update" />
                </form>
            </div>
        </div>
    </div>
</div>