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
                    let newValue = (value * (1 + (data.tax / 100) / 100)) 
                    
                    $('.value-tax').val(newValue / 10);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    }).trigger('change');
})