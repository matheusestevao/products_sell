<?php
require_once 'views/layout/master.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Novo Tipo de Produto</h1>
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
                        <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Informe o Tipo de Documento" value="<?php echo !isset($typeProduct) ? '' : $typeProduct['name'] ?>">
                    </div>

                    <div class="col-sm-3">
                        <label for="firstName" class="form-label">Imposto (%)</label>
                        <input type="number" name="tax" class="form-control" id="floatingInput" placeholder="15.5" step="0.01" value="<?php echo !isset($typeProduct) ? '' : $typeProduct['tax'] / 100 ?>">
                    </div>
                </div>
                
                <div class="row">
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