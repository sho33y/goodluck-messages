<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GoodlucksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GoodlucksTable Test Case
 */
class GoodlucksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GoodlucksTable
     */
    public $Goodlucks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.goodlucks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Goodlucks') ? [] : ['className' => GoodlucksTable::class];
        $this->Goodlucks = TableRegistry::get('Goodlucks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Goodlucks);

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
