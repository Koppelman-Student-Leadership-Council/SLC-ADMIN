<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Events;
use App\Models\Team;
use App\Models\Club;
use TCG\Voyager\Voyager;

use Spatie\GoogleCalendar\Event;

use Illuminate\Http\Request;
use stdClass;
use Response;

class ApiController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'Welcome to the API'
        ], 200);
    }

    public function getAllEvents()
    {
        // logic to get all students goes here
        $events = Events::get();
        
        $this->convertImageLinks($events);
        $response = $events->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    public function getAllClubs()
    {
        // logic to get all students goes here
        $clubs = Club::get();
        
        $this->convertImageLinks($clubs);
        $response = $clubs->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    public function getGoogleEvents()
    {
        $e = Event::get();
        // find e with specific name

        $response = $e->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    public function getGoogleEventsParsed()
    {
        $e = Event::get();
        // find e with specific name
        $eventsArray = [];
        $e->each(function ($collection) use (&$eventsArray) {
            $returnArray = $this->parseEvent($collection);
            array_push($eventsArray, $returnArray);
        });

        return response(json_encode($eventsArray), 200);
    }

    public function getGoogleEventsNotInDatabase()
    {
        $e = Event::get();
        // find e with specific name
        $eventsArray = [];

        $e->each(function ($collection) use (&$eventsArray) {
            if (!$this->existsInDatabase($collection->summary)) {
                $returnArray = $this->parseEvent($collection);
                array_push($eventsArray, $returnArray);
            }
        });

        return response(json_encode($eventsArray), 200);
    }

    public function existsInDatabase($title)
    {
        if (Events::where('title', $title)->count() > 0) {
            // user found
            return true;
        }
        return false;
    }

    public function existsInDatabaseRes($title)
    {
        if (Events::where('title', $title)->count() > 0) {
            // user found
            return response('true', 200);
        }
        return response('false', 200);
    }

    public function parseEvent($collectionGet)
    {
        $returnArray = Collect();
        $returnArray['calendar_id'] = $collectionGet->id;
        $returnArray['created_at'] = $collectionGet->created;
        $returnArray['status'] = $collectionGet->status;
        $returnArray['title'] = $collectionGet->summary;
        $returnArray['description'] = $collectionGet->description;
        $returnArray['event_date_starts'] = $collectionGet->start->dateTime;
        $returnArray['event_date_ends'] = $collectionGet->end->dateTime;
        return $returnArray;
    }

    public function getGoogleIndividualEvent($title)
    {
        $e = Event::get();
        $collectionGet = collect();
        $e->each(function ($collection) use (&$collectionGet, $title) {
            if ($collection->summary == $title) {
                $collectionGet = $collection;
            }
        });

        $returnArray = $this->parseEvent($collectionGet);

        return response(json_encode($returnArray), 200);
    }

    public function getGoogleEventId($title)
    {
        return $this->getGoogleIndividualEventObject($title)['id'];
    }

    public function getGoogleIndividualEventObject($title)
    {
        $e = Event::get();
        $collectionGet = collect();
        $e->each(function ($collection) use (&$collectionGet, $title) {
            if ($collection->summary == $title) {
                $collectionGet = $collection;
            }
        });

        $returnArray = $this->parseEvent($collectionGet);

        return $returnArray;
    }

    function getIndividualEvent($title)
    {
        // Based on the title
        $event = Events::where('title', $title)->first();

        // $this->convertImageLinks($event);
        $response = $event->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    function getIndividualEventObject($title)
    {
        $event = Events::where('title', $title)->first();
        return $event;
    }

    function convertImageLinks($team)
    {
        $Voyager = new Voyager();
        $teamSize = count($team);
        for ($i = 0; $i < $teamSize; $i++) {
            $team[$i]->image_link = $Voyager->image($team[$i]->image);
            $team[$i]->team_size = $teamSize;
        }
    }


    public function getAllTeam()
    {
        // logic to get all students goes here
        $team = Team::get();

        $this->convertImageLinks($team);

        $response = $team->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    public function getAllActiveTeam()
    {
        // logic to get all students goes here
        $team = Team::where('status', 'ACTIVE')->get();

        $this->convertImageLinks($team);

        $response = $team->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    public function getTeamFromDepartment($department)
    {
        // logic to get all students goes here
        $team = Team::where('department', $department)->get();

        $this->convertImageLinks($team);

        $response = $team->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }

    public function getTeamFromDepartmentActive($department)
    {
        // logic to get all students goes here
        $team = Team::where('department', $department)
            ->where('status', 'ACTIVE')
            ->get();

        $this->convertImageLinks($team);

        $response = $team->toJson(JSON_PRETTY_PRINT);
        return response($response, 200);
    }
}
