<?php
require_once 'views/layout/master.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <?php
                if(!isset($typeProduct)) {?>
                    <h1 class="h2">Novo Tipo de  Produto</h1>
            <?php
                } else {?>
                    <h1 class="h2">Editar Tipo de Produto</h1>
            <?php
                }?>
        </div>
    </main>

    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-md-12 col-lg-12 order-md-last">
            <?php
                if(!isset($typeProduct)) {?>
                    <form action="<?php echo URL_BASE . '/type_products/store'?>" method="POST">
            <?php
                } else {?>
                    <form action="<?php echo URL_BASE . '/type_products/update/' . $typeProduct['id']?>" method="POST">
            <?php
                }?>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Informe o Tipo de Documento" value="<?php echo !isset($typeProduct) ? '' : $typeProduct['name'] ?>">
                    </div>

                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Taxa de Imposto (%)</label>
                        <input type="number" name="tax" class="form-control" id="tax" placeholder="15.5" step="0.01" value="<?php echo !isset($typeProduct) ? '' : $typeProduct['tax'] / 100 ?>">
                    </div>
                </div>

                <div class="row mt-4 justify-content-between">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="text-right">
                            <a class="w-100 btn btn-sm btn-danger mt-5" href="/type_products" type="submit">Voltar</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="text-right">
                        <button class="w-100 btn btn-sm btn-primary mt-5" type="submit"><?php echo !isset($typeProduct) ? 'Salvar' : 'Atualizar' ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
require_once 'views/layout/footer.php';
?>