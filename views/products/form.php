<?php

require_once 'views/layout/master.php';

?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <?php
                if(!isset($product)) {?>
                    <h1 class="h2">Novo Produto</h1>
            <?php
                } else {?>
                    <h1 class="h2">Editar Produto</h1>
            <?php
                }?>
        </div>
    </main>

    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-md-12 col-lg-12 order-md-last">
            <?php
                if(!isset($product)) {?>
                    <form action="<?php echo URL_BASE . '/products/store'?>" method="POST">
            <?php
                } else {?>
                    <form action="<?php echo URL_BASE . '/products/update/' . $product['id']?>" method="POST">
            <?php
                }?>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Nome</label>
                        <input type="text" required name="name" class="form-control name" id="name" placeholder="Nome do Produto" value="<?php echo !isset($product) ? '' : $product['name'] ?>">
                    </div>

                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Valor Sem Imposto <small>(R$)</small></label>
                        <input type="number" required name="value" class="form-control value" id="value" placeholder="15.5" step="0.01" value="<?php echo !isset($product) ? '' : $product['value'] / 100 ?>">
                    </div>

                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Tipo de Produto</label>
                        <select name="type_product_id" required class="form-control type_product_id" id="type_product_id">
                            <option value="">Selecione...</option>
                            <?php
                                foreach ($typeProducts as $typeProduct) {?>
                                    <option value="<?php echo $typeProduct['id']?>"
                                        <?php echo isset($product) && $typeProduct['id'] == $product['type_product_id'] ? 'selected' : ''?>
                                    >
                                        <?php echo $typeProduct['name']?>
                                    </option>
                            <?php
                                }?>
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Valor Com Imposto <small>(R$)</small></label>
                        <input type="number" class="form-control value-tax" id="value-tax" disabled>
                    </div>
                </div>
                
                <div class="row mt-4 justify-content-between">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="text-right">
                            <a class="w-100 btn btn-sm btn-danger mt-5" href="/products" type="submit">Voltar</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="text-right">
                            <button class="w-100 btn btn-sm btn-primary mt-5" type="submit"><?php echo !isset($product) ? 'Salvar' : 'Atualizar' ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script src="/public/js/products.js"></script>

<?php
require_once 'views/layout/footer.php';

?>