<div class="modal fade bg-example-modal-lg" id="shoppingcart-item-remove-modal<?php echo $row['shoppingcart_item_id']?>" tabindex="-1" role="dialog" aria-labelledby="shoppingcart-item-remove-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shoppingcart-item-remove-modal-label">Remove Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="shoppingcart.php" method="POST">
                    <p>Are you sure to remove that?</p>
                    <input type="hidden" name="shoppingcart_item_id" value="<?php echo $row['shoppingcart_item_id']?>" />
            </div>
            <div class="modal-footer">
                    <input class="btn btn-secondary" type="button" value="Close" data-dismiss="modal" />
                    <input class="btn btn-danger" name="form-remove-shoppingcart-item" type="submit" value="Remove" />
                </form>
            </div>
        </div>
    </div>
</div>