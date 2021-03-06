<section class="content-header">
    <h1>
        <?= __d('dejw_cake_standard_auth', 'User') ?>
        <small><?= __d('dejw_cake_standard_auth', 'Add') ?></small>
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
                <?= $this->Form->create($user, ['role' => 'form']) ?>
                <div class="box-body">
                    <?php
                        echo $this->Form->input('email', ['label' => __d('dejw_cake_standard_auth', 'E-mail')]);
                        echo $this->Form->input('password', ['label' => __d('dejw_cake_standard_auth', 'Password')]);
                        echo $this->Form->input('activated', ['label' => __d('dejw_cake_standard_auth', 'Activated')]);
                    ?>
                    <?php
                        echo $this->Form->input('roles._ids', ['options' => $roles, 'class' => 'select2', 'data-placeholder' => __d('dejw_cake_standard_auth', 'Select Role'), 'label' => __d('dejw_cake_standard_auth', 'Roles')]);
                    ?>
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
<?php $this->append('cssFirst'); ?>
<?php echo $this->Html->css('DejwCake/AdminLTE./plugins/select2/select2.min.css'); ?>
<?php $this->end(); ?>
<?php $this->append('scriptBottom'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/iCheck/icheck.min.js'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/select2/select2.full.min.js'); ?>
    <script type="text/javascript">
        $(".select2").select2();
        $(function () {
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
<?php $this->end(); ?>
