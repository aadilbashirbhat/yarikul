@extends('layouts.my_app')

@section('title', 'Student Marks Sheet')

@section('content')
<div class="container">
    <h2>Student Marks Sheets</h2>
    <table id="marksTable" class="table table-striped">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Registration Number</th>
                <th>School</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->std_name ?? '-' }}</td>
                <td>{{ $student->std_reg_no ?? '-' }}</td>
                <td>{{ $student->school_details ?? '-' }}</td>
                <td>
                    <a href="{{ route('marks.show', $student->id) }}" class="btn btn-primary">View Marks</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('bottom-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

<script>
    $(document).ready(function() {
        // Initialize DataTable with export buttons
        $('#marksTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
@endpush