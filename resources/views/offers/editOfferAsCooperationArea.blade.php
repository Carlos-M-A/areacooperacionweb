@extends('offers.editOffer')

@php
    $organizations = App\Organization::all();
    $convocatories = App\Convocatory::where('state', '<=', '2');
@endphp

<script>

    function changeRadio(){
        convocatoryIdDiv = document.getElementById('convocatoryId_div').style;
        housingDiv = document.getElementById('housing_div').style;
        costsDiv = document.getElementById('costs_div').style;
        
        radioYes = document.getElementById('radioYes');
        radioNo = document.getElementById('radioNo');
        
        if(radioYes.checked){
            convocatoryIdDiv.display = 'block';
            housingDiv.display = 'block';
            costsDiv.display = 'block';
            radioYes.checked = true;
            radioNo.checked = false;
        } else{
            convocatoryIdDiv.display = 'none';
            housingDiv.display = 'none';
            costsDiv.display = 'none';
            radioYes.checked = false;
            radioNo.checked = true;
        }
    }
    
    
</script>

@section('more_offer_fields')
<div class="form-group{{ $errors->has('organizationId') ? ' has-error' : '' }}">
    <label for="organizationId" class="col-md-4 control-label">Type</label>

    <div class="col-md-6">
        <select  id="organizationId" class="form-control" name="organizationId" autofocus>
            <option id="organizationIdOption0" value="{{old('organizationId') ? old('organizationId') : $offer->organization_id}}">
                {{old('organizationId') ? App\Organization::find(old('organizationId'))->user->name : $offer->organization->user->name}}
            </option>
            @php
                $organizations = App\Organization::all();
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
    <label for="isOfferOfConvocatory" class="col-md-4 control-label">isOfferOfConvocatory</label>

    <div class="col-md-6">
        
        @if(old('isOfferOfConvocatory')) <!-- This is not the first call to edit data -->
        <label class="radio-inline">
            <input id="radioYes" onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="1" {{ old('isOfferOfConvocatory') ? 'checked' : ''}}>
            Yes</label>
        <label class="radio-inline">
            <input id='radioNo' onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="0" {{ old('isOfferOfConvocatory') ? '' : 'checked'}}>
            No</label>
        @else <!-- This is the first call to edit data -->
        <label class="radio-inline">
            <input id="radioYes" onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="1" {{ $offer->isOfferOfConvocatory ? 'checked' : ''}}>
            Yes</label>
        <label class="radio-inline">
            <input id='radioNo' onclick="changeRadio()" type="radio" name="isOfferOfConvocatory" value="0" {{ $offer->isOfferOfConvocatory ? '' : 'checked'}}>
            No</label>
        @endif
        
        @if ($errors->has('isOfferOfConvocatory'))
        <span class="help-block">
            <strong>{{ $errors->first('isOfferOfConvocatory') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="convocatoryId_div" class="form-group{{ $errors->has('convocatoryId') ? ' has-error' : '' }}">
    <label for="convocatoryId" class="col-md-4 control-label">Type</label>

    <div class="col-md-6">
        <select  id="convocatoryId" class="form-control" name="convocatoryId" autofocus>
            @if($offer->isOfferOfConvocatory)
                <option id="convocatoryIdOption0" value="{{old('convocatoryId') ? old('convocatoryId') : $offer->offerOfConvocatory->convocatory_id}}">
                    {{old('convocatoryId') ? App\Convocatory::find(old('convocatoryId'))->title : $offer->offerOfConvocatory->convocatory->title}}
                </option>
            @else
                <option id="convocatoryIdOption0" value="{{old('convocatoryId') ? old('convocatoryId') : '0'}}">
                    {{old('convocatoryId') ? App\Convocatory::find(old('convocatoryId'))->title : '-- Convocatory --'}}
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

<div id="housing_div" class="form-group{{ $errors->has('housing') ? ' has-error' : '' }}">
    <label for="housing" class="col-md-4 control-label">housing</label>

    <div class="col-md-6">
        @if($offer->isOfferOfConvocatory)
            <input id="housing" type="text" class="form-control" name="housing" value="{{ old('housing') ?  old('housing') : $offer->offerOfConvocatory->housing }}" autofocus>
        @else
            <input id="housing" type="text" class="form-control" name="housing" value="{{ old('housing') ?  old('housing') : '' }}" autofocus>
        @endif
        
        @if ($errors->has('housing'))
        <span class="help-block">
            <strong>{{ $errors->first('housing') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="costs_div" class="form-group{{ $errors->has('costs') ? ' has-error' : '' }}">
    <label for="costs" class="col-md-4 control-label">costs</label>

    <div class="col-md-6">
        @if($offer->isOfferOfConvocatory)
            <input id="costs" type="text" class="form-control" name="costs" value="{{ old('costs') ?  old('costs') : $offer->offerOfConvocatory->costs }}" autofocus>
        @else
            <input id="costs" type="text" class="form-control" name="costs" value="{{ old('costs') ?  old('costs') : '' }}" autofocus>
        @endif
        
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

