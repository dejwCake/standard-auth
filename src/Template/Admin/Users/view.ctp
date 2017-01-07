<section class="content-header">
  <h1>
    <?php echo __('User'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
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
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= __('Email') ?></dt>
                    <dd>
                        <?= h($user->email) ?>
                    </dd>
                    <dt><?= __('Activated') ?></dt>
                    <dd>
                        <?= $user->activated ? __('Yes') : __('No'); ?>
                    </dd>
                    <dt><?= __('Created') ?></dt>
                    <dd>
                        <?= h($user->created) ?>
                    </dd>
                    <dt><?= __('Modified') ?></dt>
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
                    <h3 class="box-title"><?= __('Related {0}', ['User Activations']) ?></h3>
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
                                    <?php echo __('Actions'); ?>
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
                                    <?= $this->Html->link(__('View'), ['controller' => 'UserActivations', 'action' => 'view', $userActivations->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserActivations', 'action' => 'edit', $userActivations->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserActivations', 'action' => 'delete', $userActivations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userActivations->id), 'class'=>'btn btn-danger btn-xs']) ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Roles']) ?></h3>
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
                                    <?php echo __('Actions'); ?>
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
                                    <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id), 'class'=>'btn btn-danger btn-xs']) ?>
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