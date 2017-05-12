<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<div class="col-lg-12" id="main_div">
    <div class="well">
        <H3>學生系統</H3>
    </div>
    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-heading">
            <em>共  筆資料</em>
        </div>
        <div class="panel-body">
            <div class="well">
                <div class="form-group">
                    <form action="" method="get">
                        <label class="form-group">
                            學號： <input id="" type="text" value="" class="">
                        </label>
                        
                        <label class="form-group">
                            姓名： <input id="" type="text" value="">
                        </label>
                        
                        <label class="form-group">
                            科目： <input id="" type="text" value="">
                        </label>
                        <label class="form-group">
                            成績： <input id="" type="text" value="">
                        </label>
                        <label class="form-group">
                            註冊區間： <input id="" type="text" value="">
                            ～ <input id="" type="text" value="">
                        </label>
                        <label class="form-group">
                        <button type="submit" class="btn btn-default" id="search">查詢</button>
                        <button type="submit" class="btn btn-default" id="add">新增</button>
                        </label>
                    </form>
                </div>
            </div>
            <form id="form" method="POST">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-1">學號</th>
                            <th class="col-md-1">姓名</th>
                            <th class="col-md-2">科目</th>
                            <th class="col-md-1">成績</th>
                            <th class="col-md-1">註冊時間</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ()
                        <tr>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                            <td class="text-center">{{}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
        <!-- /.panel -->
    </div>
</div>