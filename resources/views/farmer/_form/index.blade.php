<div class="addNewItemHolder" id="wizardProfile">
    <form action="{{$formAction}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field($formMethod) !!}

        <div class="titleHolder">
            <h3 class="mainTitle">{{$formTitle}}</h3>
            <h5 class="subTitle">{{$formTitleSmall}}</h5>
        </div>
        <ul class="stepsNameHolder">
            <li class="active" aria-expanded="true"><a href="#step1" data-toggle="tab">Account</a></li>
            <li><a href="#step2" data-toggle="tab">Personal</a></li>
            <li><a href="#step3" data-toggle="tab">Documents</a></li>
        </ul>
        <div class="stepsContentHolder tab-content">
            <div class="stepsContent tab-pane active" id="step1">
                <div class="heading">Let's start with the basic information (with validation)</div>
                @include('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">face</i>',
                    'iPlaceholder'          => 'Farmer first name',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "farmer[firstname]",
                    'iValue'                => array_get($farmer, 'firstname'),
                    'iId'                   => "farmer-first-name",
                ])

                @include('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">account_circle</i>',
                    'iPlaceholder'          => 'Farmer last name',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "farmer[lastname]",
                    'iValue'                => array_get($farmer, 'lastname'),
                    'iId'                   => "farmer-second-name",
                ])

                @include('component.wizard.input',[
                    'iIcon'                 => '<i class="material-icons">email</i>',
                    'iPlaceholder'          => 'Email',
                    'iType'                 => 'email',
                    'iPlaceholderSmall'     => '(required)',
                    'iName'                 => "farmer[email]",
                    'iValue'                => array_get($farmer, 'email'),
                    'iId'                   => "farmer-email",
                ])

                @include('component.wizard.input',[
                        'iIcon'                 => '<i class="material-icons">location_on</i>',
                        'iPlaceholder'          => 'Farm location',
                        'iPlaceholderSmall'     => '(required)',
                        'iName'                 => "farmer[address]",
                        'iValue'                => array_get($farmer, 'address'),
                        'iId'                   => "farmer-address-autocomplete",
                        'iClass'                => "location-address",
                ])

                <div class="formGroup ">
                    <div class="iconHolder">
                        <i class="material-icons">language</i>
                    </div>
                    <div class="mapHolder">
                        <div class="likeMap" id="location-map-container"></div>
                    </div>

                    <input type="hidden" name="googleMapAPI[placeID]" id="address-placeID"
                           value="{{ array_get($farmer, 'gm_place_id') }}">
                    <input type="hidden" name="googleMapAPI[lon]" id="address-lon"
                           value="{{ array_get($farmer, 'gm_lon') }}">
                    <input type="hidden" name="googleMapAPI[lat]" id="address-lat"
                           value="{{ array_get($farmer, 'gm_lat') }}">


                    @include('component.google-app.google-places.autocomplete',['idAutocomplete'=>'farmer-address-autocomplete', 'idMap' =>'location-map-container', 'idLon'=>'address-lon','idLat'=>'address-lat', 'idPlaceID'=>'address-placeID'])
                    @include('component.google-app.google-places')
                </div>
            </div>


            <div class="stepsContent tab-pane" id="step2">
                <div class="heading">Any information, that you wish to set, but do not found fields for that</div>

                <div class="additionalInfoInputs" data-section="props">
                    @include('component.wizard.prop-sample', ['asSample'=>true, 'mName'=>'farmer_props'])

                    @foreach(array_get($farmer, 'props_batched',[]) as $prop)
                        @include('component.wizard.prop-sample', [ 'prop' => $prop, 'mName'=>'farmer_props' ])
                    @endforeach
                </div>

                <div class="btnInnerHolder">
                    <a href="#" class="btnGrad addRecord">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                </div>
            </div>
            <div class="stepsContent tab-pane" id="step3">
                <div class="heading">Here you can attach files some documents</div>
                <div class="btnInnerHolder">
                    <a href="#" class="btnGrad addFileSection">
                        <i class="fa fa-paperclip"></i>
                        Attach
                    </a>
                </div>
                <div class="fileCardHolder">
                    @include('component.wizard.attach-file-sample')
                    @foreach(array_get($farmer, 'files_batched',[]) as $file)
                        @include('component.wizard.existing-file', ['file' => $file])
                    @endforeach
                </div>
            </div>
        </div>
        <div class="btnHolder">
            <div class="leftPart">
                <a href="#" class="btnGrey btn-previous">Back</a>
            </div>
            <div class="rightPart">
                <a href="#" class="btnGrad btn-next">Next</a>
                <button type="submit" class="btnGrad btn-finish" name="finish">Finish</button>
            </div>
        </div>
    </form>

    {{--@include('component.wizard.script.wizard-attrs-events')--}}
    {{--@include('component.wizard.script.wizard-files-events')--}}

    @include('farmer._form.js_validator')
</div>