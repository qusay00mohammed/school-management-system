<?php

namespace App\Http\Controllers\OnlineClass;

use App\Http\Controllers\Controller;
use App\Http\Traits\CreateMeetTrait;
use Illuminate\Http\Request;
use App\Models\OnlineClass;
use App\Models\Stage;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    use CreateMeetTrait;

    public function index()
    {
        $online_classes = OnlineClass::all();
        return view('pages.online_classes.index', compact('online_classes'));
    }

    public function direct()
    {
        $stage = Stage::all();
        return view('pages.online_classes.add', compact('stage'));
    }

    public function storeDirect(Request $request)
    {
        try {
            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'integration' => true,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);

            return redirect()->route('online_classes.index')->with('success', __('trans_notification.saved'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }



    public function indirect()
    {
        $stage = Stage::all();
        return view('pages.online_classes.indirect', compact('stage'));
    }


    public function storeIndirect(Request $request)
    {
        try {
            OnlineClass::create([
                'integration' => false,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            return redirect()->route('online_classes.index')->with('success', __('trans_notification.edited'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function destroy(Request $request, $id)
    {
        try {
            $info = OnlineClass::findOrFail($id);

            if($info->integration == true){
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                OnlineClass::destroy($id);
            }
            else
            {
               OnlineClass::destroy($id);
            }

            return redirect()->route('online_classes.index')->with('warning', __('trans_notification.deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
