<div class="modal fade bd-example-modal-lg" id="seller-register-modal" tabindex="-1" role="dialog" aria-labelledby="seller-register-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seller-register-modal-label">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="seller-register.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="fname">First Name</label>
                            <input class="form-control" name="fname" type="text" placeholder="Enter First Name" minlength="3" maxlength="50" pattern="^[a-zA-Z]+$" title="First name must be 3 or more letters & need to be letters only" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="lname">Last Name</label>
                            <input class="form-control" name="lname" type="text" placeholder="Enter Last Name" minlength="3" maxlength="50" pattern="^[a-zA-Z]+$" title="Last name must be 3 or more letters & need to be letters only" required/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label" for="email">Enter Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter Email" required/>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="password">Enter Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Enter Password" required/>
                        </div>
                
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="re-password">Re-enter Password</label>
                            <input class="form-control" name="re-password" type="password" placeholder="Re-enter Password" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="phone">Enter Mobile Number</label>
                        <input class="form-control" name="mobile" type="tel" placeholder="Enter Mobile Number" pattern="^[=+\s]*(?:[0-9][=+\s]*){10,}$" title="Mobile number only" required/>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="propic">Upload Profile Picture</label>
                        <input class="form-control" name="propic" type="file" accept="image/x-png,image/gif,image/jpeg" required>
                    </div>   
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal"/>
                    <input class="btn btn-primary" style="font-size: 13px;" type="submit" value="Register" />
                </form>
            </div>
        </div>
    </div>
</div>