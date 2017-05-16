<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<div class="col-lg-12" id="main_div">
    <div class="well">
        <H3>學生系統</H3>
    </div>
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="well">
                <div class="form-group">
                    <form action="">
                    <div class="row form-group">
                        <label class="form-group col-md-2">
                            <input type="button" id="get_student" class="btn btn-default" value="查詢特定的學生"> 
                        </label>
                        <label class="form-group col-md-3">
                            學號：<input id="student_id" value="">
                        </label>
                    </div>
                    <div class="row form-group">
                        <label class="form-group col-md-2">
                            <input type="button" id="get_student_conditions" class="btn btn-default" value="依條件查詢學生"> 
                        </label>
                        <label class="form-group col-md-3">
                            學號：<input id="condition_student_id" value="">
                        </label>
                        <label class="form-group col-md-3">
                            姓名：<input id="student_name" value="">
                        </label>
                        <label class="form-group col-md-3">
                            註冊時間：<input id="student_register_date" value="">
                        </label>
                    </div>
                    <div class="row form-group">
                        <label class="form-group col-md-2">
                            <input type="button" id="get_student_start_limit" class="btn btn-default" value="查詢所有學生"> 
                        </label>
                        <label class="form-group col-md-3">
                            學號起始：<input id="student_id_start" value="">
                        </label>
                        <label class="form-group col-md-3">
                            筆數：<input id="student_limit" value="">
                        </label>
                    </div>
                    <div class="row form-group">
                        <label class="form-group col-md-2">
                            <input type="button" id="create_student" class="btn btn-default" value="新增一個學生">
                            <div id="repsonse_create_massage"></div>
                        </label>    
                        <label class="form-group col-md-3">
                            姓名：<input id="create_name" value="">
                        </label>
                        <label class="form-group col-md-3">
                            生日：<input id="create_birthday" value="">
                        </label>
                        <label class="hide">
                            註冊時間：<input id="create_register_date" value="{{ date('Y-m-d')}}">
                        </label>
                        <label class="form-group col-md-3">
                            備註：<input id="create_remark" value="">
                        </label>
                    </div>
                    <div class="row form-group">
                        <label class="form-group col-md-2">
                            <input type="button" id="grades_course_of_student" class="btn btn-default" value="查詢各科成績的學生人數">
                        </label>
                    </div>
                    </form>
                </div>
            </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-1">學號</th>
                            <th class="col-md-1">姓名</th>
                            <th class="col-md-1">註冊時間</th>
                            <th class="col-md-2">備註</th>
                        </tr>
                    </thead>
                    <tbody id='student_view'>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-1">成績</th>
                            <th class="col-md-1">課程</th>
                            <th class="col-md-1">總計學生數</th>
                        </tr>
                    </thead>
                    <tbody id='grades_course_of_student_view'>
                    </tbody>
                </table>
        </div>
        <!-- /.panel -->
    </div>
</div>

@section('js')
    <script src="{{ elixir('js/page/home.js') }}" async></script>
@show