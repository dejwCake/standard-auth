<div class="roles form large-9 medium-8 columns content">
    <?= $this->Form->create($role) ?>
    <fieldset>
        <legend><?= __('Add Role') ?></legend>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php $i = 0; ?>
                <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                    <li <?php if($selectedLanguage == $language): ?>class="active"<?php endif; ?>><a href="#tab_<?= $i ?>" data-toggle="tab" ><?= $language ?></a></li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php $i = 0; ?>
                <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                    <div class="tab-pane <?php if($selectedLanguage == $language): ?>active<?php endif; ?>" id="tab_<?= $i ?>">
                        <?php echo $this->Form->input('_translations.'.$languageSettings['locale'].'.title'); ?>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('enabled');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
