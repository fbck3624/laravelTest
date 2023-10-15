<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>歡迎</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href={{ asset('css/group.css') }}>
</head>

<body>
    <div class='mycontainer'>
        <div class="btn">
            <div class="btn-box"></div>
            <div type="button" class="button" id="add" data-target="#myModal" data-toggle="modal">添加</div>
            <div type="button" class="button" id="delete">刪除</div>
        </div>
        <div class="row">
            <div class="col custom-table-width">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">選取</th>
                            <th scope="col">編輯</th>
                            <th scope="col">名稱</th>
                            <th scope="col">描述</th>
                            <th scope="col">人數</th>
                            <th scope="col">建立者</th>
                            <th scope="col">建立時間</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="page">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id="out-page">
                </ul>
            </nav>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">新增團體</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="add-liver">
                            <div class="add-pic">
                                <div class="box"></div>
                                <div class="plus-outer">
                                    <div class="plus-box">
                                        <label class="mybtn">
                                            <input id="upload_img" style="display:none;" type="file"
                                                accept=".jpg,.png,.jpeg,.gif" onchange="readURL(this);">
                                            <i type="button" class="fa-solid fa-circle-plus" id="plus"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="box"></div>
                            </div>
                            <div class="form">
                                <div class="outer">
                                    <div class="question">名稱</div>
                                    <input type="text" size="48" id="name">
                                </div>
                                <div class="outer-descript">
                                    <div class="question">描述</div>
                                    <textarea rows="4" cols="50" id="descript"></textarea>
                                </div>
                                <div type="button" class="submit" id="submit" data-dismiss="modal">提交</div>
                                <div type="button" class="submit" id="update-submit" data-dismiss="modal">提交</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/group.js') }}"></script>
</body>

</html>
