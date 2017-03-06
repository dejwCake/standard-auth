<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __d('dejw_cake_standard_auth', 'Users') ?>
        <div class="pull-right"><?= $this->Html->link(__d('dejw_cake_standard_auth', 'New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __d('dejw_cake_standard_auth', 'List of Users') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="usersTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('email', __d('dejw_cake_standard_auth', 'E-mail')) ?></th>
                                <th scope="col"><?= $this->Paginator->sort('activated', __d('dejw_cake_standard_auth', 'Activated')) ?></th>
                                <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                                <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                                <th scope="col" class="actions"><?= __d('dejw_cake_standard_auth', 'Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <!--<td><?= $this->Number->format($user->id) ?></td>-->
                                <td><?= h($user->email) ?></td>
                                <td>
                                    <?= $user->activated ? __d('dejw_cake_standard_auth', 'Yes') : __d('dejw_cake_standard_auth', 'No') ?>
                                <!--<td><?= h($user->created) ?></td>-->
                                <!--<td><?= h($user->modified) ?></td>-->
                                <td class="actions" style="white-space:nowrap">
                                    <?php if ( !empty($authUser) && $user->canEdit($authUser)):?>
                                    <?= $this->Html->link(__d('dejw_cake_standard_auth', 'View'), ['action' => 'view', $user->id], ['escape' => false, 'class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__d('dejw_cake_standard_auth', 'Edit'), ['action' => 'edit', $user->id], ['escape' => false, 'class' => 'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__d('dejw_cake_standard_auth', 'Delete'), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_auth', 'Are you sure you want to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                            <th scope="col"><?= $this->Paginator->sort('email', __d('dejw_cake_standard_auth', 'E-mail')) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('activated', __d('dejw_cake_standard_auth', 'Activated')) ?></th>
                            <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                            <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                            <th scope="col" class="actions"><?= __d('dejw_cake_standard_auth', 'Actions') ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->

<?php $this->append('css'); ?>
<?php echo $this->Html->css('DejwCake/AdminLTE./plugins/datatables/dataTables.bootstrap.css'); ?>
<?php $this->end(); ?>
<?php $this->append('scriptBottom'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/datatables/jquery.dataTables.min.js'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/datatables/dataTables.bootstrap.min.js'); ?>
    <script>
        $(function () {
            $('#usersTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true
            });
        });
    </script>
<?php $this->end(); ?>
