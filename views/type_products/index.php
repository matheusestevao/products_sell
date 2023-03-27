<?php
require_once 'views/layout/master.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tipos de Produtos</h1>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a href="<?php echo URL_BASE . '/type_products/create'?>" class="btn btn-primary">Adicionar Tipo de Produto</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Taxa de Imposto (%)</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($typeProducts as $typeProduct) {
                ?>
                    <tr>
                        <td><?php echo $typeProduct['id'] ?></td>
                        <td><?php echo $typeProduct['name'] ?></td>
                        <td><?php echo $typeProduct['tax'] / 100 ?></td>
                        <td>
                            <a href="<?php echo URL_BASE . '/type_products/edit/' . $typeProduct['id']?>" class="btn-sm btn-primary" title="Editar">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
            </table>
      </div>
    </main>

<?php
require_once 'views/layout/footer.php';
?>