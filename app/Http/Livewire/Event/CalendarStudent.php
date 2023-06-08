<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class CalendarStudent extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function render()
    {
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.event.calendar-student');
    }


}
