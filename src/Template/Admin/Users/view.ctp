<section class="content-header">
  <h1>
    <?php echo __d('dejw_cake_standard_auth', 'User'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __d('dejw_cake_standard_auth', 'Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __d('dejw_cake_standard_auth', 'Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= __d('dejw_cake_standard_auth', 'E-mail') ?></dt>
                    <dd>
                        <?= h($user->email) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_auth', 'Activated') ?></dt>
                    <dd>
                        <?= $user->activated ? __d('dejw_cake_standard_auth', 'Yes') : __d('dejw_cake_standard_auth', 'No'); ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_auth', 'Created') ?></dt>
                    <dd>
                        <?= h($user->created) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_auth', 'Modified') ?></dt>
                    <dd>
                        <?= h($user->modified) ?>
                    </dd>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __d('dejw_cake_standard_auth', 'Related {0}', ['User Activations']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->user_activations)): ?>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                    <th>
                                    User Id
                                    </th>
                                    <th>
                                    Token
                                    </th>
                                    <th>
                                    Activated
                                    </th>
                                <th>
                                    <?php echo __d('dejw_cake_standard_auth', 'Actions'); ?>
                                </th>
                            </tr>
                            <?php foreach ($user->user_activations as $userActivations): ?>
                                <tr>
                                    <td>
                                    <?= h($userActivations->user_id) ?>
                                    </td>
                                    <td>
                                    <?= h($userActivations->token) ?>
                                    </td>
                                    <td>
                                    <?= h($userActivations->activated) ?>
                                    </td>
                                    <td class="actions">
                                    <?= $this->Html->link(__d('dejw_cake_standard_auth', 'View'), ['controller' => 'UserActivations', 'action' => 'view', $userActivations->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__d('dejw_cake_standard_auth', 'Edit'), ['controller' => 'UserActivations', 'action' => 'edit', $userActivations->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__d('dejw_cake_standard_auth', 'Delete'), ['controller' => 'UserActivations', 'action' => 'delete', $userActivations->id], ['confirm' => __d('dejw_cake_standard_auth', 'Are you sure you want to delete # {0}?', $userActivations->id), 'class'=>'btn btn-danger btn-xs']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __d('dejw_cake_standard_auth', 'Related {0}', ['Roles']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($user->roles)): ?>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                    <th>
                                    Name
                                    </th>
                                    <th>
                                    Title
                                    </th>
                                    <th>
                                    Enabled
                                    </th>
                                <th>
                                    <?php echo __d('dejw_cake_standard_auth', 'Actions'); ?>
                                </th>
                            </tr>
                            <?php foreach ($user->roles as $roles): ?>
                                <tr>
                                    <td>
                                    <?= h($roles->name) ?>
                                    </td>
                                    <td>
                                    <?= h($roles->title) ?>
                                    </td>
                                    <td>
                                    <?= h($roles->enabled) ?>
                                    </td>
                                    <td class="actions">
                                    <?= $this->Html->link(__d('dejw_cake_standard_auth', 'View'), ['controller' => 'Roles', 'action' => 'view', $roles->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__d('dejw_cake_standard_auth', 'Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__d('dejw_cake_standard_auth', 'Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __d('dejw_cake_standard_auth', 'Are you sure you want to delete # {0}?', $roles->id), 'class'=>'btn btn-danger btn-xs']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>