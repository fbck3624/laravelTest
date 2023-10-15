$('#update-submit').hide();
let page = 1;
let data = [];
let updateId = null;
let group = [];
function getApi() {
    $("tbody").remove();
    $("option").remove();
    const params = {
        per_page: 5,
        page: page,
    };
    axios.get("http://127.0.0.1:8000/api/member", { params }).then((res) => {
        data = res;
        let event = new Event('apiDataReady');
        document.dispatchEvent(event);
    });
    $("#name").val("");
    $("#descript").val("");
    $("#birth").val("");
    $("#color").val("");
    $(".add-pic").css({
        'background-image': 'none',
    });
    $('#update-submit').hide();
    $('#submit').show();
}
getApi();

$('.close').click(function (e) {
    console.log(1);
    $('.member-box-container').show();
    $('#update').hide();
    $('.descript').remove();
    $('#add').show();
    $("#name").val("");
    $("#descript").val("");
    $("#birth").val("");
    $("#color").val("");
    $("#group").val("");
    $(".add-pic").css({
        'background-image': 'none',
    });
    getApi();
});

$('.submit').click(function (e) {
    let name = $("#name").val() || "";
    let descript = $("#descript").val() || "";
    let birth = $("input[name='birth']").val() || "";
    let color = $("#color").val() || "";
    let group = $("#group").val() || "";
    let active = $("input[name='active']").val() || "";
    let fileInput = $("#upload_img")[0].files[0] || null;
    if (e.target.id === 'update-submit') {
        let updateData = {
            name: name,
            descript: descript,
            birthday: birth,
            color: color,
            group: group,
            active: active,
            photo: fileInput
        };
        axios.put('http://127.0.0.1:8000/api/member/' + updateId, JSON.stringify(updateData))
            .then(function (response) {
                // 重新讀取
                getApi();
            })
            .catch(function (error) {
                console.error('失敗', error);
            });
    } else {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("descript", descript);
        formData.append("photo", fileInput);
        formData.append("birthday", birth);
        formData.append("color", color);
        formData.append("group", group);
        formData.append("active", active);

        axios.post('http://127.0.0.1:8000/api/member', formData)
            .then(function (response) {
                // 重新讀取
                getApi();
            })
            .catch(function (error) {
                console.error('失敗', error);
            });
    }
});
$("#delete").click(function (e) {
    let checkbox = $("input[type='checkbox']:checked");
    let checkedList = [];

    checkbox.each(function () {
        const id = $(this).attr('id'); // 使用 .attr('id') 来获取 id 属性
        checkedList.push(id); // 使用 .push() 来添加 id 到数组中
    });

    // 刪除
    axios.delete(`http://127.0.0.1:8000/api/member/${checkedList}`)
        .then(function (response) {
            console.log('成功', response);
            // 重新讀取
            getApi();

        })
        .catch(function (error) {
            console.error('失敗', error);
        });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            url = e.target.result;
            let newBackgroundImage = `url("${url}")`;

            $(".add-pic").css({
                'background-image': newBackgroundImage,
                'background-repeat': 'no-repeat',
                'background-size': 'cover'
            });
        }
        reader.readAsDataURL(input.files[0]);
    }
}
document.addEventListener('apiDataReady', function () {
    axios.get("http://127.0.0.1:8000/api/group").then((res) => {
        group = res;
        $('select').append("<option value=''>請選擇所屬團體</option>");
        group["data"].forEach((element) => {
            $('select').append(`<option value=${element['id']}>${element['name']}</option>`);
        });
    });
    $('li').remove();
    let totalPage = Math.ceil(data['data']['total'] / data['data']['per_page']);
    $('.pagination').append("<li class='page-item' id='page-p'><button class='page-link' tabindex='-1' id='previous'>Previous</button></li>");
    $('.pagination').append("<li class='page-item' id='page-n'><button class='page-link' id='next' >Next</button></li>");
    for (let i = 1; i <= totalPage; i++) {
        if (i === 1) {
            $("#page-p").after(`<li class='page-item'><button class='page-link' id=${i}>${i}</button></li>`);
        } else {
            $("#page-n").before(`<li class='page-item'><button class='page-link' id=${i}>${i}</button></li>`);
        }
    }
    setDissabled(totalPage);
    $("table").append("<tbody>");
    data["data"]["data"].forEach((element) => {
        $("tbody").append("<tr>");
        $("tbody").append(
            `<th scope='row'><input type='checkbox' id=${element["id"]}></th>`
        );
        $("tbody").append(
            `<td><i type='button' class='fa-solid fa-pen' id=${element["id"]}></i></td>`
        );
        $("tbody").append(`<td>${element["name"]}</td>`);
        $("tbody").append(`<td>${element["member_relation"]["group"]["name"]}</td>`);
        if (element['active'] === 1) {
            $("tbody").append("<td>活動中</td>");
        } else {
            $("tbody").append("<td>停止活動</td>");
        }
        $("tbody").append(`<td>${element["created_by"]}</td>`);
        $("tbody").append(`<td>${element["created_at"]}</td>`);
        $("tbody").append("</tr>");
    });

    // 分頁點擊
    $(".page-link").click(function (e) {
        if (e.target.id === 'previous') {
            page = parseInt(page) - 1;
        } else if (e.target.id === 'next') {
            page = parseInt(page) + 1;
        } else {
            page = e.target.id;
        }
        setDissabled(totalPage);
        getApi();
    });

    $(".fa-pen").click(function (e) {
        updateId = e.target.id;
        // 取得單筆
        axios.get(`http://127.0.0.1:8000/api/member/${updateId}`)
            .then(function (response) {
                data = response.data;
                console.log(data.birthday);
                let newBackgroundImage = `url("${data.photo}")`;
                $("#name").val(data.name);
                $("#descript").val(data.descript);
                $("#birth").val(data.birthday);
                $("#color").val(data.color);
                $("#group").val(data.member_relation.group_id);
                $(`#active${data.active}`).prop("checked", true);
                $(".add-pic").css({
                    'background-image': newBackgroundImage,
                    'background-repeat': 'no-repeat',
                    'background-size': 'cover'
                });
                $('#myModal').modal('show');
                $('#submit').hide();
                $('#update-submit').show();

            })
            .catch(function (error) {
                console.error('失敗', error);
            });
    });
});
function setDissabled(totalPage) {
    if (page == 1) {
        $('#page-p').addClass('disabled');
        $('#page-n').removeClass('disabled');
    } else if (page == totalPage) {
        $('#page-n').addClass('disabled');
        $('#page-p').removeClass('disabled');
    }
}
