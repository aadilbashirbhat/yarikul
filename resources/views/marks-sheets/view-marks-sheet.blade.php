@extends('layouts.my_app')

@section('title', 'View Student Marks Sheet')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 mb-3 d-print-none">
        <div class="col-12 text-center">
            <a href="#" onclick="window.print()" class=" btn btn-danger btn-lg btn-block"><i class="fas fa-file-pdf"></i> Download PDF</a>
        </div>
    </div>
    <div class="card p-3">
        <p class="text-center text-primary">{!!$student->school_details!!}</p>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td><strong>Student Name:</strong></td>
                    <td>{{ $student->std_name }}</td>
                </tr>
                <tr>
                    <td><strong>Registration Number:</strong></td>
                    <td>{{ $student->std_reg_no }}</td>
                </tr>
            </tbody>
        </table>
        <table id="" class="table table-striped">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Max Marks</th>
                    <th>Marks Obtained</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->subjects as $subject)
                <tr>
                    <td>{{ $subject->subject_name }}</td>
                    <td>{{ $subject->max_marks }}</td>
                    <td>{{ $subject->marks }}</td>
                    <td>{{ $subject->percentage }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('bottom-scripts')
@endpush