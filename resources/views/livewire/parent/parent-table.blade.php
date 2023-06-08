@can('add parent')
<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showForm" type="button">{{ trans('trans_parent.add parent') }}</button>
<br><br>
@endcan
<div class="table-responsive">
  <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
    style="text-align: center">
    <thead>
      <tr class="table-success">
        <th>#</th>
        <th>{{ trans('trans_parent.email') }}</th>
        <th>{{ trans('trans_parent.father name') }}</th>
        <th>{{ trans('trans_parent.father national id') }}</th>
        <th>{{ trans('trans_parent.father passport id') }}</th>
        <th>{{ trans('trans_parent.father phone') }}</th>
        <th>{{ trans('trans_parent.father job') }}</th>
        <th>{{ trans('trans_parent.processes') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($parents as $key => $value)
        <tr>
          <td>{{ ++$key }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->father_name }}</td>
          <td>{{ $value->father_national_id }}</td>
          <td>{{ $value->father_passport_id }}</td>
          <td>{{ $value->father_phone }}</td>
          <td>{{ $value->father_job }}</td>
          <td>
            @can('edit parent')
            <button wire:click="edit({{ $value->id }})" title="{{ trans('trans_parent.edit') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-edit"></i>
            </button>
            @endcan

            @can('delete parent')
            <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $value->id }})" title="{{ trans('trans_parent.delete') }}">
                <i class="fa fa-trash"></i>
            </button>
            @endcan
          </td>
        </tr>
      @endforeach
  </table>
</div>
