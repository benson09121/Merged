<section class="main-do" id="nextstep" style="display: none;">


    <div class="body-content">

        <div class="form-container">

            <div class="student-violation">
                <div class="student-header info-header">
                    <h1>Student Violation</h1>
                    <hr>
                </div>

                <div class="table-nav">
                    <div class="nav-list">
                        <h4 id="title_category">CATEGORY 2</h4>
                        <h3 style="margin-top: 1rem;">INTERVENTION</h3>
                        <ul style="margin-top: .5rem;">
                            <input type="submit" name="counseling" class="nav-choice" value="COUNSELING"
                                style="border-bottom: solid 3px rgb(98, 130, 172)">
                            </input>
                            <input type="submit" name="community" class="nav-choice" id="service"
                                value="COMMUNITY SERVICE">
                            </input>
                        </ul>
                    </div>
                </div>

                <hr>

                <div class="violation-container1">
                    <div class="multi-left">
                        <div class="input-wrap">
                            <label for="name">Student Name:</label>
                            <input name="name" id="nameField1" value="" disabled></input>
                        </div>

                        <div class="input-wrap">
                            <label for="email">Student Email:</label>
                            <input name="email" id="emailField" value="" disabled></input>
                        </div>

                        <div class="input-wrap">
                            <label for="date" style="min-width: 240px;">Due date of compliance:</label>
                            <input type="date" name="date_compliance" id="dateField"></input>
                        </div>

                        <div class="input-wrap">
                            <label for="department" style="min-width: 200px; display: none"
                                class="department-function">Specify Department:</label>
                            <select id="department" name="department" class="department-function" style="display: none">

                                <option value="" style="display: none;">Select Department</option>
                                <option value="Computer Laboratory">Computer laboratory</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Kitchen Laboratory">Kitchen laboratory</option>
                                <option value="NSTP">NSTP</option>
                                <option value="Library">Library</option>



                            </select>
                        </div>
                    </div>
                </div>
                <div class="explanation">
                    <label for="notice">Notice to Explain:</label>
                    <textarea name="notice" id="notice"></textarea>
                    <div class="buttons">
                        <p id="add_error"></p>
                        <input type="submit" name="send_email" id="add_violation" value="ADD VIOLATION">
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="major_success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Violation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Major violation has been successfully added</p>
                        <div class="buttons">
                            <input type="submit" name="send_email" id="print_violation" value="Print Violation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</section>

<script>
    var choice = "counseling";
    var category = '';
    $(document).ready(function () {

        $('.nav-choice').click(function () {
            $('.nav-choice').css('border-bottom', 'none');
            $(this).css('border-bottom', 'solid 3px rgb(98, 130, 172)');
            if ($(this).attr('name') == 'counseling') {
                choice = 'counseling';
                $('.department-function').css('display', 'none');
                $('#department').val('');
                $('dateField').val('');
                $('#notice').val('');
            } else {
                choice = 'community';
                $('.department-function').css('display', 'block');
                $('dateField').val('');
                $('#notice').val('');
            }
        });

        $('#dateField').change(function () {
            let today = new Date();
            let options = { year: 'numeric', month: 'long', day: 'numeric' };
            let formattedPresentDate = today.toLocaleDateString('en-US', options);
            let futureDate = new Date($('#dateField').val());
            let formattedFutureDate = futureDate.toLocaleDateString('en-US', options);
            if (choice == 'counseling') {
                $('#notice').val(`
Dear ${$('#nameField').val()},

Notice of Violation

This serves as a formal notice regarding a violation of the school's rules and regulations that you have committed.

Details of Violation:

Violation Committed: ${$('#violation_type option:selected').data('value')}
Classification: Major Violation

The above-stated violation was observed and recorded on ${formattedPresentDate}. As per the school's code of conduct, this action is categorized as a Major violation, which has serious implications.
You are required to comply with this notice by acknowledging receipt and understanding of the violation either through the school's official application or by visiting the Disciplinary Office in person. This must be done by ${formattedFutureDate}, failing which further disciplinary action may be initiated.

Additionally, due to the nature of this violation, it has been determined that you may need additional support. As such, you will be endorsed to the Counseling Office for further assessment and guidance. The purpose of this endorsement is to provide you with the necessary support and to help you reflect on your actions to prevent future occurrences.

If you have any questions or require further clarification, do not hesitate to reach out to the Student Affairs Office.

Sincerely,
[Name of School Official]
Disciplinary Counselor
                    `);
            }
            else {
                $('#notice').val(`
Dear ${$('#nameField').val()},

Notice of Violation

This serves as a formal notice regarding a violation of the school's rules and regulations that you have committed.

Details of Violation:

Violation Committed: ${$('#violation_type option:selected').data('value')}
Classification: Major Violation

The above-stated violation was observed and recorded on ${formattedPresentDate}. As per the school's code of conduct, this action is categorized as a Major violation, which has serious implications.
You are required to comply with this notice by acknowledging receipt and understanding of the violation either through the school's official application or by visiting the Disciplinary Office in person. This must be done by ${formattedFutureDate}, failing which further disciplinary action may be initiated.

In light of this violation, you are also being endorsed for community service as part of your corrective measures. You are required to complete your community service with the ${$('#department').val()} department. The assigned hours and tasks will be communicated to you by the department head. This opportunity is provided to help you reflect on your actions and contribute positively to the school community.

If you have any questions or require further clarification, do not hesitate to reach out to the Student Affairs Office.

Sincerely,
[Name of School Official]
Disciplinary Counselor
                    `);
            }
        })
        $('#department').on('change', function () {
            $('#dateField').trigger('change');
        })

        $('#add_violation').on('click', function () {
            if ($('#dateField').val() == '') {
                $('#add_error').text('Please select a date');
                return;
            }
            if ($('#notice').val() == '') {
                $('#add_error').text('Please input a notice');
                return;
            }
            if (choice == 'counseling') {
                $('#add_error').text('');
                $.ajax({
                    url: 'php/add_violation.php',
                    type: 'POST',
                    data: {
                        student_id: $('#studentIDField').val(),
                        due_date: $('#dateField').val(),
                        violation_type: $('#violation_type').val(),
                        category: $('#category_type').val(),
                        notice: $('#notice').val(),
                        type: 'major',
                        choice: choice
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'success') {
                            $('#major_success').modal('show');
                        }
                    }
                })
            } else {
                if ($('#department').val() == '') {
                    $('#add_error').text('Please select a department');
                    return;
                }
                $('#add_error').text('');
                $.ajax({
                    url: 'php/add_violation.php',
                    type: 'POST',
                    data: {
                        student_id: $('#studentIDField').val(),
                        due_date: $('#dateField').val(),
                        violation_type: $('#violation_type').val(),
                        category: $('#category_type').val(),
                        notice: $('#notice').val(),
                        department: $('#department').val(),
                        type: 'major',
                        choice: choice
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'success') {
                            $('#major_success').modal('show');

                        }

                    }
                })
                
            }
        })
        $('#major_success').on('hide.bs.modal', function () {
            $('#dateField').val('');
            $('#notice').val('');
            $('#department').val('');
            $('.nav-choice').css('border-bottom', 'none');
            $('.nav-choice[name="counseling"]').css('border-bottom', 'solid 3px rgb(98, 130, 172)');
            choice = 'counseling';
            $('.department-function').css('display', 'none');
            $('#error').css('display', 'none');
            $('#studentIDField').val('');
            $('#nameField').val('');
            $('#courseField').val('');
            $('#offense_type').val('');
            $('#violation_type').val('');
            $('#error').css('display', 'none');
            $('#studentID').val('');
            $('#studentID').trigger('keyup');
            $('#error').css('display', 'none');
            $('#nextstep').css('display', 'none');
            $('#main_body').css('display', 'block');
        })
        $('#print_violation').on('click', function () {
            window.location.href = './printable/endorsement_letter.php';
        })
    });
</script>