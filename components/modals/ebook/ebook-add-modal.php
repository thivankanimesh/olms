<div class="modal fade bd-example-modal-lg" id="ebook-add-modal" tabindex="-1" role="dialog" aria-labelledby="author-add-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ebook-add-modal-label">Add eBook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="ebook.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="title">Title</label>
                            <input class="form-control" name="title" type="text" placeholder="Enter eBook Title" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="catergory">Catergory</label>
                            <input class="form-control" name="catergory" type="text" placeholder="Enter Catergory" required/>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="author">Author</label>
                            <input class="form-control" name="author" type="text" placeholder="Enter Author" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="col-form-label" for="price">Price</label>
                            <input class="form-control" name="price" placeholder="Enter Price" type="number" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="description">Enter Description</label>
                        <textarea class="form-control" name="description" type="text" placeholder="Enter Description" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="coverpic">Choose Cover Picture</label>
                            <input class="form-control" name="coverpic" type="file" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="pdf">Choose Pdf</label>
                            <input class="form-control" name="pdf" type="file" required />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input name="form-add-ebook" type="submit" class="btn btn-primary" value="Add" />
                </form>
            </div>
        </div>
    </div>
</div>