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
                            <input type="submit" name="counseling" class="nav-choice" value="COUNSELING" id="counseling"
                                style="border-bottom: solid 3px rgb(98, 130, 172)">
                            </input>
                            <input type="submit" name="community" class="nav-choice" id="service"
                                value="COMMUNITY SERVICE">
                                <input type="submit" name="conference" class="nav-choice" id="conference"
                                value="CONFERENCE">
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

                        <div class="input-wrap" id="date-due">
                            <label for="date" style="min-width: 240px;" id="datelabel">Due date of compliance:</label>
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
                                <option value="Chemistry Laboratory">Chemistry Laboratory</option>

                            </select>
                        </div>
                        <div class="input-wrap">
                            <label for="date" class="conf-items" style="display: none">Date of Conference:</label>
                            <input type="date" name="date" id="date_conference" class="conf-items" style="display: none"></input>
                        </div>
                        <div class="input-wrap">
                            <label for="con-type" class="conf-items" style="display: none">Conference Type:</label>
                            <select id="con-type" name="con-type" class="con-type conf-items" style="display: none">

                                <option value="" style="display: none;">Select Conference Type</option>
                                <option value="Parent/Teacher">Parent/Teacher</option>
                                <option value="Teacher/Student">Teacher/Student</option>
                            </select>
                        </div>
                        <div class="input-wrap">
                            <label for="name" class="conf-items" style="display: none">Attendees:</label>
                            <input name="name" id="attendees" class="conf-items" style="display: none"></input>
                            <buttton class="btn btn-success btn-sm conf-items" id="add-con" style="margin-left: 2%;display: none">Add</buttton>
                        </div>
                      
                    </div>
                    <div class="multi-left">
                    <div class="container mt-5">

            <div class="col-md-6 conf-table" style="overflow: auto; height:300px; display: none;">
            <table class="table">
        <tr>
            <th>Attendee Name</th>
            <th>Action</th>
        </tr>
       <tbody id="teacher-list">

       </tbody>
    </table>
            </div>
    </div>
                    </div>
                </div>
                <div class="explanation">
                    <label for="notice" style="display: none;">Notice to Explain:</label>
                    <textarea name="notice" id="notice" style="display: none"></textarea>
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
                $('#datelabel').css('display', 'block');
                $('#dateField').css('display', 'block');
                $('.conf-table').css('display', 'none');
                $('#date_conference').val('');
                $('.conf-items').css('display', 'none');
            } else if($(this).attr('name') == 'community'){
                choice = 'community';
                $('.department-function').css('display', 'block');
                $('dateField').val('');
                $('#notice').val('');
                $('#datelabel').css('display', 'block');
                $('#dateField').css('display', 'block');
                $('.conf-table').css('display', 'none');
                $('#conf-items').css('display', 'none');
            } else if($(this).attr('name') == 'conference'){
                choice = 'conference';
                $('.department-function').css('display', 'none');
                $('#dateField').css('display', 'none');
                $('#dateField').val('');
                $('#datelabel').css('display', 'none');
                $('#notice').val('');
                $('.conf-table').css('display', 'block');
                $('.conf-items').css('display', 'block');
            }
        });
        $('#date_conference').change(function(){
            $('#notice').val(`
            <p>Dear ${$('#nameField').val()},</p>

<h3>Notice of Conference</h3>

<p>This letter serves as a formal notification that you are required to attend a mandatory conference regarding a concern that has been raised involving a violation of the school's rules and regulations.</p>

<p><strong>Details of the Conference:</strong></p>
<ul>
    <li>Violation: ${$('#violation_type option:selected').data('value')}</li>
    <li>Classification: Major Violation</li>
    <li>Date: ${$('#date_conference').val()}</li>
    <li>Facilitator: [Name of School Official/Disciplinary Counselor]</li>
</ul>

<p>The purpose of this conference is to discuss the details of the incident, review the impact of your actions, and collaborate on a plan for corrective measures to ensure compliance with the school code of conduct moving forward.</p>

<p>Attendance at this meeting is mandatory, and failure to attend may result in additional disciplinary actions. If you are unable to attend at the scheduled time, please inform the Disciplinary Office in advance to arrange an alternative time.</p>

<p>We hope that this meeting will provide an opportunity for reflection, support, and a constructive path forward.</p>

<p>If you have any questions or concerns before the conference, please do not hesitate to reach out to the Disciplinary Office.</p>

<br>

<p>Sincerely,</p>
<p>[Name of School Official]<br>Disciplinary Counselor</p>`
            );
        })
        $('#dateField').change(function () {
            let today = new Date();
            let options = { year: 'numeric', month: 'long', day: 'numeric' };
            let formattedPresentDate = today.toLocaleDateString('en-US', options);
            let futureDate = new Date($('#dateField').val());
            let formattedFutureDate = futureDate.toLocaleDateString('en-US', options);
            if (choice == 'counseling') {
                $('#notice').val(`<p>Dear${$('#nameField').val()},</p>
    <p>Notice of Violation</p>
    <p>This serves as a formal notice regarding a violation of the school's rules and regulations that you have committed.</p>
    <p>Details of Violation:</p>
    <ul>
        <li>Violation Committed: ${$('#violation_type option:selected').data('value')}</li>
        <li>Classification: Major Violation</li>
    </ul>
    <p>The above-stated violation was observed and recorded on ${formattedPresentDate}</p>
    <p>As per the school's code of conduct, this action is categorized as a Major violation, which has serious implications.</p>
    <p>You are required to comply with this notice by acknowledging receipt and understanding of the violation either through the school's official application or by visiting the Disciplinary Office in person. This must be done by ${formattedFutureDate}, failing which further disciplinary action may be initiated.</p>
    <p>Additionally, due to the nature of this violation, it has been determined that you may need additional support. As such, you will be endorsed to the Counseling Office for further assessment and guidance.</p>
    <p>The purpose of this endorsement is to provide you with the necessary support and to help you reflect on your actions to prevent future occurrences.</p>
    <p>If you have any questions or require further clarification, do not hesitate to reach out to the Student Affairs Offic.</p>
    <br>
    <p>Sincerely,</p>
    <p>[Name of School Official]<br>Disciplinary Counselor</p>
                    `);
            }
            else if(choice == 'community'){
                $('#notice').val(`
<p>Dear ${$('#nameField').val()},</p>
    <h3>Notice of Violation</h3>
    <p>This serves as a formal notice regarding a violation of the school's rules and regulations that you have committed.</p>
    <p>Details of Violation:</p>
    <ul>
        <li>Violation Committed: ${$('#violation_type option:selected').data('value')}</li>
        <li>Classification:Major Violation</li>
    </ul>
    <p>The above-stated violation was observed and recorded on ${formattedPresentDate}. As per the school's code of conduct, this action is categorized as a Major violation, which has serious implications.</p>
    <p>You are required to comply with this notice by acknowledging receipt and understanding of the violation either through the school's official application or by visiting the Disciplinary Office in person. This must be done by ${formattedFutureDate}, failing which further disciplinary action may be initiated.</p>
    <p>In light of this violation, you are also being endorsed for community service as part of your corrective measures. You are required to complete your community service with the ${$('#department').val()} department. The assigned hours and tasks will be communicated to you by the department head. This opportunity is provided to help you reflect on your actions and contribute positively to the school community.</p>
    <p>If you have any questions or require further clarification, do not hesitate to reach out to the Student Affairs Office.</p>
    <br>
    <p>Sincerely,</p>
    <p>[Name of School Official]<br>Disciplinary Counselor</p>`);
            }
            
        })
        $('#department').on('change', function () {
            $('#dateField').trigger('change');
        })

        $('#add_violation').on('click', function () {
            if ($('#dateField').val() == '' && choice != 'conference') {
                $('#add_error').text('Please select a date');
                return;
            }
            if($('#date_conference').val() == '' && choice == 'conference'){
                $('#add_error').text('Please select a date');
                return;
            }
            if($('#con-type').val() == '' && choice == 'conference'){
                $('#add_error').text('Please select a conference type');
                return;
            }
            if($('#teacher-list').children().length == 0 && choice == 'conference'){
                $('#add_error').text('Please add attendees');
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
                        choice: choice,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'success') {
                            $.ajax({
                                url: 'email/mail.php',
                                type: 'POST',
                                data: {
                                    student_id: $('#studentIDField').val(),
                                    name: $('#nameField').val(),
                                    course: coursee,
                                    section: sectionn,
                                    subject: 'Notice of Violation',
                                    message: $('#notice').val(),
                                    email: email
                                },success: function(data){
                                    console.log(data);
                                }
                            })
                            $('#major_success').modal('show');
                        }
                    }
                })
            } else if(choice == 'community') {
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
                            $.ajax({
                                url: 'email/mail.php',
                                type: 'POST',
                                data: {
                                    student_id: $('#studentIDField').val(),
                                    name: $('#nameField').val(),
                                    course: coursee,
                                    section: sectionn,
                                    subject: 'Notice of Violation',
                                    message: $('#notice').val(),
                                    email: email
                                },success: function(data){
                                    console.log(data);
                                }
                            })
                            $('#major_success').modal('show');

                        }

                    }
                })
                
            }else if (choice == 'conference') {
                $('#add_error').text('');
                var attendees = [];
                $('#teacher-list').children().each(function(){
                    attendees.push($(this).children().first().text());
                })

                $.ajax({
                    url: 'php/add_violation.php',
                    type: 'POST',
                    data: {
                        student_id: $('#studentIDField').val(),
                        date_of_conference: $('#date_conference').val(),
                        violation_type: $('#violation_type').val(),
                        category: $('#category_type').val(),
                        notice: $('#notice').val(),
                        conference: $('#con-type').val(),
                        type: 'major',
                        choice: choice,
                        attendees: attendees
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'success') {
                            $.ajax({
                                url: 'email/mail.php',
                                type: 'POST',
                                data: {
                                    student_id: $('#studentIDField').val(),
                                    name: $('#nameField').val(),
                                    course: coursee,
                                    section: sectionn,
                                    subject: 'Notice of Violation',
                                    message: $('#notice').val(),
                                    email: email
                                },success: function(data){
                                    console.log(data);
                                }
                            })
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
            $.ajax({
                url: 'printable/set_print.php',
                type: 'POST',
                data: {
                    student_id: $('#studentIDField').val(),
                    category: $('#category_type').val(),
                    name: $('#nameField').val(),    
                    type: 'major',
                    choice: choice,
                    course :coursee,
                    section: sectionn
                },
                success: function (data) {
                    console.log(data);
                }
            })
            window.location.href = './printable/print.php';
        })
        $('#add-con').on('click', function () {
            if($('#attendees').val() == ''){
                return;
            }
            if($('#att-type').val() == ''){
                return;
            }
             else {
                $('#teacher-list').append(`
                <tr>
            <td>
            ${$('#attendees').val()}
            </td>
            <td>
              <button class="btn btn-danger btn-sm delete-teach">Remove</button>
            </td>
        </tr>
                `);
                $('#attendees').val('');
            }
        })
        $('#teacher-list').on('click', '.delete-teach', function () {
            $(this).closest('tr').remove();
        })
    });
</script>