<?php 
    // Getting Author List
    $author_row_list = array();
    $query = "select*from author where admin_id=".$admin_id;
    $author_result = mysqli_query($con,$query);

    while($author_array = mysqli_fetch_array($author_result)){
        $author_row_list[] = $author_array;
    }
    
    // Getting Category List
    $category_row_list = array();
    $query = "select*from category where admin_id=".$admin_id;
    $category_result = mysqli_query($con,$query);

    while($category_array = mysqli_fetch_array($category_result)){
        $category_row_list[] = $category_array;
    }

    // Getting Publisher List
    $publisher_row_list = array();
    $query = "select*from publisher where admin_id=".$admin_id;
    $publisher_result = mysqli_query($con,$query);

    while($publisher_array = mysqli_fetch_array($publisher_result)){
        $publisher_row_list[] = $publisher_array;
    }
?>

<div class="modal fade bd-example-modal-lg" id="ebook-update-modal<?php echo $row['ebook_id']?>" tabindex="-1" role="dialog" aria-labelledby="author-update-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ebook-update-modal-label">Update eBook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="ebook.php?page=<?php echo $page?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="title">Title</label>
                            <input class="form-control" name="title" type="text" value="<?php echo $row['title'] ?>" placeholder="Enter eBook Title" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="category_id">Category</label>
                            <select class="form-control" name="category_id" required>
                                <?php
                                    foreach($category_row_list as $category){
                                        $value = "";
                                        if($row['category_category_id']==$category['category_id']){
                                            $value = "selected";
                                        }
                                        echo '<option value="'.$category['category_id'].'" '.$value.'>'.$category['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="author_id">Author</label>
                            <select class="form-control" name="author_id" required>
                                <?php 
                                    foreach($author_row_list as $author){
                                        $value = "";
                                        if($row['author_author_id']==$author['author_id']){
                                            $value = "selected";
                                        }
                                        echo '<option value="'.$author['author_id'].'" '.$value.'>'.$author['fname'].' '.$author['lname'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="publisher_id">Publisher</label>
                            <select class="form-control" name="publisher_id" required>
                                <?php
                                    foreach($publisher_row_list as $publisher){
                                        $value = "";
                                        if($row['publisher_publisher_id']==$publisher['publisher_id']){
                                            $value = "selected";
                                        }
                                        echo '<option value="'.$publisher['publisher_id'].'" '.$value.'>'.$publisher['fname'].' '.$publisher['lname'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="col-form-label" for="price">Price</label>
                            <input class="form-control" name="price" value="<?php echo $row['price']?>" type="number" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="description">Enter Description</label>
                        <textarea class="form-control" name="description" type="text" required><?php echo $row['description'] ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="coverpic">Choose Cover Picture</label>
                            <input class="form-control" name="coverpic" type="file" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="pdf">Choose Pdf</label>
                            <input class="form-control" name="pdf" type="file" />
                        </div>
                    </div>

                    <input type="hidden" name="ebook_id" value="<?php echo $row['ebook_id'] ?>" />
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal"/>
                    <input name="form-update-ebook" type="submit" class="btn btn-primary" value="Update" />
                </form>
            </div>
        </div>
    </div>
</div>