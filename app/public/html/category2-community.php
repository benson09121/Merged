<section class="main-do" id="nextstep" style="display: none;">


    <div class="body-content">

        <div class="form-container">

            <div class="student-violation">
                <div class="student-header info-header">
                <h1><i class="fa-solid fa-chevron-left fa-sm me-3 btn_back"
                style="color: #1b4284;"></i>Student Violation</h1>
                    <hr>
                </div>

                <div class="table-nav">
                    <div class="nav-list">
                        <h4 id="title_category">CATEGORY 2</h4>
                        <h3 style="argin-top: 1rem;">INTERVENTION</h3>
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
                            <input type="date" name="date" id="date_conference" class="conf-items"
                                style="display: none"></input>
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
                            <buttton class="btn btn-success btn-sm conf-items" id="add-con"
                                style="margin-left: 2%;display: none">Add</buttton>
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
                        <p>Major violation has been successfully added and Email has been sent.</p>
                        <div class="buttons">
                        <input type="submit" name="" id="print_left" value="Recommendation" style="font-size: 15px; display: none;">
                        <input type="submit" name="" id="print_center" value="Endorsement" style="font-size 18px; display: none;">
                            <input type="submit" name="send_email" id="print_violation" value="Print Violation" style="font-size 18px;">
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
    var category_1 = true;
    var category_2 = true;
    var category_3 = true;
    var category_4 = true;
    var category1_choice = "";
    var category2_choice = "";
    var category3_choice = "";
    var category4_choice = "";
    var category1_due_date = "";
    var category2_due_date = "";
    var category2_department = "";
    var category1_notice = "";
    var category2_notice = "";
    var category3_notice = "";
    var category4_notice = "";
    var category1_attendees = [];
    var category2_attendees = [];
    var category3_attendees = [];
    var category4_attendees = [];
    var category1_contype = "";
    var category2_contype = "";
    var category3_contype = "";
    var category4_contype = "";

    $(document).ready(function () {
        LoadMajorViolation();
        $('.nav-choice').click(function () {
            $('.nav-choice').css('border-bottom', 'none');
            $(this).css('border-bottom', 'solid 3px rgb(98, 130, 172)');
            if ($(this).attr('name') == 'counseling') {
                choice = 'counseling';
                $('.department-function').css('display', 'none');
                $('#department').val('');
                $('#dateField').val('');
                $('#notice').val('');
                $('#datelabel').css('display', 'block');
                $('#dateField').css('display', 'block');
                $('.conf-table').css('display', 'none');
                $('#date_conference').val('');
                $('.conf-items').css('display', 'none');
                email_list = [];
            } else if ($(this).attr('name') == 'community') {
                choice = 'community';
                $('.department-function').css('display', 'block');
                $('#dateField').val('');
                $('#notice').val('');
                $('#datelabel').css('display', 'block');
                $('#dateField').css('display', 'block');
                $('.conf-table').css('display', 'none');
                $('.conf-items').css('display', 'none');
                email_list = [];
            } else if ($(this).attr('name') == 'conference') {
                choice = 'conference';
                $('.department-function').css('display', 'none');
                $('#dateField').css('display', 'none');
                $('#dateField').val('');
                $('#datelabel').css('display', 'none');
                $('#notice').val('');
                $('.conf-table').css('display', 'block');
                $('.conf-items').css('display', 'block');
                email_list = [];
            }
        });
        $('#date_conference').change(function () {
            email_list = [];
            students.forEach(student => {
                let email_entry = {
                    email : student['email'],
                    student_name : student['student_name'],
                    message: `<p>Dear ${student['student_email']},</p>

<h3>Notice of Conference</h3>

<p>This letter serves as a formal notification that you are required to attend a mandatory conference regarding a concern that has been raised involving a violation of the school's rules and regulations.</p>

<p><strong>Details of the Conference:</strong></p>
<ul>
    <li>Violation: ${violationString}</li>
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
<p>[Name of School Official]<br>Disciplinary Counselor</p>`,
                };
                email_list.push(email_entry);
            })
            console.log(email_list);
        })
        $('#dateField').change(function () {
            let today = new Date();
            let options = { year: 'numeric', month: 'long', day: 'numeric' };
            let formattedPresentDate = today.toLocaleDateString('en-US', options);
            let futureDate = new Date($('#dateField').val());
            let formattedFutureDate = futureDate.toLocaleDateString('en-US', options);
            if (choice == 'counseling') {
                email_list = [];
                students.forEach(student => {
                    let email_entry = {
                        email : student['email'],
                        student_name : student['student_name'],
                        message : `<p>Dear ${student['student_name']},</p>
    <p>Notice of Violation</p>
    <p>This serves as a formal notice regarding a violation of the school's rules and regulations that you have committed.</p>
    <p>Details of Violation:</p>
    <ul>
        <li>Violation Committed: ${violationString}</li>
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
                    `,
                    };
                    email_list.push(email_entry);
                }

                );
                console.log(email_list);
            }
            else if (choice == 'community') {
                email_list = [];
                students.forEach(student => {
                    let email_entry = {
                        email: student['email'],
                        student_name : student['student_name'],
                        message: `<p>Dear ${student['student_name']},</p>
    <h3>Notice of Violation</h3>
    <p>This serves as a formal notice regarding a violation of the school's rules and regulations that you have committed.</p>
    <p>Details of Violation:</p>
    <ul>
        <li>Violation Committed: ${violationString}</li>
        <li>Classification:Major Violation</li>
    </ul>
    <p>The above-stated violation was observed and recorded on ${formattedPresentDate}. As per the school's code of conduct, this action is categorized as a Major violation, which has serious implications.</p>
    <p>You are required to comply with this notice by acknowledging receipt and understanding of the violation either through the school's official application or by visiting the Disciplinary Office in person. This must be done by ${formattedFutureDate}, failing which further disciplinary action may be initiated.</p>
    <p>In light of this violation, you are also being endorsed for community service as part of your corrective measures. You are required to complete your community service with the ${$('#department').val()} department. The assigned hours and tasks will be communicated to you by the department head. This opportunity is provided to help you reflect on your actions and contribute positively to the school community.</p>
    <p>If you have any questions or require further clarification, do not hesitate to reach out to the Student Affairs Office.</p>
    <br>
    <p>Sincerely,</p>
    <p>[Name of School Official]<br>Disciplinary Counselor</p>`,
                    };
                    email_list.push(email_entry);
                })
                console.log(email_list);

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
            if ($('#date_conference').val() == '' && choice == 'conference') {
                $('#add_error').text('Please select a date');
                return;
            }
            if ($('#con-type').val() == '' && choice == 'conference') {
                $('#add_error').text('Please select a conference type');
                return;
            }
            if ($('#teacher-list').children().length == 0 && choice == 'conference') {
                $('#add_error').text('Please add attendees');
                return;
            }
            
if (hasCategory1 === "Yes") {
    if (choice == "counseling") {
        category1_choice = "counseling";
        category1_due_date = $('#dateField').val();
        category1_notice = $('#notice').val();
        $('#print_left').css('display', 'block');
    } else if (choice == "conference") {
        category1_choice = "conference";
        category1_due_date = $('#date_conference').val();
        category1_notice = $('#notice').val();
        $('#teacher-list').children().each(function () {
            category1_attendees.push($(this).children().first().text());
        });
        category1_date_of_conference = $('#date_conference').val();
        category1_contype = $('#con-type').val();
    }
    hasCategory1 = "No";
    $('#dateField').val('');
    $('#notice').val('');
    return;
} else if (hasCategory2 === "Yes") {
    if (category_2 == true) {
        $('#title_category').text('Category ' + 2);
        choice = "counseling";
        $('#dateField').css('display', 'block');
        $('#counseling').css('display', 'block');
        $('.conf-items').css('display', 'none');
        $('.conf-table').css('display', 'none');
        category_2 = false;
        return;
    } else {
        if (choice === "counseling") {
            category2_choice = "counseling";
            category2_due_date = $('#dateField').val();
            category2_notice = $('#notice').val();
            $('#print_left').css('display', 'block');
        } else if (choice === "community") {
            category2_choice = "community";
            category2_due_date = $('#dateField').val();
            category2_department = $('#department').val();
            category2_notice = $('#notice').val();
            $('#print_center').css('display', 'block');
        } else if (choice === "conference") {
            category2_choice = "conference";
            category2_due_date = $('#date_conference').val();
            category2_notice = $('#notice').val();
            category2_contype = $('#con-type').val();
            $('#teacher-list').children().each(function () {
                category2_attendees.push($(this).children().first().text());
            });
        }
        hasCategory2 = "No";
        $('#dateField').val('');
        $('#notice').val('');
        $('#department').val('');
    }
} else if (hasCategory3 === "Yes") {
    if (category_3 == true) {
        $('#title_category').text('Category ' + 3);
        choice = "conference";
        $('.department-function').css('display', 'none');
        $('#dateField').css('display', 'none');
        $('#dateField').val('');
        $('#datelabel').css('display', 'none');
        $('#notice').val('');
        $('.conf-table').css('display', 'block');
        $('.conf-items').css('display', 'block');
        category_3 = false;
        return;
    } else {
        if (choice === "conference") {
            category3_choice = "conference";
            category3_due_date = $('#date_conference').val();
            category3_notice = $('#notice').val();
            category3_contype = $('#con-type').val();
            $('#teacher-list').children().each(function () {
                category3_attendees.push($(this).children().first().text());
            });
        }
        hasCategory3 = "No";
        $('#dateField').val('');
        $('#notice').val('');
        $('#department').val('');
    }
} else if (hasCategory4 === "Yes") {
    if (category_4 == true) {
        $('#title_category').text('Category ' + 4);
        choice = "conference";
        $('.department-function').css('display', 'none');
        $('#dateField').css('display', 'none');
        $('#dateField').val('');
        $('#datelabel').css('display', 'none');
        $('#notice').val('');
        $('.conf-table').css('display', 'block');
        $('.conf-items').css('display', 'block');
        category_4 = false;
        return;
    } else {
        if (choice === "conference") {
            category4_choice = "conference";
            category4_due_date = $('#date_conference').val();
            category4_notice = $('#notice').val();
            category4_contype = $('#con-type').val();
            $('#teacher-list').children().each(function () {
                category4_attendees.push($(this).children().first().text());
            });
        }
        hasCategory4 = "No";
        $('#dateField').val('');
        $('#notice').val('');
        $('#department').val('');
    }
} else if (hasCategory5 === "Yes") {
    // Handle Category 5 if needed
}

if (hasCategory1 == "No" && hasCategory2 == "No" && hasCategory3 == "No" && hasCategory4 == "No" && hasCategory5 == "No") {
    if (category1_choice !== "") {
        if (category1_choice === "counseling") {
            $.ajax({
                url: 'php/add_violation.php',
                type: 'POST',
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category1_due_date,
                    notice: category1_notice,
                    choice: category1_choice,
                    type: "major",
                    violationString: violationString,
                    category: "1"
                },
                success: function (data) {
            
                }
            });
        } else if (category1_choice === "conference") {
            $.ajax({
                url: 'php/add_violation.php',
                type: "POST",
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category1_due_date,
                    attendees: category1_attendees,
                    conference: category1_contype,
                    type: "major",
                    choice: category1_choice,
                    notice: category1_notice,
                    category: "1"
                },
                success: function (data) {
                    console.log(data);
                }
            });
        }
    }
    if (category2_choice !== "") {
        if (category2_choice === "counseling") {
            $.ajax({
                url: 'php/add_violation.php',
                type: 'POST',
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category2_due_date,
                    notice: category2_notice,
                    choice: category2_choice,
                    type: "major",
                    violationString: violationString,
                    category: "2"
                },
                success: function (data) {
                    console.log(data);
                }
            });
        } else if (category2_choice === "community") {
            $.ajax({
                url: "php/add_violation.php",
                type: "POST",
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category2_due_date,
                    department: category2_department,
                    notice: category2_notice,
                    choice: category2_choice,
                    type: "major",
                    violationString: violationString,
                    category: "2"
                },
                success: function (data) {
                    console.log(data);
                }
            });
        } else if (category2_choice === "conference") {
            $.ajax({
                url: 'php/add_violation.php',
                type: "POST",
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category2_due_date,
                    attendees: category2_attendees,
                    conference: category2_contype,
                    type: "major",
                    choice: category2_choice,
                    notice: category2_notice,
                    violationString: violationString,
                    category: "2"
                },
                success: function (data) {
                    console.log(data);
                }
            });
        }
        
    }
    if (category3_choice !== "") {
        if (category3_choice === "conference") {
            $.ajax({
                url: 'php/add_violation.php',
                type: "POST",
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category3_due_date,
                    attendees: category3_attendees,
                    conference: category3_contype,
                    type: "major",
                    choice: category3_choice,
                    notice: category3_notice,
                    violationString: violationString,
                    category: "3"
                },
                success: function (data) {
                    console.log(data);
                }
            });
        }
    }
    if (category4_choice !== "") {
        if (category4_choice === "conference") {
            $.ajax({
                url: 'php/add_violation.php',
                type: "POST",
                data: {
                    students: students,
                    violation_list: violation_list,
                    due_date: category4_due_date,
                    attendees: category4_attendees,
                    conference: category4_contype,
                    type: "major",
                    choice: category4_choice,
                    notice: category4_notice,
                    violationString: violationString,
                    category: "4"
                },
                success: function (data) {
                    console.log(data);
                }
            });
        }
    }
    $('#major_success').modal('show');
                            $('#teacher-list').empty();
                            $('conf-items').css('display', 'none');
                            $('conf-table').css('display', 'none');
                            $('#major_success').modal('show');
                            $('#student_selected').empty();
                            students = [];
                        
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
            $('#error').css('display', 'none');
            $('#studentID').val('');
            $('#studentID').trigger('keyup');
            $('#error').css('display', 'none');
            $('#nextstep').css('display', 'none');
            $('#main_body').css('display', 'block');
            $('#violation_selected').empty();
        })
        $('#print_violation').on('click', function () {
           window.open('./printable/print.php', '_blank').focus();
        });
        $('#add-con').on('click', function () {
            if ($('#attendees').val() == '') {
                return;
            }
            if ($('#att-type').val() == '') {
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
    $('#print_left').on('click', function () {
        if(choice == "counseling"){
            window.open('./printable/recommendation.php', '_blank').focus();
        }
    })

    $('#print_center').on('click', function () {
    window.open('./printable/endorsement_letter.php', '_blank').focus();
    });
    function LoadMajorViolation(){
        $.ajax({
            url: 'php/fetch_major_violation_records.php',
            type: 'GET',
            success: function(data){
                major_violation_records = JSON.parse(data);
                console.log(major_violation_records);
            }
        })
    }
</script>