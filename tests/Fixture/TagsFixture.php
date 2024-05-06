<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagsFixture
 */
class TagsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'color' => 'Lorem',
                'created' => '2024-05-06 18:18:14',
                'modified' => '2024-05-06 18:18:14',
            ],
        ];
        parent::init();
    }
}
