<?php

namespace App\Http\Livewire\Parent;

// use App\Http\Traits\UploadAttachmentTrait;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\TheParent;
use App\Models\Religion;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MyParent extends Component
{
    use WithFileUploads;
    // use UploadAttachmentTrait;

    public $updateMode = false, $show_table = true;
    public $currentStep = 1;
    public $photos = [];
    public $catchError = "", $input, $parent_id,
    // Father var
    $email, $password, $father_name_ar, $father_name_en, $father_job_ar, $father_job_en, $father_national_id, $father_passport_id,
    $father_phone, $father_nationality_id, $father_bloodType_id, $father_religion_id, $father_address,
    // Mother var
    $mother_name_ar, $mother_name_en, $mother_job_ar, $mother_job_en, $mother_national_id, $mother_passport_id,
    $mother_phone, $mother_nationality_id, $mother_bloodType_id, $mother_religion_id, $mother_address;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'father_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'father_passport_id' => 'min:10|max:10',
            'father_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'mother_passport_id' => 'min:10|max:10',
            'mother_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }



    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:parents|email',
            'password' => 'required',
            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|unique:parents',
            'father_passport_id' => 'required|unique:parents',
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_bloodType_id' => 'required',
            'father_religion_id' => 'required',
            'father_address' => 'required',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_national_id' => 'required|unique:parents',
            'mother_passport_id' => 'required|unique:parents',
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_nationality_id' => 'required',
            'mother_bloodType_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function back()
    {
        --$this->currentStep;
    }

    public function showForm()
    {
        $this->show_table = false;
    }


    public function render()
    {
        return view('livewire.parent.my-parent',
        [
            "nationality" => Nationality::all(),
            "typeBlood" => BloodType::all(),
            "religions" => Religion::all(),
            "parents" => TheParent::all(),
        ]);
    }

    public function submitForm(){

        try {
            DB::beginTransaction();
            $store = TheParent::create([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'father_name' => ['en' => $this->father_name_en, 'ar' => $this->father_name_ar],
                'father_national_id' => $this->father_national_id,
                'father_passport_id' => $this->father_passport_id,
                'father_phone' => $this->father_phone,
                'father_job' => ['en' => $this->father_job_en, 'ar' => $this->father_job_ar],
                'father_nationality_id' => $this->father_nationality_id,
                'father_bloodType_id' => $this->father_bloodType_id,
                'father_religion_id' => $this->father_religion_id,
                'father_address' => $this->father_address,

                'mother_name' => ['en' => $this->mother_name_en, 'ar' => $this->mother_name_ar],
                'mother_national_id' => $this->mother_national_id,
                'mother_passport_id' => $this->mother_passport_id,
                'mother_phone' => $this->mother_phone,
                'mother_job' => ['en' => $this->mother_job_en, 'ar' => $this->mother_job_ar],
                'mother_nationality_id' => $this->mother_nationality_id,
                'mother_bloodType_id' => $this->mother_bloodType_id,
                'mother_religion_id' => $this->mother_religion_id,
                'mother_address' => $this->mother_address,
            ]);

            if (!empty($this->photos)){

                // $this->validate([
                //     'photos.*' => 'image|max:1024', // 1MB Max
                // ]);

                foreach ($this->photos as $photo) {
                    // insert in image_table
                    $fileName = time() . $photo->getClientOriginalName();
                    $photo->storeAs('attachments/'. 'parents' .'/' . $parents->email, $fileName, "public");
                    $parents->fileAttachments()->create([
                        "filename" => $fileName,
                    ]);
                }
            }

            DB::commit();

            $oldfiles = Storage::files('livewire-tmp');
            foreach ($oldfiles as $file) {
                Storage::delete($file);
            }

            toastr()->success(__('trans_notification.saved'));

            $this->clearForm();
            $this->currentStep = 1;
        } catch (Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name_ar = '';
        $this->father_name_en = '';
        $this->father_job_ar = '';
        $this->father_job_en = '';
        $this->father_national_id ='';
        $this->father_passport_id = '';
        $this->father_phone = '';
        $this->father_nationality_id = '';
        $this->father_bloodType_id = '';
        $this->father_address ='';
        $this->father_religion_id ='';

        $this->mother_name_ar = '';
        $this->mother_name_en = '';
        $this->mother_job_ar = '';
        $this->mother_job_en = '';
        $this->mother_national_id ='';
        $this->mother_passport_id = '';
        $this->mother_phone = '';
        $this->mother_nationality_id = '';
        $this->mother_bloodType_id = '';
        $this->mother_religion_id ='';
        $this->mother_address ='';
    }

    // delete Parents
    public function delete($id){
        TheParent::findOrFail($id)->delete();
        return redirect()->route('livewire.parent')->with('warning', __('trans_notification.deleted'));
    }


    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $parents = TheParent::findOrFail($id);
        $this->parent_id = $id;
        $this->email = $parents->email;
        // $this->password = $parents->password;
        $this->father_name_ar = $parents->getTranslation('father_name', 'ar');
        $this->father_name_en = $parents->getTranslation('father_name', 'en');;
        $this->father_job_ar = $parents->getTranslation('father_job', 'ar');;
        $this->father_job_en = $parents->getTranslation('father_job', 'en');;
        $this->father_national_id =$parents->father_national_id;
        $this->father_passport_id = $parents->father_passport_id;
        $this->father_phone = $parents->father_phone;
        $this->father_nationality_id = $parents->father_nationality_id;
        $this->father_bloodType_id = $parents->father_bloodType_id;
        $this->father_address =$parents->father_address;
        $this->father_religion_id =$parents->father_religion_id;

        $this->mother_name_ar = $parents->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $parents->getTranslation('mother_name', 'en');
        $this->mother_job_ar = $parents->getTranslation('mother_job', 'ar');
        $this->mother_job_en = $parents->getTranslation('mother_job', 'en');
        $this->mother_national_id =$parents->mother_national_id;
        $this->mother_passport_id = $parents->mother_passport_id;
        $this->mother_phone = $parents->mother_phone;
        $this->mother_nationality_id = $parents->mother_nationality_id;
        $this->mother_bloodType_id = $parents->mother_bloodType_id;
        $this->mother_religion_id =$parents->mother_religion_id;
        $this->mother_address =$parents->mother_address;
    }

    public function firstStepSubmit_edit()
    {
        $this->validate([
            'email' => 'required|email|unique:parents,email,' . $this->parent_id,
            'password' => 'required',
            'father_name_ar' => 'required',
            'father_name_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|unique:parents,father_national_id,' . $this->parent_id,
            'father_passport_id' => 'required|unique:parents,father_passport_id,' . $this->parent_id,
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_bloodType_id' => 'required',
            'father_religion_id' => 'required',
            'father_address' => 'required',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {
        $this->validate([
            'mother_name_ar' => 'required',
            'mother_name_en' => 'required',
            'mother_national_id' => 'required|unique:parents,mother_national_id,' . $this->parent_id,
            'mother_passport_id' => 'required|unique:parents,mother_passport_id,' . $this->parent_id,
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'mother_nationality_id' => 'required',
            'mother_bloodType_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm_edit(){

        try {

            DB::beginTransaction();

            $parents = TheParent::findOrFail($this->parent_id);
            $parents->update([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'father_name' => ['en' => $this->father_name_en, 'ar' => $this->father_name_ar],
                'father_national_id' => $this->father_national_id,
                'father_passport_id' => $this->father_passport_id,
                'father_phone' => $this->father_phone,
                'father_job' => ['en' => $this->father_job_en, 'ar' => $this->father_job_ar],
                'father_nationality_id' => $this->father_nationality_id,
                'father_bloodType_id' => $this->father_bloodType_id,
                'father_religion_id' => $this->father_religion_id,
                'father_address' => $this->father_address,

                'mother_name' => ['en' => $this->mother_name_en, 'ar' => $this->mother_name_ar],
                'mother_national_id' => $this->mother_national_id,
                'mother_passport_id' => $this->mother_passport_id,
                'mother_phone' => $this->mother_phone,
                'mother_job' => ['en' => $this->mother_job_en, 'ar' => $this->mother_job_ar],
                'mother_nationality_id' => $this->mother_nationality_id,
                'mother_bloodType_id' => $this->mother_bloodType_id,
                'mother_religion_id' => $this->mother_religion_id,
                'mother_address' => $this->mother_address,
            ]);

            if (!empty($this->photos)){

                // $this->validate([
                //     'photos.*' => 'image|max:1024', // 1MB Max
                // ]);

                foreach ($this->photos as $photo) {
                    // insert in image_table
                    $fileName = time() . $photo->getClientOriginalName();
                    $photo->storeAs('attachments/'. 'parents' .'/' . $parents->email, $fileName, "public");
                    $parents->fileAttachments()->create([
                        "filename" => $fileName,
                    ]);
                }
            }

            DB::commit();

            $oldfiles = Storage::files('livewire-tmp');
            foreach ($oldfiles as $file) {
                Storage::delete($file);
            }

            toastr()->success(__('trans_notification.edited'));
            $this->clearForm();
            $this->currentStep = 1;
        } catch (Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }







}
