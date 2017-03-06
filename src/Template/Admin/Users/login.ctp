<div class="users form">
<?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->input('email', ['label' => __d('dejw_cake_standard_auth', 'E-mail')]) ?>
        <?= $this->Form->input('password', ['label' => __d('dejw_cake_standard_auth', 'Password')]) ?>
    </fieldset>
    <?= $this->Form->button(__d('dejw_cake_standard_auth', 'Login')); ?>
    <?= $this->Form->end() ?>
</div>
