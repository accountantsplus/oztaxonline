    <script src="https://www.paypal.com/sdk/js?client-id=AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ&currency=AUD&disable-funding=credit,card"></script>
https://stackoverflow.com/questions/68832362/paypal-javascript-sdk-with-a-php-server
<!-- paypal start -->

<div id="smart-button-container">
      <div style="text-align: center;">
        <div style="margin-bottom: 1.25rem;">
          <p>Appster - including updates</p>
          <select id="item-options"><option value="Annual" price="360.00">Annual - 360.00 AUD</option><option value="Monthly" price="30.00">Monthly - 30.00 AUD</option></select>
          <select style="visibility: hidden" id="quantitySelect"></select>
        </div>
      <div id="paypal-button-container"></div>
      </div>
    </div>
    <!--
    <?php
        $url = "https://www.paypal.com/sdk/js";
        $url .= "?client-id=" . "client-id=AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ";
        $url .= "&disable-funding=credit,card";
        $url .= "&debug=true";
        $url .= "&commit=true";
        $url .= "&currency=AUD";
        $url .= "&locale=en_AU";
        echo '<script src="' . $url . '" data-sdk-integration-source="button-factory"></script>' . PHP_EOL;
    ?>-->
    <script src="https://www.paypal.com/sdk/js?client-id=AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ&currency=AUD&disable-funding=credit,card"></script>

    <!-- <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=GBP" data-sdk-integration-source="button-factory"></script> -->
    <script>
        function initPayPalButton() {
            var shipping = 0;
            var itemOptions = document.querySelector("#smart-button-container #item-options");
            var quantity = parseInt();
            var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
            
            if (!isNaN(quantity)) {
                quantitySelect.style.visibility = "visible";
            }
            
            var orderDescription = 'Appster - including upgrades';
            if(orderDescription === '') {
                orderDescription = 'Item';
            }
            
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',
        
      },

            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('createOrder.php', {
                    method: 'post'
                }).then(function(res) {
                    console.log(res.json());
                    return res;
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            /*
      createOrder:
      function(data, actions) {
        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
        var tax = (20 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(20)/100));
        if(quantitySelect.options.length > 0) {
          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
        } else {
          quantity = 1;
        }

        tax *= quantity;
        tax = Math.round(tax * 100) / 100;
        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
        priceTotal = Math.round(priceTotal * 100) / 100;
        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

        return actions.order.create({
          purchase_units: [{
            description: orderDescription,
            amount: {
              currency_code: 'AUD',
              value: priceTotal,
              breakdown: {
                item_total: {
                  currency_code: 'AUD',
                  value: itemTotalValue,
                },
                shipping: {
                  currency_code: 'AUD',
                  value: shipping,
                },
                tax_total: {
                  currency_code: 'AUD',
                  value: tax,
                }
              }
            },
            items: [{
              name: selectedItemDescription,
              unit_amount: {
                currency_code: 'AUD',
                value: selectedItemPrice,
              },
              quantity: quantity
            }]
          }]
        });
      },
      */
    onApprove:
        function(data, actions)
        {
            return actions.order.capture().then
            (
                function(orderData)
                {
                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');
                    actions.redirect('paymentReceived.php');
                    //var successfulPurchase = document.getElementById('successfulPurchase');
                    //successfulPurchase.style.display = 'table-row';
                }
            );
        },
    onError: 
        function(err)
        {
            alert("Payment Failed");
            console.log(err);
        },
    }).render('#paypal-button-container');
  }
  initPayPalButton();
    </script>
    
<!-- paypal end -->