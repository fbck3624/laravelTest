<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>歡迎</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.0.min.js"></script>
    <!-- Moment.js v2.20.0 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.0/moment.min.js"></script>
    <!-- FullCalendar v3.8.1 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.print.css" rel="stylesheet"
        media="print">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.js"></script>
</head>

<body>
    <div id="example"></div>
    <script>
        $("#example").fullCalendar({
            // 參數設定[註1]
            header: { // 頂部排版
                left: "prev,next today", // 左邊放置上一頁、下一頁和今天
                center: "title", // 中間放置標題
                right: "month,basicWeek,basicDay" // 右邊放置月、周、天
            },
            defaultDate: "2018-02-12", // 起始日期
            weekends: true, // 顯示星期六跟星期日
            editable: true, // 啟動拖曳調整日期
            events: [ // 事件
                { // 事件
                    title: "約會",
                    start: "2018-02-01"
                },
                { // 事件(包含開始時間)
                    title: "中餐",
                    start: "2018-02-12T12:00:00"
                },
                { // 事件(包含跨日開始時間、結束時間)
                    title: "音樂節",
                    start: "2018-02-07",
                    end: "2018-02-10"
                },
                { // 事件(包含開始時間、結束時間)
                    title: "會議",
                    start: "2018-02-12T10:30:00",
                    end: "2018-02-12T12:30:00"
                },
                { // 事件(設定連結)
                    title: "Click for Google",
                    url: "http://google.com/",
                    start: "2018-02-28"
                }
            ]
        });
    </script>
</body>

</html>
