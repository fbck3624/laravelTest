<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>歡迎</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-zh_CN.min.js"></script>
    <link rel="stylesheet" href={{ asset('css/member.css') }}>
</head>

<body>
    <div class='mycontainer'>
        <div class="search">
            <input type="search" id="search-text" placeholder="名稱搜尋">
        </div>
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
                            <th scope="col">所屬團體</th>
                            <th scope="col">活動狀況</th>
                            <th scope="col">建立者</th>
                            <th scope="col">建立時間</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="page">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">新增人員</h4>
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
                                    <div class="question">姓名：</div>
                                    <input type="text" id="name">
                                </div>
                                <div class="outer">
                                    <div class="question">生日：</div>
                                    <input type="date" name="birth" id="birth">
                                </div>
                                <div class="outer">
                                    <div class="question">代表色：</div>
                                    <input type="text" id="color">
                                </div>
                                <div class="outer">
                                    <div class="question">所屬團體：</div>
                                    <select name="group" id="group">
                                    </select>
                                </div>
                                <div class="outer">
                                    <div class="question">活動狀況：</div>
                                    <input type="radio" name="active" id="active1" value="1">
                                    <p>活動中</p>
                                    <input type="radio" name="active" id="active0" value="0">
                                    <p>停止活動</p>
                                </div>
                                <div class="outer-descript">
                                    <div class="question">描述：</div>
                                    <textarea rows="4" cols="50" id="descript"></textarea>
                                </div>
                                <div type="button" class="submit" id="submit" data-dismiss="modal">提交</div>
                                <div type="button" class="submit" id="update-submit" data-dismiss="modal">提交
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/member.js') }}"></script>
</body>

</html>
