<!DOCTYPE html>
<html>
<head>
    <title>Job Portal User Documentation</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style>
        body {
            background-color: #f1f1f1;
            font-family: 'Open Sans', sans-serif; /* Use the desired font family here */
        }
        

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            color: #333333;
        }

        p {
            color: #555555;
        }

        .section {
            margin-bottom: 20px;
            padding-left: 20px;
            position: relative;
        }

        .section:before {
            content: "";
            position: absolute;
            top: 10px;
            left: 0;
            width: 6px;
            height: 6px;
            background-color: #4caf50;
            border-radius: 50%;
        }

        .video-container {
            position: relative;
            margin-bottom: 20px;
        }

        .video-controls {
            text-align: center;
            margin-top: 10px;
        }

        .video-controls button {
            margin: 0 10px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .video-controls button:hover {
            background-color: #45a049;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col {
            flex: 50%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section" id="create-account-section">
                    <h2>Create an Account</h2>
                    <p>To create an account on the job portal system, follow these steps:</p>
                    <ol>
                        <li>Go to the 'Sign Up' page.</li>
                        <li>Fill out the registration form with your personal information.</li>
                        <li>Choose a email and password for your account.</li>
                        <li>Click on the 'Register' button to create your account.</li>
                        <li>You can now log in using your email and password.</li>
                    </ol>
                </div>

                <div class="section" id="search-job-section">
                    <h2>Search for a Job</h2>
                    <p>To search for a job on the job portal system, follow these steps:</p>
                    <ol>
                        <li>Go to the 'Search Jobs' page.</li>
                        <li>Enter keywords related to the job you're looking for in the search bar.</li>
                        <li>Apply additional filters such as location, job type, or experience.</li>
                        <li>Click on the 'Search' button to see a list of matching job listings.</li>
                        <li>Review the job details and click on the job title to view more information.</li>
                    </ol>
                </div>
            </div>
            <div class="col">
                <div class="section" id="apply-job-section">
                    <h2>Apply for a Job</h2>
                    <p>To apply for a job on the job portal system, follow these steps:</p>
                    <ol>
                        <li>Find the job listing you're interested in from the search results or job details page.</li>
                        <li>Click on the job title to view the job details.</li>
                        <li>Read the job description and requirements carefully to ensure you meet the criteria.</li>
                        <li>Click on the 'Apply' button to send your application.</li>
                        <li>Your application will be sent to the employer for review.</li>
                    </ol>
                </div>

                <div class="section" id="view-notifications-section">
                    <h2>View Notifications</h2>
                    <p>To view your notifications on the job portal system, follow these steps:</p>
                    <ol>
                        <li>Go to the 'Notifications' section or page.</li>
                        <li>You will see a list of notifications related to your account and job applications.</li>
                        <li>Click on each notification to view more details or take necessary actions if required.</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="video-container">
            <video id="video-player" src="" width="400" height="300" controls>
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="video-controls">
            <button id="previous-btn">Previous</button>
            <button id="play-pause-btn">Play</button>
            <button id="next-btn">Next</button>
        </div>
    </div>

    <script>
        var videos = {
            "video1": "http://localhost/job-portal-master/user/help.php"
        };

        var currentVideoIndex = 0;
        var videoPlayer = document.getElementById('video-player');
        var playPauseBtn = document.getElementById('play-pause-btn');
        var previousBtn = document.getElementById('previous-btn');
        var nextBtn = document.getElementById('next-btn');

        function updateVideo() {
            var videoKeys = Object.keys(videos);
            if (currentVideoIndex >= 0 && currentVideoIndex < videoKeys.length) {
                var currentVideoKey = videoKeys[currentVideoIndex];
                videoPlayer.src = videos[currentVideoKey];
                videoPlayer.load();
                playPauseBtn.textContent = videoPlayer.paused ? 'Play' : 'Pause';
            }
        }

        playPauseBtn.addEventListener('click', function () {
            if (videoPlayer.paused) {
                videoPlayer.play();
                playPauseBtn.textContent = 'Pause';
            } else {
                videoPlayer.pause();
                playPauseBtn.textContent = 'Play';
            }
        });

        previousBtn.addEventListener('click', function () {
            currentVideoIndex = (currentVideoIndex - 1 + Object.keys(videos).length) % Object.keys(videos).length;
            updateVideo();
        });

        nextBtn.addEventListener('click', function () {
            currentVideoIndex = (currentVideoIndex + 1) % Object.keys(videos).length;
            updateVideo();
        });

        updateVideo();
    </script>
</body>
</html>
