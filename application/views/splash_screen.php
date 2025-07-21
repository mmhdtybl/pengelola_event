<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang!</title>
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Prevent scrollbars during animation */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #000000ff; /* Light background */
            font-family: Arial, sans-serif;
            flex-direction: column; /* For title below logo */
        }
        .splash-container {
            text-align: center;
            opacity: 0; /* Start hidden */
            transform: scale(0.8); /* Start slightly smaller */
            animation: fadeInZoom 2s forwards ease-out; /* Animation effect */
        }
        .splash-logo {
            width: 150px; /* Adjust logo size as needed */
            height: 150px;
            object-fit: contain;
            /* Optional: Add a subtle shadow */
            box-shadow: 0px 4px 10px rgba(33, 103, 160, 0.1);/
            border-radius: 15px; /* If your logo is square/rectangular */
            margin-top: 60px; /* Tambahkan jarak ke bawah */
        }
        .splash-title {
            margin-top: 20px;
            font-size: 2em;
            color: #333;
            opacity: 0;
            animation: fadeIn 1.5s forwards ease-out 1s; /* Delayed fade in for title */
        }
        .loading-text {
            margin-top: 30px;
            font-size: 1.1em;
            color: #666;
            opacity: 0;
            animation: fadeIn 1.5s forwards ease-out 1.5s; /* Delayed fade in for loading text */
        }
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db; /* Blue color */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin-top: 20px;
            opacity: 0;
            animation: fadeIn 1.5s forwards ease-out 2s;
        }

        @keyframes fadeInZoom {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="splash-container">
        <img src="<?php echo base_url('assets/img/logo_event.png'); ?>" alt="Logo Aplikasi" class="splash-logo">
        <h1 class="splash-title">Event Management</h1>
        <p class="loading-text">Memuat aplikasi...</p>
        <div class="loading-spinner"></div>
    </div>

    <script>
        // Durasi animasi (sesuaikan dengan total durasi animasi CSS Anda + sedikit tambahan)
        const animationDuration = 5000; // 4 detik (2s fadeInZoom + 1s delay + 1.5s fadeIn untuk spinner, ambil yang terlama)
        const redirectUrl = "<?php echo base_url('auth/login'); ?>"; // URL halaman login Anda

        setTimeout(() => {
            window.location.href = redirectUrl;
        }, animationDuration);
    </script>
</body>
</html>