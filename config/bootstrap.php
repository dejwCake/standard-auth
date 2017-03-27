<?php
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Core\Plugin;

Configure::write('StandardAuth', [
    'showUserRole' => env('SHOW_USER_ROLE', true),
]);
