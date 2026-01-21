<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AtendeeResource; 
use App\Models\Atendee;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class AtendeeController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show']),
        ];
    }
    public function index(Event $event)
    {
        $attendes = $event->atendees()->latest();

        return AtendeeResource::collection($attendes->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $atendee = $event->atendees()->create(
            ['user_id' => $request->user('sanctum')->id]
        );
        return  new AtendeeResource($atendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Atendee $atendee)
    {
        return new AtendeeResource($atendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Atendee $attendee)
    {
        $attendee->delete();
        return response(status:204);
    }
}
