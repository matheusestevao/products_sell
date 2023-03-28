$(document).ready(function() {
    $('.type_product_id').change(function() {
        let typeProduct = $(this).val();
        let value = $('.value').val();

        if(typeProduct) {
            $.ajax({
                url: '/type_products/info',
                type: 'POST',
                data: {
                    typeProduct: typeProduct
                },
                success: function(data) {
                    let newValue = (value * ((data.tax / 100) + 1)) 
                    
                    $('.value-tax').val(newValue / 10);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    }).trigger('change');
})