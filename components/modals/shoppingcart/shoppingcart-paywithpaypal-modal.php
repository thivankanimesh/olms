<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Continue With Paypal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="text-align: center;">
          <img src="resources/img/modals/shoppingcart/paypal.png" width="300px" height="200px" />
        </div>
      <?php 

        define('PAYPAL_ID','thivankanimesh-facilitator@hotmail.com');
        define('PAYPAL_SANDBOX',TRUE);

        define('PAYPAL_RETURN_URL','http://localhost:80/grepanybook/paymentsuccess.php');
        define('PAYPAL_CANCEL_URL','index.php');
        define('PAYPAL_NOTIFY_URL','index.php');
        define('PAYPAL_CURRENCY','USD');

        define('PAYPAL_URL',(PAYPAL_SANDBOX==true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");

        echo '<form action="'.PAYPAL_URL.'" method="POST">

        <input type="hidden" name="item_name" value="sdsdsd">
        <input type="hidden" name="item_number" value="4545">
                <input type="hidden" name="business" value="'.PAYPAL_ID.'"/>
                <input type="hidden" name="cmd" value="_xclick"/>
                <input type="hidden" name="amount" value="'.$total_amount.'">
                <input type="hidden" name="currency_code" value="'.PAYPAL_CURRENCY.'"/>
                <input type="hidden" name="return" value="'.PAYPAL_RETURN_URL.'" />
                <input type="hidden" name="cancle_return" value="'.PAYPAL_CANCEL_URL.'" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" value="Continue with paypal" />
                </div>

            </form>';

        ?>
    </div>
  </div>
</div>







