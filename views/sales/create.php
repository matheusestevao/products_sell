<?php

require_once 'views/layout/master.php';

?>
    <main>
        <div class="py-5 text-center">
            <h2>Realizar Venda</h2>
        </div>

        <div class="row col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="col-md-12 col-lg-12">
                <hr class="my-4">   
                <form class="needs-validation sale" id="sale" novalidate action="/sales/store" method="POST">
                    <div class="form-row form-common">
                        <div class="form-group col-md-12">
                            <div class="col-lg-12 form-group" id="div-btn-add">
                                <a class="btn btn-success mt-2 add-products" style="color: white">
                                    Incluir Produto
                                </a>

                                <table class="table table-striped table-bordered" id="boxProducts" style="display: none">
                                    <tbody>
                                        <tr class="products">
                                            <input type="hidden" name="insertSaleProduct_idComponent[X]" value="">
                                            <td>
                                                <select 
                                                    name="insertSaleProduct_product_id[X]"
                                                    class="insertSaleProduct_product_id[X] form-control insertSaleProduct_product_id form-control-rounded select-course-training"
                                                    rel="insertSaleProduct_product_id[X]">
                                                    <option value=''>Selecione...</option>
                                                    <?php
                                                        foreach($products as $product) {?>
                                                        <option value="<?php echo $product['id']?>">
                                                            <?php echo $product['name']?>
                                                        </option>
                                                    <?php
                                                        }?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="insertSaleProduct_amount[X]" class="insertSaleProduct_amount[X] insertSaleProduct_amount form-control form-control-rounded" data-reference="[X]">
                                            </td>
                                            <td>
                                                <input type="number" name="insertSaleProduct_value_amount[X]" class="insertSaleProduct_value_amount[X] insertSaleProduct_value_amount form-control form-control-rounded" rel="insertSaleProduct_value_amount[X]" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="insertSaleProduct_value_amount_tax[X]" class="insertSaleProduct_value_amount_tax[X] insertSaleProduct_value_amount_tax form-control form-control-rounded" rel="insertSaleProduct_value_amount_tax[X]" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="insertSaleProduct_value_total[X]" class="insertSaleProduct_value_total[X] insertSaleProduct_value_total form-control form-control-rounded" rel="insertSaleProduct_value_total[X]" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="insertSaleProduct_value_total_tax[X]" class="insertSaleProduct_value_total_tax[X] insertSaleProduct_value_total_tax form-control form-control-rounded" rel="insertSaleProduct_value_total_tax[X]" readonly>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-remove" style="color: white">
                                                    Remover
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered" id="boxViewProducts" style="margin-top: 20px">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Valor Unit. <small>(SEM Imposto)</small></th>
                                            <th>Valor Unit. <small>(COM Importo)</small></th>
                                            <th>Valor Total. <small>(SEM Imposto)</small></th>
                                            <th>Valor Total. <small>(COM Imposto)</small></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <footer class="col-12 mb-5">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="firstName" class="form-label"><b>Valor Total <small>(SEM Impostos)</small></b></label>
                                <input type="number" name="total" class="form-control total" id="total" readonly>
                            </div>

                            <div class="col-sm-3">
                                <label for="firstName" class="form-label"><b>Valor Total <small>(COM Impostos)</small></b></label>
                                <input type="number" name="total_tax" class="form-control total_tax" id="total_tax" readonly>
                            </div>

                            <div class="col-sm-3">
                                <label for="firstName" class="form-label"><b>Valor Impostos</b></label>
                                <input type="number" name="sum_tax" class="form-control sum_tax" id="sum_tax" readonly>
                            </div>
                        </div>
                    </footer>

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar Venda</button>
                </form>
            </div>
        </div>
    </main>


<script src="/public/js/sales.js"></script>

<?php
require_once 'views/layout/footer.php';

?>