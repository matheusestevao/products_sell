function sumValues() {
    let newTotal = 0;
    let newTotalTax= 0;
    let sumTax = 0;

    $('.insertSaleProduct_value_total').each(function() {
        if ($(this).val() === "") {
            return
        }

        newTotal += parseFloat($(this).val());
    });

    $('.insertSaleProduct_value_total_tax').each(function() {
        if ($(this).val() === "") {
            return
        }

        newTotalTax += parseFloat($(this).val());
    });

    $('.total').val((parseFloat(newTotal)).toFixed(2));
    $('.total_tax').val((parseFloat(newTotalTax)).toFixed(2));
    $('.sum_tax').val((parseFloat(newTotalTax) - parseFloat(newTotal)).toFixed(2));
}


$(document).ready(function() {
    let idenRecord = 0;

    $(".add-products").on('click', function() {
        var clone = $("#boxProducts tbody").html();

        clone = clone.replace(/\[X\]/g, "["+idenRecord+"]");
        clone = clone.replace(/__X/g, "__"+idenRecord);

        $("#boxViewProducts tbody").append(clone);

        idenRecord++;
    });

    $(document).on("click", ".btn-remove", function(){
        $(this).closest('.products').remove();

        sumValues()
    });

    $(document).on('blur', '.insertSaleProduct_amount', function() {
        let reference = $(this).attr('data-reference')
        let product = $('select[rel="insertSaleProduct_product_id' + reference + '"]').val();
        let amount = $(this).val();

        if(product && amount) {
            $.ajax({
                url: '/products/info_sale',
                type: 'POST',
                data: {
                    product: product,
                    amount: amount
                },
                success: function(data) {
                    $('input[rel="insertSaleProduct_value_amount' + reference + '"]').val(data.value_amount)
                    $('input[rel="insertSaleProduct_value_amount_tax' + reference + '"]').val(data.value_tax)
                    $('input[rel="insertSaleProduct_value_total' + reference + '"]').val(data.value_total)
                    $('input[rel="insertSaleProduct_value_total_tax' + reference + '"]').val(data.value_total_tax)

                    sumValues()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
})