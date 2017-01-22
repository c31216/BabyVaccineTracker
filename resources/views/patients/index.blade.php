@extends('main')

@section('stylesheets')

  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('dist/datepicker.css') !!}

@endsection

@section('title', 'Patient Lists')

@section('content')
    
    <style>
      #validation{
        display: none;
      }
    </style>
    <div class="alert" id="validation" role="alert">
      <strong></strong>
    </div>

    <br>
    {{ Form::label('search', "Search: ") }}
    {{ Form:: text('search', null, ['id'=>'search'])}}

    <hr>
        <h3>Records <a href="#" id="add-record"><img class="add-record-button" src="/img/add_record.png"></a></h3>
        <p>Sort by:</p>
        <form action="">
          <input type="radio" value="patient_lname" name="sort"> Last name
          <input type="radio" value="patient_fname" name="sort"> First name
          <input type="radio" value="patient_registration_date" name="sort"> Date of Registration
          <input type="radio" value="patient_bdate" name="sort"> Date of Birth
        </form>      
        <br>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr id="th">
            <th>Date of registration</th>
            <th>Date of birth</th>
            <th>Last name</th>
            <th>First name</th> 
            <th>Weight(kg)</th>
            <th>Height(cm)</th>
            <th>Head Circumf.(cm)</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Name of mother</th>
            <th>Name of father</th>
            <th>Name of guardian</th>
            <th>Address</th>
            

          </tr>
        </thead>
          
          
        <tbody id="p_list">
          @foreach($patients as $patient)
            <tr>
              <td class="date patient_registration_date" id="{{$patient->PatientID}}">{{$patient->patient_registration_date}}</td>
              <td class="date patient_bdate" id="{{$patient->PatientID}}">{{$patient->patient_bdate}}</td>
              <td class="edit patient_lname" id="{{$patient->PatientID}}">{{$patient->patient_lname}}</td>
              <td class="edit patient_fname" id="{{$patient->PatientID}}">{{$patient->patient_fname}}</td>
              <td class="number patient_weight" id="{{$patient->PatientID}}">{{$patient->patient_weight}}</td>
              <td class="number patient_height" id="{{$patient->PatientID}}">{{$patient->patient_height}}</td>
              <td class="number patient_headcircumference" id="{{$patient->PatientID}}">{{$patient->patient_headcircumference}}</td>
              <td class="patient_age" id="{{$patient->PatientID}}">{{Carbon::createFromFormat('Y-m-d', $patient->patient_bdate)->diff(Carbon::now())->format('%y year(s), %m month(s) and %d day(s)')}}</td>
              <td class="select patient_sex" id="{{$patient->PatientID}}">{{$patient->patient_sex}}</td>
              <td class="edit patient_mother_name" id="{{$patient->PatientID}}">{{$patient->patient_mother_name}}</td>
              <td class="edit patient_father_name" id="{{$patient->PatientID}}">{{$patient->patient_father_name}}</td>
              <td class="edit patient_guardian_name" id="{{$patient->PatientID}}">{{$patient->patient_guardian_name}}</td>
              <td class="edit patient_address" id="{{$patient->PatientID}}">{{$patient->patient_address}}</td>
              {{-- <td><input type="hidden" name="_method" value="PUT" /></td> --}}

              <td>
                <a href="{{ route('posts.show', $patient->PatientID) }}">
                    <p>View Profile</p>
                </a>
              </td>

              <td>
                <a href="{{ route('checkup.show', $patient->PatientID) }}">
                    <p>Check Up</p>
                </a>
              </td>

              <td>
                <a href="{{ route('immunization.show', $patient->PatientID) }}">
                    <p>Immunization</p>
                </a>
              </td>
              <td>
                <a href="{{ route('posts.pdf', $patient->PatientID) }}" target="_blank" >
                    <p>Download PDF</p>
                </a>
              </td>

            </tr>
          @endforeach
        </tbody>
        <tbody id="search">
          
        </tbody>
      </table>
    </div>


    <div class="text-center">
      {!! $patients->links(); !!}
    </div>

  <script type="text/javascript">  
    var token = '{{ Session::token() }}';
    var url = '{{ route('posts.search') }}';
    var edit_submit = 'posts/update';
    var add = '{{ route('posts.store') }}';
    var index = "{{route('posts.index')}}";
    var csrf = '{{ csrf_field() }}';
  </script>


  @section('scripts')
    {!! Html::script('js/search.js') !!}
    {!! Html::script('js/addrecord.js') !!}
    {!! Html::script('js/inlineeditor.js') !!} 
    {!! Html::script('dist/datepicker.js') !!}
    {!! Html::script('js/jquery.jeditable.datepicker.js') !!}
    {!! Html::script('js/custom_inlineeditor.js') !!}
    

  @endsection

@endsection