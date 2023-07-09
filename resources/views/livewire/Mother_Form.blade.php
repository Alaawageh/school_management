
@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
@endif

<div class="col-xs-12">
    <div class="col-md-12">
        <br>
        <div class="form-row">
            <div class="col">
                <label for="title">{{trans('my_parent.mother_name')}}</label>
                <input type="text" wire:model="mother_name"  class="form-control">
                @error('mother_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{trans('my_parent.mother_name_en')}}</label>
                <input type="text" wire:model="mother_name_en"  class="form-control">
                @error('mother_name_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{trans('my_parent.mother_job')}}</label>
                <input type="text" wire:model="mother_job"  class="form-control">
                @error('mother_job')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{trans('my_parent.mother_job_en')}}</label>
                <input type="text" wire:model="mother_job_en"  class="form-control">
                @error('mother_job_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        
    </div>
    <br>
    <div class="form-row">
        <div class="col">
            <label for="title">{{trans('my_parent.mother_national_id')}}</label>
            <input type="text" wire:model="mother_national_id"  class="form-control">
            @error('mother_national_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="title">{{trans('my_parent.mother_phone')}}</label>
            <input type="text" wire:model="mother_phone"  class="form-control">
            @error('mother_phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">{{trans('my_parent.Nationality_mother_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_mother_id">
                <option selected>{{trans('my_parent.Choose')}}...</option>
                @foreach($Nationalities as $National)
                    <option value="{{$National->id}}">{{$National->name}}</option>
                @endforeach
            </select>
            @error('Nationality_mother_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="inputCity">{{trans('my_parent.Blood_type_mother_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="Blood_type_mother_id">
                <option selected>{{trans('my_parent.Choose')}}...</option>
                @foreach($Type_Bloods as $Type_Blood)
                    <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                @endforeach
            </select>
            @error('Blood_type_mother_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="inputCity">{{trans('my_parent.Religion_mother_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="Religion_mother_id">
                <option selected>{{trans('my_parent.Choose')}}...</option>
                @foreach($Religions as $Religion)
                    <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                @endforeach
            </select>
            @error('Religion_mother_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <br>
    <div class="col">
        <label for="title">{{trans('my_parent.mother_address')}}</label>
        <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1" rows="4"></textarea>
        @error('mother_address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
        {{trans('my_parent.Back')}}
    </button>
    @if ($update_mode)
    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondeStepSubmit_edit" type="button">{{trans('my_parent.Next')}}
    </button>
    @else
    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondeStepSubmit" type="button">{{trans('my_parent.Next')}}
    </button>
    @endif
    </div>
</div>
</div>

