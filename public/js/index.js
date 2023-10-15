// $('.liver').click(function (e) {
//     $('.member-box-container').hide();
//     $('#update').show();
//     $('#add').hide();
//     $('.modal-body').append("<div class='descript'></div>");
//     $('.descript').css({
//         'width': '100%',
//         'height': '100%',
//         'display': 'flex',
//     });
//     $('.descript').append("<div class='photo'></div>");
//     $('.photo').css({
//         'width': '30%',
//         'height': '100%',
//         'display': 'flex',
//         'background-image': "url('https://firebasestorage.googleapis.com/v0/b/test2-fbf84.appspot.com/o/liver%2Fvox.jpg?alt=media&token=bff306b2-c244-4203-8e89-41f1b7b05923')",
//         'background-size': 'cover',
//         'background-position-x': 'center',
//     });
//     $('.descript').append("<div class='intro'></div>");
//     $('.intro').css({
//         'width': '70%',
//         'height': '100%',
//         'display': 'block',
//         'background-color': '#F5F5F5',
//     });
//     $('.intro').append("<div class='name'>Vox Akuma</div>");
//     $('.name').after("<div class='about'></div>");
//     $('.about').css({
//         'width': '100%',
//         'height': '80%',
//         'margin-top': '5%',
//         'background-color': 'gray',
//     });
// });

$('.close').click(function (e) {
    $(".member-box-container").show();
    getApi();
});
function getApi() {
    $(".add-liver").hide();
    $(".logo").empty();
    $(".member-box-container").empty();
    axios.get("http://127.0.0.1:8000/api/group").then((res) => {
        count = 1;
        res["data"].forEach(function (data, index) {
            if (index % 4 === 0) {
                $(".logo").append(`<div class='pic${count}' id = 'pic'></div>`);
                count++;
            }
            $(`.pic${count - 1}`).append(`<div class='img' data-target="#myModal" data-toggle="modal" id= ${data['id']}
                style="background-image:url('${data['logo']}')">
            </div>`);
        });
        let event = new Event('apiDataReady');
        document.dispatchEvent(event);
    });
}
getApi();
document.addEventListener('apiDataReady', function () {
    $(".img").click(function (e) {
        groupId = e.target.id;
        const params = {
            group: [groupId],
        };
        // 取得團體成員
        axios.get(`http://127.0.0.1:8000/api/member`, { params })
            .then(function (response) {
                data = response.data;
                console.log(data['data']);
                $("h4").text(data['data'][0]['member_relation']['group']['name']);
                data["data"].forEach(function (data) {
                    $(".member-box-container").append(`<div class='liver' id=${data['id']}
                style="background-image:url(${data['photo']})">
            </div>`);
                });
                $('.liver').click(function (e) {
                    id = e.target.id;
                    axios.get(`http://127.0.0.1:8000/api/member/${id}`)
                        .then(function (response) {
                            data = response.data;
                            console.log(data);
                            $(".add-liver").show();
                            $(".member-box-container").hide();
                            $(".add-pic").css({
                                'background-image': `url("${data['photo']}")`,
                                'background-repeat': 'no-repeat',
                                'background-size': 'cover'
                            });
                            $(".name").text(data['name']);
                            $(".name").css({
                                'color': data['color'],
                            });
                        })
                        .catch(function (error) {
                            console.error('失敗', error);
                        });
                });
            })
            .catch(function (error) {
                console.error('失敗', error);
            });

    });
});

