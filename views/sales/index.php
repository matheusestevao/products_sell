<?php
require_once 'views/layout/master.php';
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Vendas</h1>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a href="<?php echo URL_BASE . '/sales/create'?>" class="btn btn-primary">Gerar Venda</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data Venda</th>
                    <th scope="col">Total <small>(SEM impostos)</small></th>
                    <th scope="col">Total <small>(COM impostos)</small></th>
                    <th scope="col">Impostos</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($sales as $sale) {?>
                    <tr>
                        <td><?php echo $sale['id'] ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($sale['created_at']))?></td>
                        <td>R$ <?php echo number_format($sale['total'] / 100, 2, ',', '.') ?></td>
                        <td>R$ <?php echo number_format($sale['total_tax'] / 100, 2, ',', '.') ?></td>
                        <td>R$ <?php echo number_format(($sale['total_tax'] / 100) - ($sale['total'] / 100), 2, ',', '.') ?></td>
                        <td>
                            <a href="<?php echo URL_BASE . '/sales/show/' . $sale['id']?>" class="btn-sm btn-primary" title="Visualizar">
                                <span data-feather="eye"></span>
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