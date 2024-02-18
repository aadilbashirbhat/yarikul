@extends('layouts.my_app')

@section('title', 'Add New Marks Sheet')

@section('content')
<div class="container">
    <h2>Create New Marks Sheet</h2>
    <form id="marksForm" method="POST" action="{{ route('marks.store') }}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="mb-3 col-6">
                <label for="student_name" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="student_name" name="student_name" required>
            </div>
            <div class="mb-3 col-6">
                <label for="registration_number" class="form-label">Registration Number</label>
                <input type="text" class="form-control" id="registration_number" name="registration_number" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="school_details" class="form-label">School Details</label>
            <textarea class="form-control" id="school_details" name="school_details" rows="3" required></textarea>
        </div>
        <button type="button" class="btn btn-primary" onclick="addSubject()">Add Subject</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Max Marks</th>
                    <th>Marks Obtained</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody id="marksTable">
                <!-- Marks will be dynamically added here -->
            </tbody>
        </table>
    </form>
    <div id="gradeResult" class="mt-3"></div>
</div>
@endsection

@push('bottom-scripts')
<script>
    // Function to add a new subject row
    function addSubject() {
        var marksTable = document.getElementById('marksTable');
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="subjects[]" placeholder="Subject Name"></td>
            <td><input type="number" class="form-control" min="1" name="max_marks[]" placeholder="Max Marks"></td>
            <td><input type="number" class="form-control marks-obtained" min="0" name="marks_obtained[]" placeholder="Marks Obtained"></td>
            <td><input type="text" class="form-control percentage" readonly></td>
        `;
        marksTable.appendChild(newRow);

        // Add event listener for keyup to calculate percentage and grades
        var marksObtainedInputs = newRow.querySelectorAll('.marks-obtained');
        marksObtainedInputs.forEach(function(input) {
            input.addEventListener('keyup', function() {
                calculatePercentage(this);
                calculateGrades();
            });
        });
    }

    // Function to calculate percentage
    function calculatePercentage(input) {
        var maxMarksInput = input.parentNode.previousElementSibling.querySelector('input[type="number"]');
        var percentageInput = input.parentNode.nextElementSibling.querySelector('input[type="text"]');
        var maxMarks = parseInt(maxMarksInput.value);
        var marksObtained = parseInt(input.value);

        // Validate marks obtained against max marks
        if (marksObtained > maxMarks) {
            input.classList.add('is-invalid'); // Add Bootstrap's is-invalid class for styling
            percentageInput.value = ''; // Reset percentage
            return; // Exit function if marks obtained is greater than max marks
        } else {
            input.classList.remove('is-invalid'); // Remove is-invalid class if previously added
        }

        var percentage = (marksObtained / maxMarks) * 100;
        percentageInput.value = isNaN(percentage) ? '' : percentage.toFixed(2) + '%';
    }

    // Function to calculate grades
    function calculateGrades() {
        var totalMarks = 0;
        var subjectCount = 0;
        var subjects = document.querySelectorAll('#marksTable tr');
        var gradeResult = document.getElementById('gradeResult');
        var gradeHTML = '';

        subjects.forEach(function(subject) {
            var marksInput = subject.querySelector('.marks-obtained');
            if (marksInput && marksInput.value !== '') {
                totalMarks += parseInt(marksInput.value);
                subjectCount++;
            }
        });

        if (subjectCount === 0) {
            gradeHTML = '<p>Please add subjects and marks first.</p>';
        } else {
            var averageMarks = totalMarks / subjectCount;

            // Determine status
            var status = averageMarks >= 40 ? 'Pass' : 'Fail';

            gradeHTML = '<h4>Average Marks: ' + averageMarks.toFixed(2) + '</h4>';
            gradeHTML += '<h4>Status: ' + status + '</h4>';
        }

        gradeResult.innerHTML = gradeHTML;
    }
</script>
@endpush