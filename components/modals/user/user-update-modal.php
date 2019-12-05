<div class="modal fade bd-example-modal-lg" id="user-update-modal<?php echo $row["user_id"]?>" tabindex="-1" role="dialog" aria-labelledby="user-update-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-update-modal-label">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="user.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="fname">First Name</label>
                            <input class="form-control" name="fname" type="text" value="<?php echo $row['fname'] ?>" placeholder="Enter First Name"  minlength="3" maxlength="10" pattern="^[a-zA-Z]+$" title="First name must be 3 or more letters & need to be letters only" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="lname">Last Name</label>
                            <input class="form-control" name="lname" type="text" value="<?php echo $row['lname'] ?>" placeholder="Enter Last Name"  minlength="3" maxlength="10" pattern="^[a-zA-Z]+$" title="First name must be 3 or more letters & need to be letters only" required/>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="birthday">Birthday</label>
                            <input class="form-control" name="birthday" type="date" value="<?php echo $row['birthday'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="ugender">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ugender" value="Male" <?php echo ($row['gender'] == "Male") ? "checked" : " " ?> required />
                                <label class="form-check-label" for="">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ugender" value="Female" <?php echo ($row['gender'] == "Female") ? "checked" : " " ?> required />
                                <label class="form-check-label" for="">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="email">Enter Email</label>
                        <input class="form-control" name="email" type="text" value="<?php echo $row['email']?>" placeholder="Enter Email" required/>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="mobile">Mobile</label>
                        <input class="form-control" name="mobile" type="tel" value="<?php echo $row['mobile'] ?>" pattern="^[=+\s]*(?:[0-9][=+\s]*){10,}$" title="Mobile number only" required />
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="propic">Upload Profile Picture</label>
                        <input class="form-file-control" name="propic" type="file" accept="image/x-png,image/gif,image/jpeg" />
                    </div>

                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']?>">
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input name="form-update-user" type="submit" class="btn btn-primary" value="Update" />
                </form>
            </div>
        </div>
    </div>
</div>