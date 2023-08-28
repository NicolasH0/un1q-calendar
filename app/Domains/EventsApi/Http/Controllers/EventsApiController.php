<?php

namespace App\Domains\EventsApi\Http\Controllers;

use App\Domains\Events\Http\Controllers\EventsController;
use App\Domains\Events\Models\Event;
use App\Domains\EventsApi\Http\Requests\StoreEventRequest;
use App\Domains\EventsApi\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\Controller;
use App\Domains\Events\Admin\EventResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EventsApiController extends Controller
{
    public function index()
    {
        return new EventResource(Event::with(['event'])->get());
    }

    public function store(StoreEventRequest $request)
    {
        $eventsContoller = new EventsController();

        $eventOverlapping = $eventsContoller->checkIfEventIsOverlapping($request->get('start_time'), $request->get('end_time'));
        if ($eventOverlapping == false) {
            $event = Event::create($request->all());
        } else {
            throw new \Exception('An event is already created for this date');
        }
        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Event $event)
    {
        return new EventResource($event->load(['event']));
    }

    /**
     * @param UpdateEventRequest $request
     * @param Event $event
     * @return JsonResponse|void
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $eventData = new EventResource(Event::where('id', $request->get('id'))->get());
        $eventsContoller = new EventsController();

        $eventOverlapping = $eventsContoller->checkIfEventIsOverlapping($request->get('start_time'), $request->get('end_time'));
        $event = $eventData[0] ?? false;

        if ($event instanceof Event) {
            Log::info('Updating event with id '. $request->get('id'));
        } else {
            throw new \Exception('Event not found');
        }
        if (!$eventOverlapping && !empty($eventData[0])) {
            $event->update($request->all());
            new EventResource(Event::where('id', $request->get('id'))
                ->delete());
        } else {
            throw new \Exception('An event is already created for this date');
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        new EventResource(Event::where('id', $id)->delete());
        return response(null, Response::HTTP_OK);
    }

    public function getEvents(Request $request)
    {
        $dateFrom = $request->get('start_time') ?? '';
        $dateTo = $request->get('start_time') ?? '';

        if ($dateFrom == '' && $dateTo == '') {
            throw new \Exception('Please choose a starting and ending date');
        }

        return new EventResource(Event::with(['event'])->whereBetween('start_time', [$dateFrom, $dateTo])->get());
    }
}
