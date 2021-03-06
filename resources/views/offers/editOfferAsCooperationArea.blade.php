@extends('offers.editOffer')

@php
    $organizations = App\Organization::all();
    $convocatories = App\Convocatory::where('state', '<=', '2');
@endphp

<script>

    function changeRadio(){
        convocatoryIdDiv = document.getElementById('convocatoryId_div');
        housingDiv = document.getElementById('housing_div');
        costsDiv = document.getElementById('costs_div');
        convocatoryId = document.getElementById('convocatoryId');
        housing = document.getElementById('housing');
        costs = document.getElementById('costs');
        
        radioYes = document.getElementById('radioYes');
        radioNo = document.getElementById('radioNo');
        
        if(radioYes.checked){
            convocatoryIdDiv.style.display = 'block';
            housingDiv.style.display = 'block';
            costsDiv.style.display = 'block';
            convocatoryId.required = 'required';
            housing.required = 'required';
            costs.required = 'required';
            
            radioYes.checked = true;
            radioNo.checked = false;
        } else{
            convocatoryIdDiv.style.display = 'none';
            housingDiv.style.display = 'none';
            costsDiv.style.display = 'none';
            convocatoryId.required = '';
            housing.required = '';
            costs.required = '';
            
            radioYes.checked = false;
            radioNo.checked = true;
        }
    }
    
    
</script>
@section('convocatory_option') 

<div class="form-group{{ $errors->has('organizationId') ? ' has-error' : '' }}">
    <label for="organizationId" class="col-md-4 control-label">@lang('models.organization')</label>

    <div class="col-md-6">
        <select  id="organizationId" class="form-control" name="organizationId" autofocus required>
            <option id="organizationIdOption0" value="{{old('organizationId') ? old('organizationId') : $offer->organization_id}}">
                {{old('organizationId') ? App\Organization::find(old('organizationId'))->user->name : $offer->organization->user->name}}
            </option>
            @php
                $organizations = App\Organization::where('removed', false);
            @endphp
            @foreach($organizations as $organization)
                <option id="organizationIdOption{{$organization->id}}" value="{{$organization->id}}">{{$organization->user->name}}</option>
            @endforeach
        </select>

        @if ($errors->has('organizationId'))
        <span class="help-block">
            <strong>{{ $errors->first('organizationId') }}</strong>
        </span>
        @endif
    </div>
</div>


<div id="isOfferOfConvocatory_div" class="form-group{{ $errors->has('isOfferOfConvocatory') ? ' has-error' : '' }}">
    <label for="isOfferOfConvocatory" class="col-md-4 control-label">@lang('models.isOfferOfConvocatory')</label>

    <div class="col-md-6">
        
        @if(old('isOfferOfConvocatory')) <!-- This is not the first call to edit data -->
        <label class="radio-inline">
            <input id="radioYes" onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="1" {{ old('isOfferOfConvocatory') ? 'checked' : ''}}>
            @lang('general.yes')</label>
        <label class="radio-inline">
            <input id='radioNo' onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="0" {{ old('isOfferOfConvocatory') ? '' : 'checked'}}>
            @lang('general.no')</label>
        @else <!-- This is the first call to edit data -->
        <label class="radio-inline">
            <input id="radioYes" onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="1" {{ $offer->isOfferOfConvocatory ? 'checked' : ''}}>
            @lang('general.yes')</label>
        <label class="radio-inline">
            <input id='radioNo' onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="0" {{ $offer->isOfferOfConvocatory ? '' : 'checked'}}>
            @lang('general.no')</label>
        @endif
        
        @if ($errors->has('isOfferOfConvocatory'))
        <span class="help-block">
            <strong>{{ $errors->first('isOfferOfConvocatory') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="convocatoryId_div" class="form-group{{ $errors->has('convocatoryId') ? ' has-error' : '' }}">
    <label for="convocatoryId" class="col-md-4 control-label">@lang('models.convocatory')</label>

    <div class="col-md-6">
        <select  id="convocatoryId" class="form-control" name="convocatoryId" autofocus>
            @if($offer->isOfferOfConvocatory)
                <option id="convocatoryIdOption0" value="{{old('convocatoryId') ? old('convocatoryId') : $offer->offerOfConvocatory->convocatory_id}}">
                    {{old('convocatoryId') ? App\Convocatory::find(old('convocatoryId'))->title : $offer->offerOfConvocatory->convocatory->title}}
                </option>
            @else
                <option id="convocatoryIdOption0" value="{{old('convocatoryId') ? old('convocatoryId') : ''}}">
                    {{old('convocatoryId') ? App\Convocatory::find(old('convocatoryId'))->title : ''}}
                </option>
            @endif
            
            @php
                $convocatories = App\Convocatory::where('state', '<=', '2')->get();
            @endphp
            @foreach($convocatories as $convocatory)
                <option id="convocatoryIdOption{{$convocatory->id}}" value="{{$convocatory->id}}">{{$convocatory->title}}</option>
            @endforeach
        </select>

        @if ($errors->has('convocatoryId'))
        <span class="help-block">
            <strong>{{ $errors->first('convocatoryId') }}</strong>
        </span>
        @endif
    </div>
</div>
@endsection

@section('more_offer_fields')
<div id="housing_div" class="form-group{{ $errors->has('housing') ? ' has-error' : '' }}">
    <label for="housing" class="col-md-4 control-label">@lang('models.housing')</label>

    <div class="col-md-6">
        @if($offer->isOfferOfConvocatory)
        <textarea id="housing" cols="200" rows="2" maxlength="{{config('forms.housing')}}"
            class="form-control" name="housing" autofocus>{{ old('housing') ?  old('housing') : $offer->offerOfConvocatory->housing }}</textarea>
        @else
        <textarea id="housing" cols="200" rows="2" maxlength="{{config('forms.housing')}}"
            class="form-control" name="housing" autofocus>{{ old('housing') ?  old('housing') : '' }}</textarea>
        @endif
        <span class="pull-right label label-default"></span>
        
        @if ($errors->has('housing'))
        <span class="help-block">
            <strong>{{ $errors->first('housing') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="costs_div" class="form-group{{ $errors->has('costs') ? ' has-error' : '' }}">
    <label for="costs" class="col-md-4 control-label">@lang('models.costs')</label>

    <div class="col-md-6">
        @if($offer->isOfferOfConvocatory)
        <textarea id="costs" cols="200" rows="2" maxlength="{{config('forms.costs')}}"
            class="form-control" name="costs" autofocus>{{ old('costs') ?  old('costs') : $offer->offerOfConvocatory->costs }}</textarea>
        @else
        <textarea id="costs" cols="200" rows="2" maxlength="{{config('forms.costs')}}"
            class="form-control" name="costs" autofocus>{{ old('costs') ?  old('costs') : '' }}</textarea>
        @endif
        <span class="pull-right label label-default"></span>
        
        @if ($errors->has('costs'))
        <span class="help-block">
            <strong>{{ $errors->first('costs') }}</strong>
        </span>
        @endif
    </div>
</div>

<script>
    changeRadio();
</script>
@endsection

