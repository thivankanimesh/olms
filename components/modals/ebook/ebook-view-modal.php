<div class="modal fade bg-example-modal-lh" id="ebook-view-modal<?php echo $row['ebook_id']?>" tabindex="-1" role="dialog" aria-labelledby="ebook-view-modal-label" aria-hidden="true"> 
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ebook-view-modal-label">View eBook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
            <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <img class="img-fluid" src="resources/uploads/sellers/ebooks/coverpic/<?php echo $row['cover_pic']?>" alt="" />
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Title :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['title']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Description :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['description']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Price :</p>
                                </div>  
                                <div class="col-md-6">
                                    <p><?php echo 'Rs :',$row['price']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Author :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['author_fname'],' ',$row['author_lname']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Publisher :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['publisher_fname'],' ',$row['publisher_lname']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Category :</p>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $row['category_name']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input class="btn btn-secondary" style="font-size: 13px" type="button" value="Close" data-dismiss="modal" />
            </div>
        </div>
    </div>
</div>