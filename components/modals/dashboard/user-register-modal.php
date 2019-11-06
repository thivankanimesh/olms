<div class="modal fade bd-example-modal-lg" id="user-register-modal" tabindex="-1" role="dialog" aria-labelledby="user-register-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-register-modal-label">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="user-register.php" method="POST" enctype="multipart/form-data">
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

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="col-form-label" for="birthday">Birthday</label>
                            <input class="form-control" type="date" name="birthday" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="col-from-label" for="ugender">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ugender" value="Male" required />
                                <label class="form-check-label" for="">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ugender" value="Female" required />
                                <label class="form-check-label" for="">Female</label>
                            </div>
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
                        <input class="form-control" name="mobile" type="tel" placeholder="Enter Mobile Number" required/>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="propic">Upload Profile Picture</label>
                        <input class="form-control" name="propic" type="file" required>
                    </div>   
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input type="submit" class="btn btn-primary" value="Register" />
                </form>
            </div>
        </div>
    </div>
</div>