<div class="modal fade bd-example-modal-lg" id="category-view-modal<?php echo $row["category_id"]?>" tabindex="-1" role="dialog" aria-labelledby="category-view-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-view-modal-label">View Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Name :</p>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['name']?></p>
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
                </div>
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" style="font-size: 13px" type="button" value="Close" data-dismiss="modal"/>
            </div>
        </div>
    </div>
</div>