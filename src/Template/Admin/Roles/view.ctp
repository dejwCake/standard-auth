<section class="content-header">
    <h1>
        <?php echo __d('dejw_cake_standard_auth', 'Role'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __d('dejw_cake_standard_auth', 'Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                        <dt><?= __d('dejw_cake_standard_auth', 'Name') ?></dt>
                        <dd>
                            <?= h($role->name) ?>
                        </dd>
                        <dt><?= __d('dejw_cake_standard_auth', 'Title ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                        <dd>
                            <?= h($role->title) ?>
                        </dd>
                        <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                            <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                            <dt><?= __d('dejw_cake_standard_auth', 'Title ({0})', $languageSettings['title']) ?></dt>
                            <dd>
                                <?= h($role->translation($languageSettings['locale'])->title) ?>
                            </dd>
                        <?php endforeach; ?>
                        <dt><?= __d('dejw_cake_standard_auth', 'Enabled') ?></dt>
                        <dd>
                            <?= $role->enabled ? __d('dejw_cake_standard_auth', 'Yes') : __d('dejw_cake_standard_auth', 'No'); ?>
                        </dd>
                        <dt><?= __d('dejw_cake_standard_auth', 'Created') ?></dt>
                        <dd>
                            <?= h($role->created) ?>
                        </dd>
                        <dt><?= __d('dejw_cake_standard_auth', 'Modified') ?></dt>
                        <dd>
                            <?= h($role->modified) ?>
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
                    <h3 class="box-title"><?= __d('dejw_cake_standard_auth', 'Related {0}', ['Users']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <?php if (!empty($role->users)): ?>
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>
                                    Email
                                </th>
                                <th>
                                    <?php echo __d('dejw_cake_standard_auth', 'Actions'); ?>
                                </th>
                            </tr>
                            <?php foreach ($role->users as $users): ?>
                                <tr>
                                    <td>
                                        <?= h($users->email) ?>
                                    </td>
                                    <td class="actions">
                                        <?= $this->Html->link(__d('dejw_cake_standard_auth', 'View'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class' => 'btn btn-info btn-xs']) ?>
                                        <?= $this->Html->link(__d('dejw_cake_standard_auth', 'Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class' => 'btn btn-warning btn-xs']) ?>
                                        <?= $this->Form->postLink(__d('dejw_cake_standard_auth', 'Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __d('dejw_cake_standard_auth', 'Are you sure you want to delete # {0}?', $users->id), 'class' => 'btn btn-danger btn-xs']) ?>
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
