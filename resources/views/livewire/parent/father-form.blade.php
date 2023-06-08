@if ($currentStep == 1)
  <div class="row" id="step-1">
    <div class="col-md-12">
      <div class="col-md-12">
        <br>
        <div class="form-row">
          <div class="col">
            <label for="title">{{ trans('trans_parent.email') }}</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="title">{{ trans('trans_parent.password') }}</label>
            <input type="password" wire:model="password" class="form-control">
            @error('password')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <label for="title">{{ trans('trans_parent.father name_ar') }}</label>
            <input type="text" wire:model="father_name_ar" class="form-control">
            @error('father_name_ar')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="title">{{ trans('trans_parent.father name_en') }}</label>
            <input type="text" wire:model="father_name_en" class="form-control">
            @error('father_name_en')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-3">
            <label for="title">{{ trans('trans_parent.father job_en') }}</label>
            <input type="text" wire:model="father_job_en" class="form-control">
            @error('father_job_en')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="title">{{ trans('trans_parent.father job_ar') }}</label>
            <input type="text" wire:model="father_job_ar" class="form-control">
            @error('father_job_ar')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col">
            <label for="title">{{ trans('trans_parent.father national_id') }}</label>
            <input type="text" wire:model="father_national_id" class="form-control">
            @error('father_national_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col">
            <label for="title">{{ trans('trans_parent.father passport_id') }}</label>
            <input type="text" wire:model="father_passport_id" class="form-control">
            @error('father_passport_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col">
            <label for="title">{{ trans('trans_parent.father phone') }}</label>
            <input type="text" wire:model="father_phone" class="form-control">
            @error('father_phone')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>


        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">{{ trans('trans_parent.father nationality_id') }}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="father_nationality_id">
              <option selected>{{ trans('trans_parent.choose') }}...</option>
              @foreach ($nationality as $n)
                <option value="{{ $n->id }}">{{ $n->name }}</option>
              @endforeach
            </select>
            @error('father_nationality_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col">
            <label for="inputState">{{ trans('trans_parent.father bloodType_id') }}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="father_bloodType_id">
              <option selected>{{ trans('trans_parent.choose') }}...</option>
              @foreach ($typeBlood as $tb)
                <option value="{{ $tb->id }}">{{ $tb->name }}</option>
              @endforeach
            </select>
            @error('father_bloodType_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col">
            <label for="inputZip">{{ trans('trans_parent.father religion_id') }}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="father_religion_id">
              <option selected>{{ trans('trans_parent.choose') }}...</option>
              @foreach ($religions as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
              @endforeach
            </select>
            @error('father_religion_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>


        <div class="form-group">
          <label for="exampleFormControlTextarea1">{{ trans('trans_parent.father address') }}</label>
          <textarea class="form-control" wire:model="father_address" id="exampleFormControlTextarea1" rows="4"></textarea>
          @error('father_address')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        @if ($updateMode)
          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit"
            type="button">{{ trans('trans_parent.next') }}
          </button>
        @else
          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">
            {{ trans('trans_parent.next') }}
          </button>
        @endif

      </div>
    </div>
  </div>
@endif
