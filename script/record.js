var video = document.getElementById("video-preview");
var startButton = document.getElementById("start-recording");
var stopButton = document.getElementById("stop-recording");

var recorder;

startButton.addEventListener("click", function () {
    navigator.mediaDevices
        .getUserMedia({
            video: true,
            audio: true,
        })
        .then(function (stream) {
            video.srcObject = stream;
            recorder = RecordRTC(stream, {
                type: "video",
            });
            recorder.startRecording();
            startButton.disabled = true;
            stopButton.disabled = false;
        })
        .catch(function (error) {
            console.error("getUserMedia error:", error);
        });
});

stopButton.addEventListener("click", function () {
    recorder.stopRecording(function () {
        var blob = recorder.getBlob();

        // สร้างชื่อไฟล์ด้วย athlete_id ตามด้วยวันที่และเวลา
        var programId = document.getElementById("select_program").value; // แทนค่าด้วย athlete_id ของคุณ
        var currentDate = new Date();
        var dateString = currentDate.toISOString().replace(/[:\-T.]/g, ""); // สร้างรูปแบบวันที่และเวลาที่เหมาะสำหรับใช้เป็นชื่อไฟล์
        var fileName = programId + "_" + dateString + ".webm";

        var formData = new FormData();
        formData.append("video", blob, fileName); // ใช้ชื่อไฟล์ที่สร้างขึ้นใน FormData

        // ทำการส่งข้อมูลไปยังเซิร์ฟเวอร์ของคุณ
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/save_video.php"); // แก้ไข URL เป็นตามที่ต้องการ
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("อัปโหลดสำเร็จ!");
            } else {
                console.error("ไม่สามารถอัปโหลดได้!");
            }
        };
        xhr.send(formData);

        video.srcObject = null;
        video.src = URL.createObjectURL(blob);
        startButton.disabled = false;
        stopButton.disabled = true;
    });
});

function playVideo(videoSrc) {
    var videoPlayer = document.getElementById("videoPlayer");
    videoPlayer.style.display = "block";
    videoPlayer.src = videoSrc;
    videoPlayer.play();

    // เรียกใช้ Bootstrap Modal โดยใช้ jQuery
    $("#modal_video").modal("show");
}

function deleteVideo() {
    Swal.fire({
        title: "ยืนยันการลบวิดีโอหรือไม่",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1c7348",
        cancelButtonColor: "#b72e3c",
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
        heightAuto: false,
    }).then((result) => {
        if (result.isConfirmed) {
            // ถ้ายืนยัน ส่งฟอร์มไปยัง backend/sql_delete.php
            let form = document.getElementById("form_delete_video");
            form.action = "backend/sql_delete.php";
            form.method = "POST";
            form.submit();
        }
    });
}
