<?php

namespace App\Http\Controllers\Stage;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('stage', Stage::class);
        $stage = Stage::all();
        return view("pages.stage.stage", compact("stage"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('add stage', Stage::class);
            $request->validate([
                "name_ar" => "required|unique:stages,name->ar",
                "name_en" => "required|unique:stages,name->en",
            ]);

            // if(Stage::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {
            //     toastr()->error("الاسم مكرر");
            //     return redirect()->route('stage.index');
            // }

            Stage::create([
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'notes' => $request->notes
            ]);

            // toastr()->success(__('trans_notification.saved'));
            // session()->flash('add');

            return redirect()->route('stage.index')->with('success', __('trans_notification.saved'));

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        try {
            $this->authorize('edit stage', Stage::class);
            $request->validate([
                "name_ar" => "required|unique:stages,name->ar," . $stage->id,
                "name_en" => "required|unique:stages,name->en," . $stage->id,
            ]);

            $stage->update([
                $stage->name = ['en' => $request->name_en, 'ar' => $request->name_ar],
                $stage->notes = $request->notes,
            ]);

            // toastr()->success(__('trans_notification.edited'));
            return redirect()->route('stage.index')->with('success', __('trans_notification.edited'));

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        $this->authorize('delete stage', Stage::class);
        $stage->delete();
        // toastr()->success(__('trans_notification.deleted'));
        return redirect()->route('stage.index')->with('warning', __('trans_notification.deleted'));
    }
}
