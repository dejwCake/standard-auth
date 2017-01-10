<?php
namespace DejwCake\StandardAuth\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use DejwCake\StandardAuth\Model\Table\RoolesTable;

/**
 * DejwCake\StandardAuth\Model\Table\RoolesTable Test Case
 */
class RoolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \DejwCake\StandardAuth\Model\Table\RoolesTable
     */
    public $Rooles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.dejw_cake/standard_auth.rooles',
        'plugin.dejw_cake/standard_auth.rooles_title_translation',
        'plugin.dejw_cake/standard_auth.rooles_i18n'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Rooles') ? [] : ['className' => 'DejwCake\StandardAuth\Model\Table\RoolesTable'];
        $this->Rooles = TableRegistry::get('Rooles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rooles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
