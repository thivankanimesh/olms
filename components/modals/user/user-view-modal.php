<div class="modal fade bd-example-modal-lg" id="user-view-modal<?php echo $row['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="user-view-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-view-modal-label">View User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <img class="img-fluid" src="resources/uploads/propics/users/<?php echo $row['propic']?>" alt="" />
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Name :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['fname'],' ',$row['lname']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Birthday :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['birthday']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Gender :</p>
                                </div>  
                                <div class="col-md-6">
                                    <p><?php echo $row['gender']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Mobile :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['mobile']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Email :</p>
                                </div>
                                <div class="col-md-6-fluid">
                                    <p><?php echo $row['email']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input class="btn btn-secondary" style="font-size: 13px;" type="button" value="Close" data-dismiss="modal" />
            </div>
        </div>
    </div>
</div>