$(function () {  
    
    function getStudent(studant_id = 0) {
        let api_condition = new Array();
        api_condition['method'] = 'GET';
        api_condition['url'] = 'api/v1/students/' + studant_id;
        api_condition['data'] = null;
        let agetAjaxData = getAjaxData(api_condition);
        
        agetAjaxData.done(function (response) {
            console.log(response.data);
            let html_view = '';
            //#TODO 可以用 blade 
            for (let i in response.data) {
                html_view += '<tr><td class="col-md-1">' + response.data[i].id + '</td>'
                    + '<td class="col-md-1">' + response.data[i].name + '</td>'
                    + '<td class="col-md-1">' + response.data[i].registerDate + '</td>'
                    + '<td class="col-md-2">' + response.data[i].remark + '</td></tr>'
            }

            $('#student_view').html(html_view);
        }).fail(function (res) {

            $('#student_view').html('<td colspan="4">'
                + res.status
                + " : "
                + res.statusText
                + '</td>'
            );
        });  
    }

    function getStudentConditions(conditions) {
        let api_condition = new Array();
        api_condition['method'] = 'POST';
        api_condition['url'] = 'api/v1/students/method/query';
        api_condition['data'] = conditions;
        let agetAjaxData = getAjaxData(api_condition);

        agetAjaxData.done(function (response) {
            console.log(response.data);
            let html_view = '';
            //#TODO 可以用 blade 
            for (let i in response.data) {
                html_view += '<tr><td class="col-md-1">' + response.data[i].id + '</td>'
                    + '<td class="col-md-1">' + response.data[i].name + '</td>'
                    + '<td class="col-md-1">' + response.data[i].registerDate + '</td>'
                    + '<td class="col-md-2">' + response.data[i].remark + '</td></tr>'
            }

            $('#student_view').html(html_view);
        }).fail(function (res) {

            $('#student_view').html('<td colspan="4">'
                + res.status
                + " : "
                + res.statusText
                + '</td>'
            );
        });
    }

    function getStudentStartLimit(student_id_start, student_limit) {
        let api_condition = new Array();
        api_condition['method'] = 'GET';
        api_condition['url'] = 'api/v1/students/method/start/'
            + student_id_start
            + '/limit/'
            + student_limit;
        api_condition['data'] = null;
        let agetAjaxData = getAjaxData(api_condition);

        agetAjaxData.done(function (response) {
            console.log(response.data);
            let html_view = '';
            //#TODO 可以用 blade 
            for (let i in response.data) {
                html_view += '<tr><td class="col-md-1">' + response.data[i].id + '</td>'
                    + '<td class="col-md-1">' + response.data[i].name + '</td>'
                    + '<td class="col-md-1">' + response.data[i].registerDate + '</td>'
                    + '<td class="col-md-2">' + response.data[i].remark + '</td></tr>'
            }

            $('#student_view').html(html_view);
        }).fail(function (res) {

            $('#student_view').html('<td colspan="4">'
                + res.status
                + " : "
                + res.statusText
                + '</td>'
            );
        });
    }

    function createStudent(conditions) {
        let api_condition = new Array();
        api_condition['method'] = 'POST';
        api_condition['url'] = 'api/v1/students/method/create';
        api_condition['data'] = conditions;
        let agetAjaxData = getAjaxData(api_condition);

        agetAjaxData.done(function (response) {
            console.log(response.data);

            $('#repsonse_create_massage').html(
                'success'
                + " 學號 "
                + response.data.id
            );
        }).fail(function (res) {

            $('#repsonse_create_massage').html(
                res.status
                + " : "
                + res.statusText
            );
        });
    }

    function gradesCourseOfStudent() {
        let api_condition = new Array();
        api_condition['method'] = 'GET';
        api_condition['url'] = 'api/v1/students/grades/Course_of_Student';
        api_condition['data'] = null;
        let agetAjaxData = getAjaxData(api_condition);

        agetAjaxData.done(function (response) {
            console.log(response.data);
            let html_view = '';
            //#TODO 可以用 blade 
            for (let i in response.data) {
                html_view += '<tr><td class="col-md-1">' + response.data[i].level + '</td>'
                    + '<td class="col-md-1">' + response.data[i].course + '</td>'
                    + '<td class="col-md-1">' + response.data[i].count + '</td>'
            }

            $('#grades_course_of_student_view').html(html_view);
        }).fail(function (res) {

            $('#grades_course_of_student_view').html('<td colspan="4">'
                + res.status
                + " : "
                + res.statusText
                + '</td>'
            );
        });
    }

    /**
     * 共用function 
     * 
     * @param {any} api_condition 
     * @returns 
     */
    function getAjaxData(api_condition) {

        return $.ajax({
            method: api_condition['method'],
            url: api_condition['url'],
            dataType: "json",
            data: api_condition['data']
        });
    }

    
    /**
     * Action
     */
    $('#get_student').click(function () {    
        let studant_id = $('#student_id').val();
        getStudent(studant_id);
    });

    $('#get_student_conditions').click(function () {
        let studant_conditions = {
                    'id': $('#condition_student_id').val(),
                    'name': $('#student_name').val(),
                    'register_date': $('#student_register_date').val()
                };
        getStudentConditions(studant_conditions);
    });

    $('#get_student_start_limit').click(function () {
        let student_id_start = $('#student_id_start').val();
        let student_limit = $('#student_limit').val();
        getStudentStartLimit(student_id_start, student_limit);
    });

    $('#create_student').click(function () {
        let create_studant = {
            'name': $('#create_name').val(),
            'birthday': $('#create_birthday').val(),
            'register_date': $('#create_register_date').val(),
            'remark': $('#create_remark').val(),
            'timestamp': Math.floor(Date.now()/1000)
        };
        createStudent(create_studant);
    });

    $('#grades_course_of_student').click(function () {
        gradesCourseOfStudent();
    });
});
