<html>
	<head>
		<title>Resultsheet</title>
		{{-- <link rel="stylesheet" href="{{ asset('marksheet/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('marksheet/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('marksheet/js/jquery-3.4.1.min.js') }}">
        <link rel="stylesheet" href="{{ asset('marksheet/js/bootstrap.min.js') }}"> --}}
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&subset=devanagari" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid resultcontainerfluid">
	<div class="resultcontainer">
        @foreach ($studentLists as $item)
        <div class="box resultpaper">
			<div class="row letterhead">
				<div class="col-md-3 text-center">
					<div class="school-result-logo">
						<img src="{{ asset('marksheet/images/school-logo.png' )}}" alt="school-logo.png" class="img-fluid">
					</div>
				</div>
				<div class="col-md-6 col-offset-md-3">
					<ul class="school-title">
						<li>नेपाल सरकार</li>
                        <li>Government of Nepal</li>
                        <li>नमूना नगरपालिका</li>
                        <li>Model Municipality</li>
                        <li>स्थानिय परीक्षा बोर्ड</li>
						<li>LOCAL EXAMINATION BOARD</li>
					</ul>
					
				</div>
			</div>
			<div class="gradetitle">
				<h1 class="text-center">GRADE SHEET</h1>
			</div>
			<div class="content-fill">
				<form action="">
				<p> THE GRADE(S) SECURED BY 
                    <input type="text" class="fill-content-name" name="std-name" value="{{ $student['name'] }}"/> DATE OF BIRTH: 
                    <input type="text" class="fill-content-dob" name="std-dob" value="{{ $student['dob'] }}"/>  SymbolNo. 
                    <input type="text" class="fill-content-rollno" name="std-roll" value="{{ $student['symbol_no'] }}"/> GRADE 
                    <input type="text" class="fill-content-grade" name="std-grade" value="{{ $student->sclass->name }}"/> SCHOOL 
                    <input type="text" class="fill-content-school-name" name="school-name" value="{{ $student->sclass->school->school_name }}"/> DISTRICT
                    <input type="text" class="fill-content-school-location" name="school-location" value="Lalitpur"/> PROVINCE 
                    <input type="text" class="fill-content-school-province" name="province" value="No. 3"/> IN THE 
                    <input type="text" class="fill-content-exam" name="exam" value="1st"/> TERM EXAMINATION 
                    <input type="text" class="fill-content-exam-year" name="exam-year" value="{{ $student['batch'] }}"/> ARE GIVEN BELOW:</p>
				</form>
			</div>
            <div class="school-stamp">
              <div class="card" style="border:none !important; margin-top: -40px;"> 
                <img src="{{ asset('marksheet/images/school-logo.png') }}" alt="school-logo.png" class="img-fluid">
                <div class="card-img-overlay" style="border:none !important;">
                <table border=2 class="table marksheet-table text-center">
                        <thead>
                            <tr>
                                <th rowspan="2">Sn.</th>
                                <th rowspan="2">SUBJECTS</th>
                                
                                <th colspan="3">OBTAINED MARKS</th>
                                
                            </tr>
                            <tr>
                                <th>FM</th>
                                <th>PM</th>
                                <th>MARKS</th>
                                
                            </tr>                       
                        </thead>
                        <tbody>
                            @forelse ($newArray as $key=> $array)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ strtoUpper($array[1]['name']) }}</td>
                                <td>{{ $array[1]['FM'] }}</td>
                                <td>{{ $array[1]['PM'] }}</td>
                                <td>{{ $array[0] }}</td>
                            </tr>
                            @empty
                                
                            @endforelse
                            

                            
                        </tbody>
                        <thead>
                            <tr>
                                <td colspan="4">TOTAL:</td>
                                <td colspan="1" class="text-center">{{ $total }}</td>
                                
                            </tr>

                            <tr>
                                <td colspan="4">PERCENTAGE:</td>
                                <td colspan="1" class="text-center">{{ round($percentage,2) }}</td>
                                
                            </tr>
                        </thead>
                    </table>
            </div>
            </div>
            
            </div>
            
			
			
            <div class="result-index">
                <ol>
                    <li>FM: Full Marks, PM: Pass Marks</li>
                    <li>Abs/Ab*: Absent</li>
                </ol>
                <ul>
                    <li>T*: Theory Grade Missing</li>
                    <li>P*: Practical Grade Missing</li>
                </ul>
            </div>
            <div class="row authority">
                <div class="col-md-7">
                    <ul>
                        <li>CHECKED BY <span><input type="text" name="checked-by"  value="" class="fill-content-checkedby"></span></li>
                        <li class="pt-2">DATE OF ISSUE :<span><input type="text" name="issue-date"  value="2075-12-27" class="fill-content-issue-date"></span></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul>
                        <li></li>
                        <li class="text-center"><input type="text" name="officer-signature" value="" class="fill-content-signature"></li>
                        <li class="text-center">EDUCATION OFFICER</li>
                    </ul>
                </div>
            </div>
			
        </div>
        
        <br>
        @endforeach
		

	</div>
</div>

		

    </body>
    <style>
        @font-face {
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 400;
        }
    </style>
</html>