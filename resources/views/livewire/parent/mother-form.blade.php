@if ($currentStep == 2)
  <div class="row setup-content" id="step-1">

    <div class="col-md-12">
      <div class="col-md-12">
        <br>
        <div class="form-row">
          <div class="col">
            <label for="title">{{ trans('trans_parent.mother name_ar') }}</label>
            <input type="text" wire:model="mother_name_ar" class="form-control">
            @error('mother_name_ar')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="title">{{ trans('trans_parent.mother name_en') }}</label>
            <input type="text" wire:model="mother_name_en" class="form-control">
            @error('mother_name_en')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-3">
            <label for="title">{{ trans('trans_parent.mother job_ar') }}</label>
            <input type="text" wire:model="mother_job_ar" class="form-control">
            @error('mother_job_ar')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label for="title">{{ trans('trans_parent.mother job_en') }}</label>
            <input type="text" wire:model="mother_job_en" class="form-control">
            @error('mother_job_en')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col">
            <label for="title">{{ trans('trans_parent.mother national_id') }}</label>
            <input type="text" wire:model="mother_national_id" class="form-control">
            @error('mother_national_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="title">{{ trans('trans_parent.mother passport_id') }}</label>
            <input type="text" wire:model="mother_passport_id" class="form-control">
            @error('mother_passport_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col">
            <label for="title">{{ trans('trans_parent.mother phone') }}</label>
            <input type="text" wire:model="mother_phone" class="form-control">
            @error('mother_phone')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>


        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">{{ trans('trans_parent.mother nationality_id') }}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="mother_nationality_id">
              <option selected>{{ trans('trans_parent.choose') }}...</option>
              @foreach ($nationality as $n)
                <option value="{{ $n->id }}">{{ $n->name }}</option>
              @endforeach
            </select>
            @error('mother_nationality_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col">
            <label for="inputState">{{ trans('trans_parent.mother bloodType_id') }}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="mother_bloodType_id">
              <option selected>{{ trans('trans_parent.choose') }}...</option>
              @foreach ($typeBlood as $tb)
                <option value="{{ $tb->id }}">{{ $tb->name }}</option>
              @endforeach
            </select>
            @error('mother_bloodType_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col">
            <label for="inputZip">{{ trans('trans_parent.mother religion_id') }}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="mother_religion_id">
              <option selected>{{ trans('trans_parent.choose') }}...</option>
              @foreach ($religions as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
              @endforeach
            </select>
            @error('mother_religion_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>


        <div class="form-group">
          <label for="exampleFormControlTextarea1">{{ trans('trans_parent.mother address') }}</label>
          <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1" rows="4"></textarea>
          @error('mother_address')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back">
          {{ trans('trans_parent.back') }}
        </button>

        @if ($updateMode)
          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
            type="button">{{ trans('trans_parent.next') }}
          </button>
        @else
          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit" type="button">
            {{ trans('trans_parent.next') }}
          </button>
        @endif

      </div>
    </div>
  </div>
@endif
