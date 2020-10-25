<div id="seller-login-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="seller-register-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seller-register-modal-lable">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="seller-login.php" method="POST">
                    <div class="form-row">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control" name="email" type="text" placeholder="Enter Email" required/>
                    </div>
                    <div class="form-row">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control" name="password" type="password" placeholder="Enter Password" required>
                    </div>
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px;" type="button" data-dismiss="modal" value="Close" />
                    <input class="btn btn-primary" style="font-size: 13px;" type="submit" value="Login" />
                </form>
            </div>
        </div>
    </div>
</div>