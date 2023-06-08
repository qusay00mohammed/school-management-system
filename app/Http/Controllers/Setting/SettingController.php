<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.setting.index', $setting);
    }



    public function update(Request $request){
        try{

            DB::beginTransaction();
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key => $value){
                $store = Setting::where('key', $key)->update(['value' => $value]);
            }

//            $key = array_keys($info);
//            $value = array_values($info);
//            for($i =0; $i<count($info);$i++){
//                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
//            }


            // upload image
            if($request->hasFile('image'))
            {
                $request->validate([
                    'image' => "image|mimes:png,jpg,jpeg",
                ]);

                $image = $request->file('image');
                $fileName = time() . $image->getClientOriginalName();
                $image->storeAs('attachments/'. 'setting/logo', $fileName, 'public');
                $store = Setting::where('key', 'logo')->update(['value' => $fileName]);
            }


            db::commit();

            // toastr()->success(trans('trans_notification.edited'));
            return back()->with('success', __('trans_notification.edited'));

        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }



}
