<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showFormAdd"  type="button">{{ trans('my_parent.add_my_parent') }}</button>
<br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('my_parent.Email') }}</th>
            <th>{{ trans('my_parent.father_name') }}</th>
            <th>{{ trans('my_parent.father_national_id') }}</th>
            <th>{{ trans('my_parent.father_phone') }}</th>
            <th>{{ trans('my_parent.father_job') }}</th>
            <th>{{ trans('my_parent.father_address') }}</th>
            <th>{{ trans('my_parent.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @php
          $i = 0;  
        @endphp
        @foreach ($my_parents  as $my_parent)
        @php
           $i++; 
        @endphp
            <tr>
                <td>{{$i}}</td>
                <td>{{$my_parent->Email}}</td>
                <td>{{$my_parent->father_name}}</td>
                <td>{{$my_parent->father_national_id}}</td>
                <td>{{$my_parent->father_phone}}</td>
                <td>{{$my_parent->father_job}}</td>
                <td>{{$my_parent->father_address}}</td>
                <td>
                    <button class="btn btn-warning btn-sm btn-lg" wire:click="edit({{$my_parent->id}})"  type="button"><i class="fa fa-edit"> </i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-lg " wire:click="delete({{$my_parent->id}})"  type="button"><i class="fa fa-trash"> </i>
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>