 /**
 * @file
 * Leng Theme JS.
 */
(function ($, Drupal) {

    'use strict';

    /**
     * Close behaviour.
     */
    Drupal.behaviors.quantityIncDec = {
      attach: function (context) {
        $(".use-ajax-submit").hide();
        $(".number-btn").once().on("click", function() {

            var $button = $(this);
            var oldValue = parseInt($button.parent().find("input").val());
            var newVal;

            if ($button.text() === "+") {
              newVal = oldValue + 1;
            } else {
              // Don't allow decrementing below zero
              newVal = (oldValue > 1) ? oldValue - 1 : 1;
            }
            $button.parent().find("input").val(newVal);
            updateValues(this, newVal);
          });

        $(".number-btn").parent().find("input").once().on("input",(function(){
            updateValues(this, $(this).val());
        }));
        function updateValues(data, quantity) {
          if (isNaN(quantity)) {
            return;
          }
          if (quantity > 0) {
            var frm = $.post("/cart", $(data.form).serialize());
          }

          // convert price to valid numbers (remove currency)
          var parent = $(data).parents(".cart-row");
          var price = parent.find(".views-field-unit-price__number");
          price = Number(price.text().replace(/[^0-9,.-]+/g,""));

          var totalHtml = parent.find(".views-field-total-price__number");
          var currency = totalHtml.text().replace(/[~^0-9\s,.-]+/g,"");
          var total = parseFloat(price * quantity).toFixed(2);
          totalHtml.text(currency + total);
          
          var allTotals = 0;
          var allTotalsHtmls = $(data.form).find(".views-field-total-price__number");
          $.each(allTotalsHtmls, function(key, item){
            var itemTotal =Number($(item).text().replace(/[^0-9,.-]+/g,""));
            allTotals+=itemTotal;
          })

          var lineTotalHtml = $(data.form).find(".order-total-line-value");
          lineTotalHtml.text(currency + parseFloat(allTotals).toFixed(2));
        }
      }
    };

  })(jQuery, Drupal);
