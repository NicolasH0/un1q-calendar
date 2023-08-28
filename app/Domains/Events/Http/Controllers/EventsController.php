<?php

namespace App\Domains\Events\Http\Controllers;

use App\Domains\Events\Admin\EventResource;
use App\Domains\Events\Models\Event;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    public function checkIfEventIsOverlapping($statingDate, $endDate)
    {
        $existingEvent = (new EventResource(Event::where('start_time', '>=', $statingDate)
            ->where('end_time', '<=', $endDate)
            ->get()))[0] ?? '';
        if (!empty($existingEvent) && $existingEvent instanceof Event) {
            return true;
        } else {
            return false;
        }
    }
}
