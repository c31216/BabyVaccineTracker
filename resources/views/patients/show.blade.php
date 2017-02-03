@extends('main')

@section('stylesheets')

  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('dist/datepicker.css') !!}

@endsection

@section('title', 'Patient Record')

@section('content')

	
    <div class="table-responsive">
      <table class="table table-bordered">
        <h3>Basic info</h3>
        <thead>
          <tr>
            <th>Date of registration</th>
            <th>Date of birth</th>
            <th>Last name</th>
            <th>First name</th> 
            <th>Weight (kg)</th>
            <th>Height (cm)</th>
            <th>Head Circumference (cm)</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Name of mother</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
            <tr class="active">
              <td>{{$patients->patient_registration_date}}</td>
              <td>{{$patients->patient_bdate}}</td>
              <td>{{$patients->patient_lname}}</td>
              <td>{{$patients->patient_fname}}</td>
              <td>{{$patients->patient_weight}}</td>
              <td>{{$patients->patient_height}}</td>
              <td>{{$patients->patient_headcircumference}}</td>
              <td>{{Carbon::createFromFormat('Y-m-d', $patients->patient_bdate)->diff(Carbon::now())->format('%y year(s), %m month(s) and %d day(s)')}}</td>
              <td>{{$patients->patient_sex}}</td>
              <td>{{$patients->patient_mother_name}}</td>
              <td>{{$patients->patient_address}}</td>
            </tr>
        </tbody>
      </table>
    </div><!-- Div.table-responsive-->

    <div class="table-responsive">
      <table class="table table-bordered">
      <h3>TCL For Nutrition and EPI Program P1</h3>
        <tr>
          <th colspan="2" rowspan="2">Date New Born Screening</th>
          <th colspan="2" rowspan="2">Child Protected at Birth</th>
          <th colspan="12">Date Immunization Received</th>
        </tr>
        <tr>
          <td rowspan="2">BCG</td>
          <td colspan="2">Hepa B1</td>
          <td colspan="4">Pentavalent</td>
          <td colspan="3">OPV</td>
          <td colspan="2">MVC</td>
        </tr>
        <tr>
          <td>Referral</td>
          <td>Done</td>
          <td>TT Status Date</td>
          <td>Date Asses</td>
          <td>w/in <br>24 hours</td>
          <td>More than<br>24 hours</td>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>MVC1</td>
          <td>MVC2</td>
        </tr>
      <tbody>
        <tr class="active">
          <td>12-13-16</td>
          <td>12-13-16</td>
          <td>12-13-16</td>
          <td>12-13-16</td>
          <?php $count = 1;?>
          @for($i = 0; $i < 12; $i++)
            <?php $count;?>
            @if(isset($immunizationstatuses[$i]))<!--first if-->
              
              @for($x= $i+1; $x <= 12; $x++)<!--second for-->

                @if($immunizationstatuses[$i]['vaccine_id'] == $x)<!--second if-->
                <?php $count = 1; ?>
                <td class="date {{$immunizationstatuses[$i]['vaccine_id']}}" id="{{$patients->PatientID}}">{{$immunizationstatuses[$i]['vaccination_received']}}<br>

                  @if($immunizationstatuses[$i]['hospital_type'] == 'Private')<!--third if-->

                    {{$immunizationstatuses[$i]['hospital_type']}}

                  @endif<!--third endif-->
                
                 
                </td>
                @else<!--second else-->
                <td class="store {{$i+1}}" id="{{$patients->PatientID}}">Empty</td>
                
                @continue
                @endif<!--second endif-->
              
                @break
              @endfor<!--second endfor-->
            @else<!--first else-->
              
              @if($count == 1)

              <td class="store {{$i+1}}" id="{{$patients->PatientID}}">Empty</td>
              <?php $count = 0;?>
                @else
                <td>Empty</td>
              @endif

            @endif<!--first endif-->
            
          @endfor
      </tbody>
      </table>
    </div><!-- Div.table-responsive-->

    <div class="table-responsive">
      <table class="table table-bordered">
      <h3>TCL For Nutrition and EPI Program P2</h3>
        <tr>
          <th rowspan="2">P1 Date of<br>Completion</th>
          <th colspan="2">Rota Virus<br>Vaccine</th>
          <th colspan="4">Pneumococcal<br>Conjugate Vaccines (PCV)</th>
          <th colspan="6">Child Was Exclusively Breastfed</th>
          <th colspan="3">Complementary Feeding</th>
          <th rowspan="2">Remarks</th>
        </tr>
        <tr>
          <td>1</td>
          <td>2</td>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>1st<br>MO</td>
          <td>2nd<br>MO</td>
          <td>3rd<br>MO</td>
          <td>4th<br>MO</td>
          <td>5th<br>MO</td>
          <td>Date<br>6th MO</td>
          <td>6th<br>MO</td>
          <td>7th<br>MO</td>
          <td>8th<br>MO</td>
        </tr>
        <tbody>
          <tr class="active">
            <td>
            @if($tookvaccines->isEmpty())
            {{$patients->patient_registration_date}}
            @else
            Empty
            @endif
            </td>
            <td>12-13-16</td>
            <td>12-13-16</td>
            <td>12-13-16</td>
            <td>12-13-16</td>
            <td>12-13-16</td>
            <td>12-13-16</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>12-13-16</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>Leave empty(not sure)</td>
          </tr>
        </tbody>
      </table>
    </div><!-- Div.table-responsive-->

    <div class="table-responsive">
      <table class="table table-bordered">
      <h3>TCL For Nutrition and EPI Program P3</h3>
        <tr>
          <th colspan="7">Micronutrient Supplementation</th>
          <th rowspan="2">Deworming</th>
          <th rowspan="4">Remarks</th>
        </tr>
        <tr>
          <td colspan="3">Vitamin A</td>
          <td colspan="2">IRON</td>
          <td colspan="2">M N P</td>
        </tr>
        <tr>
          <td rowspan="2">6-11<br>MOS</td>
          <td colspan="2">12-59 MOS.</td>
          <td rowspan="2">6-11<br>MOS</td>
          <td rowspan="2">12-59<br>MOS</td>
          <td rowspan="2">6-11<br>MOS</td>
          <td rowspan="2">12-23<br>MOS</td>
          <td rowspan="2">12-59<br>MOS</td>
        </tr>
        <tr>
          <td>Dose 1</td>
          <td>Dose 2</td>
        </tr>
        <tbody>
          <tr class="active">
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
            <td>Blank</td>
          </tr>
        </tbody>
      </table>
    </div><!-- Div.table-responsive-->


     <script>
        var token = '{{ Session::token() }}';
        var csrf = '{{ csrf_field() }}';
        var edit_submit = '{{ route('hospitaltype.update') }}';
        var store = '{{ route('hospitaltype.store_hospital_type') }}';
     </script>

@endsection

@section('scripts')
  
  {!! Html::script('js/inlineeditor.js') !!}
  {!! Html::script('dist/datepicker.js') !!}
  {!! Html::script('js/jquery.jeditable.datepicker.js') !!}
  {!! Html::script('js/patient.show.inlineedit.js') !!}

@endsection