<?php

namespace Tests\Unit;

use App\Domains\Events\Http\Controllers\EventsController;
use Tests\TestCase;


class EventControllerTest extends TestCase
{
    private $eventsController;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->eventsController = new EventsController();
    }

    public function testStartDateIsCorrect()
    {
        $statingDate = (bool)strtotime('2023-08-26 13:18:53');
        $this->assertTrue($statingDate);
    }
    public function testEndDateIsCorrect()
    {
        $endDate = (bool)strtotime('2023-08-26 13:18:53');
        $this->assertTrue($endDate);
    }

    public function testStartDateIsNotCorrect()
    {
        $statingDate = (bool)strtotime('this is not a date');
        $this->assertFalse($statingDate);
    }
    public function testEndDateIsNotCorrect()
    {
        $endDate = (bool)strtotime('this is not a date');
        $this->assertFalse($endDate);
    }
}
