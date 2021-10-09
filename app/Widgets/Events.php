<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Models\Events as EventsModels;

class Events extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = EventsModels::count();
        $string = trans_choice('voyager::dimmer.post', $count);
        $KEYWORD = "events";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-calendar',
            'title'  => "{$count} {$KEYWORD}",
            'text'   => "Click to view {$KEYWORD}",
            'button' => [
                'text' => "View all {$KEYWORD}",
                'link' => route('voyager.events.index'),
            ],
            'image' => 'calendar-bg.jpg',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('Post'));
    }
}
