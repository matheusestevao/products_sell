<?php

use App\Classes\Helper;

require_once 'views/layout/master.php';

$helper = new Helper();
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Visualizar Venda</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Total. <small>(SEM Imposto)</small></th>
                    <th>Valor Total. <small>(COM Imposto)</small></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;
                    foreach($products as $product) {?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo $helper->relationship('products', $product['product_id'])['name'] ?></td>
                        <td><?php echo $product['amount'] ?></td>
                        <td>R$ <?php echo number_format(($product['value_amount'] / 100) * $product['amount'], 2, ',', '.') ?></td>
                        <td>R$ <?php echo number_format(($product['value_amount_tax'] / 100)  * $product['amount'], 2, ',', '.') ?></td>
                    </tr>
                <?php
                    }?>
            </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label for="firstName" class="form-label"><b>Valor Total <small>(SEM Impostos)</small></b></label>
                <input type="text" name="total" class="form-control total" id="total" disabled value="<?php echo number_format($sale['total'] / 100, 2, ',', '.') ?>">
            </div>

            <div class="col-sm-3">
                <label for="firstName" class="form-label"><b>Valor Total <small>(COM Impostos)</small></b></label>
                <input type="text" name="total_tax" class="form-control total_tax" id="total_tax" disabled value="<?php echo number_format($sale['total_tax'] / 100, 2, ',', '.')?>">
            </div>

            <div class="col-sm-3">
                <label for="firstName" class="form-label"><b>Valor Impostos</b></label>
                <input type="text" name="sum_tax" class="form-control sum_tax" id="sum_tax" disabled value="<?php echo number_format(($sale['total_tax'] / 100 - $sale['total'] / 100), 2, ',', '.')?>">
            </div>
        </div>
    </main>

<?php
require_once 'views/layout/footer.php';
?>