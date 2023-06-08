<?php

namespace App\Http\Traits;

use App\Models\FileAttachment;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

trait UploadAttachmentTrait {

    public function uploadFile($request, $path, $store)
    {

        // if($request->hasfile('files'))
        // {
            foreach($request->file('files') as $image)
            {

                // dd();
                // $request->validate([
                //     'image' => "image|mimes:png,jpg,jpeg",
                // ]);

                // insert in image_table
                $fileName = time() . $image->getClientOriginalName();

                $image->storeAs('attachments/'. $path .'/' . $store->email, $fileName, ['disk' => 'public']);

                $store->fileAttachments()->create([
                    "filename" => $fileName,
                ]);
            }
        // }
    }
}
