<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Roles
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Roles</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="rolesTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                                <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                                <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <!--<td><?= $this->Number->format($role->id) ?></td>-->
                                <td><?= h($role->name) ?></td>
                                <td><?= h($role->title) ?></td>
                                <td>
                                    <?= $role->enabled ? __('Yes') : __('No') ?>
                                    &nbsp;
                                    <?php
                                    if ($role->enabled) {
                                        echo $this->Form->postLink(__('Disable'), ['action' => 'enable', $role->id], ['escape' => false, 'confirm' => __('Are you sure you want to disable this entry?'), 'class' => 'btn btn-default btn-xs']);
                                    } else {
                                        echo $this->Form->postLink(__('Enable'), ['action' => 'enable', $role->id], ['escape' => false, 'confirm' => __('Are you sure you want to enable this entry?'), 'class' => 'btn btn-default btn-xs']);
                                    }
                                    ?>
                                </td>
                                <!--<td><?= h($role->created) ?></td>-->
                                <!--<td><?= h($role->modified) ?></td>-->
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $role->id], ['escape' => false, 'class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id], ['escape' => false, 'class' => 'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                            <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                            <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
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

<?php $this->start('css'); ?>
<?php echo $this->Html->css('DejwCake/AdminLTE./plugins/datatables/dataTables.bootstrap.css'); ?>
<?php $this->end(); ?>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/datatables/jquery.dataTables.min.js'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/datatables/dataTables.bootstrap.min.js'); ?>
<script>
    $(function () {
        $('#rolesTable').DataTable({
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
