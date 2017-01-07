<section class="content-header">
    <h1>
        <?php echo __('Role'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                        <dt><?= __('Name') ?></dt>
                        <dd>
                            <?= h($role->name) ?>
                        </dd>
                        <dt><?= __('Title ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                        <dd>
                            <?= h($role->title) ?>
                        </dd>
                        <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                            <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                            <dt><?= __('Title ({0})', $languageSettings['title']) ?></dt>
                            <dd>
                                <?= h($role->translation($languageSettings['locale'])->title) ?>
                            </dd>
                        <?php endforeach; ?>
                        <dt><?= __('Enabled') ?></dt>
                        <dd>
                            <?= $role->enabled ? __('Yes') : __('No'); ?>
                        </dd>
                        <dt><?= __('Created') ?></dt>
                        <dd>
                            <?= h($role->created) ?>
                        </dd>
                        <dt><?= __('Modified') ?></dt>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Users']) ?></h3>
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
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>
                            <?php foreach ($role->users as $users): ?>
                                <tr>
                                    <td>
                                        <?= h($users->email) ?>
                                    </td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class' => 'btn btn-info btn-xs']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class' => 'btn btn-warning btn-xs']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id), 'class' => 'btn btn-danger btn-xs']) ?>
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
