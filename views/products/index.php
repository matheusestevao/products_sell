<?php

use App\Classes\Helper;

require_once 'views/layout/master.php';

$helper = new Helper();
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Produtos</h1>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a href="<?php echo URL_BASE . '/products/create'?>" class="btn btn-primary">Adicionar Produto</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo de Produto</th>
                    <th scope="col">Valor <small>(Sem Imposto)</small></th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($products as $product) {?>
                        <tr>
                            <td><?php echo $product['id'] ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $helper->relationship('type_products', $product['type_product_id'])['name'] ?></td>
                            <td>R$ <?php echo number_format($product['value'] / 100, 2, ',', '.') ?></td>
                            <td>
                                <a href="<?php echo URL_BASE . '/products/edit/' . $product['id']?>" class="btn-sm btn-primary" title="Editar">
                                    <span data-feather="edit"></span>
                                </a>
                            </td>
                        </tr>
                <?php
                    }?>
            </tbody>
            </table>
      </div>
    </main>

<?php
require_once 'views/layout/footer.php';
?>