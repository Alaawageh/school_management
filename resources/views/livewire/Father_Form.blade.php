@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
    @endif
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{trans('my_parent.Email')}}</label>
                    <input type="email" wire:model="Email"  class="form-control">
                    @error('Email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('my_parent.Password')}}</label>
                    <input type="password" wire:model="Password"  class="form-control">
                    @error('Password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{trans('my_parent.father_name')}}</label>
                    <input type="text" wire:model="father_name"  class="form-control">
                    @error('father_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('my_parent.father_name_en')}}</label>
                    <input type="text" wire:model="father_name_en"  class="form-control">
                    @error('father_name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('my_parent.father_job')}}</label>
                    <input type="text" wire:model="father_job"  class="form-control">
                    @error('father_job')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('my_parent.father_job_en')}}</label>
                    <input type="text" wire:model="father_job_en"  class="form-control">
                    @error('father_job_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            
            </div>
            <br>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{trans('my_parent.father_national_id')}}</label>
                    <input type="text" wire:model="father_national_id"  class="form-control">
                    @error('father_national_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{trans('my_parent.father_phone')}}</label>
                    <input type="text" wire:model="father_phone"  class="form-control">
                    @error('father_phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">{{trans('my_parent.Nationality_father_id')}}</label>
                    <select class="form-control select2" wire:model="Nationality_father_id">
                        <option selected>{{trans('my_parent.Choose')}}...</option>
                        @foreach($Nationalities as $National)
                            <option value="{{$National->id}}">{{$National->name}}</option>
                        @endforeach
                    </select>
                    @error('Nationality_father_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">{{trans('my_parent.Blood_type_father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Blood_type_father_id">
                        <option selected>{{trans('my_parent.Choose')}}...</option>
                        @foreach($Type_Bloods as $Type_Blood)
                            <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                        @endforeach
                    </select>
                    @error('Blood_type_father_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">{{trans('my_parent.Religion_father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="Religion_father_id">
                        <option selected>{{trans('my_parent.Choose')}}...</option>
                        @foreach($Religions as $Religion)
                            <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                        @endforeach
                    </select>
                    @error('Religion_father_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="col">
                <label for="title">{{trans('my_parent.father_address')}}</label>
                <textarea class="form-control" wire:model="father_address" id="exampleFormControlTextarea1" rows="4"></textarea>
                @error('father_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            @if($update_mode)
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit" type="button">{{trans('my_parent.Next')}}
            </button> 
            @else
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">{{trans('my_parent.Next')}}
            </button>
            @endif
           
        
        </div>
    </div>
</div>