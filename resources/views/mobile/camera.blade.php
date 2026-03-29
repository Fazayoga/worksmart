<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Kamera Absensi - WorkSmart</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <style>
        body {
            background-color: #000;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            font-family: 'Public Sans', sans-serif;
        }

        .camera-header {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 10;
        }

        #video-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: #000;
        }

        #video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scaleX(-1); /* Mirror effect for selfie */
        }

        #canvas {
            display: none;
        }

        .camera-controls {
            background: #fff;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 30px 30px 0 0;
            position: relative;
            z-index: 10;
        }

        .capture-btn {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #696cff;
            border: 5px solid #e7e7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(105, 108, 255, 0.4);
        }

        .capture-btn:active {
            transform: scale(0.95);
        }

        .btn-action-container {
            display: none;
            width: 100%;
            gap: 15px;
        }

        #preview-img {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            background: #000;
        }

        .face-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            height: 350px;
            border: 2px dashed rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            pointer-events: none;
            z-index: 6;
        }

        .timer-badge {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            z-index: 6;
        }
    </style>
</head>
<body>
    <div class="camera-header">
        <a href="{{ route('selfie-absen') }}" class="text-white">
            <i class='bx bx-chevron-left fs-1'></i>
        </a>
        <span class="fw-bold">{{ $type }}</span>
        <i class='bx bx-info-circle fs-3 opacity-0'></i> <!-- Spacer -->
    </div>

    <div id="video-container">
        <video id="video" autoplay playsinline></video>
        <img id="preview-img" alt="Preview">
        <div class="face-overlay" id="overlay"></div>
        <div class="timer-badge" id="current-time">00:00:00</div>
    </div>

    <div class="camera-controls">
        <div id="capture-ui" class="text-center">
            <button class="capture-btn mx-auto" id="capture-btn">
                <i class='bx bx-camera'></i>
            </button>
            <p class="mt-3 mb-0 text-muted small fw-bold">Ambil Foto Selfie</p>
        </div>

        <div id="action-ui" class="btn-action-container justify-content-center">
            <button class="btn btn-outline-secondary w-50 py-3 fw-bold" id="retake-btn" style="border-radius: 12px;">
                ULANGI
            </button>
            <button class="btn btn-primary w-50 py-3 fw-bold" id="submit-btn" style="border-radius: 12px;">
                KIRIM
            </button>
        </div>
    </div>

    <canvas id="canvas"></canvas>

    <form id="attendance-form" action="{{ route('mobile.camera.store') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="image" id="image-data">
        <input type="hidden" name="type" value="{{ $type }}">
    </form>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const previewImg = document.getElementById('preview-img');
        const captureBtn = document.getElementById('capture-btn');
        const retakeBtn = document.getElementById('retake-btn');
        const submitBtn = document.getElementById('submit-btn');
        const captureUI = document.getElementById('capture-ui');
        const actionUI = document.getElementById('action-ui');
        const imageDataInput = document.getElementById('image-data');
        const timeBadge = document.getElementById('current-time');
        const overlay = document.getElementById('overlay');

        // Update clock
        setInterval(() => {
            const now = new Date();
            timeBadge.textContent = now.getHours().toString().padStart(2, '0') + ':' + 
                                  now.getMinutes().toString().padStart(2, '0') + ':' + 
                                  now.getSeconds().toString().padStart(2, '0');
        }, 1000);

        // Access camera
        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: "user",
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }, 
                    audio: false 
                });
                video.srcObject = stream;
            } catch (err) {
                alert("Gagal mengakses kamera: " + err.message);
                window.location.href = "{{ route('selfie-absen') }}";
            }
        }

        startCamera();

        // Capture photo
        captureBtn.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            
            // Mirror flip the canvas as well
            context.translate(canvas.width, 0);
            context.scale(-1, 1);
            
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
            previewImg.src = dataUrl;
            imageDataInput.value = dataUrl;

            // UI Changes
            video.style.display = 'none';
            overlay.style.display = 'none';
            previewImg.style.display = 'block';
            captureUI.style.display = 'none';
            actionUI.style.display = 'flex';
        });

        // Retake
        retakeBtn.addEventListener('click', () => {
            video.style.display = 'block';
            overlay.style.display = 'block';
            previewImg.style.display = 'none';
            captureUI.style.display = 'block';
            actionUI.style.display = 'none';
        });

        // Submit
        submitBtn.addEventListener('click', () => {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> MENGIRIM...';
            document.getElementById('attendance-form').submit();
        });
    </script>
</body>
</html>
