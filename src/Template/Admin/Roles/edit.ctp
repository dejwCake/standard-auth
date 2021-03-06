<section class="content-header">
    <h1>
        <?= __d('dejw_cake_standard_auth', 'Role') ?>
        <small><?= __d('dejw_cake_standard_auth', 'Edit') ?></small>
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
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __d('dejw_cake_standard_auth', 'Form') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($role, ['role' => 'form']) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name', ['label' => __d('dejw_cake_standard_auth', 'Name')]);
                    echo $this->Form->input('enabled', ['label' => __d('dejw_cake_standard_auth', 'Enabled')]);
                    ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <?php $i = 0; ?>
                            <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                                <li <?php if ($selectedLanguage == $language): ?>class="active"<?php endif; ?>><a
                                            href="#tab_<?= $i ?>" data-toggle="tab"><?= $language ?></a></li>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php $i = 0; ?>
                            <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                                <div class="tab-pane <?php if ($selectedLanguage == $language): ?>active<?php endif; ?>"
                                     id="tab_<?= $i ?>">
                                    <?php
                                        if($languageSettings['locale'] == $defaultLocale){
                                            echo $this->Form->input('title', ['label' => __d('dejw_cake_standard_auth', 'Title')]);
                                        } else {
                                            echo $this->Form->input('_translations.' . $languageSettings['locale'] . '.title', ['label' => __d('dejw_cake_standard_auth', 'Title')]);
                                        }
                                    ?>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__d('dejw_cake_standard_auth', 'Save')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<?php $this->append('css'); ?>
<?php echo $this->Html->css('DejwCake/AdminLTE./plugins/iCheck/all.css'); ?>
<?php $this->end(); ?>
<?php $this->append('scriptBottom'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/iCheck/icheck.min.js'); ?>
<script type="text/javascript">
    $(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>
<?php $this->end(); ?>
