// Connect to MySQL database
<?php
$conn = mysqli_connect("localhost", "username", "password", "job_portal");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve job and user behavior data
$jobs_query = "SELECT id_jobpost, jobtitle, description FROM job_post";
$users_query = "SELECT id_user, job_id, rating FROM user_job_ratings";

$jobs_result = mysqli_query($conn, $jobs_query);
$users_result = mysqli_query($conn, $users_query);

// Create user profiles
$user_profiles = array();
while ($row = mysqli_fetch_assoc($users_result)) {
    $user_id = $row["user_id"];
    $job_id = $row["job_id"];
    $rating = $row["rating"];
    
    if (!isset($user_profiles[$user_id])) {
        $user_profiles[$user_id] = array();
    }
    $user_profiles[$user_id][$job_id] = $rating;
}

// Compute similarity scores
$similarities = array();
foreach ($user_profiles as $user1 => $ratings1) {
    foreach ($user_profiles as $user2 => $ratings2) {
        if ($user1 != $user2){
            $similarity = pearson_correlation($ratings1, $ratings2);
            $similarities[$user1][$user2] = $similarity;
        }
    }
}

// Recommend jobs
$user_id = 1; // Example user ID
$recommendations = array();
foreach ($jobs_result as $job) {
    $job_id = $job["job_id"];
    $job_title = $job["job_title"];
    $job_description = $job["job_description"];
    
    // Compute weighted average of ratings from similar users
    $weighted_sum = 0;
    $weight_sum = 0;
    foreach ($similarities[$user_id] as $user => $similarity) {
        if ($similarity > 0) {
            if (isset($user_profiles[$user][$job_id])) {
                $rating = $user_profiles[$user][$job_id];
                $weighted_sum += $similarity * $rating;
                $weight_sum += $similarity;
            }
        }
    }
    $score = $weighted_sum / $weight_sum;
    
    // Add job to recommendations list
    $recommendations[] = array("job_id" => $job_id, "job_title" => $job_title, "job_description" => $job_description, "score" => $score);
}

// Sort recommendations by score
usort($recommendations, function($a, $b) {
    return $b["score"] - $a["score"];
});

// Display top 5 recommendations
foreach (array_slice($recommendations, 0, 5) as $recommendation) {
    echo $recommendation["job_title"] . " - " . $recommendation["job_description"] . " (score: " . $recommendation["score"] . ")<br>";
}

// Close MySQL connection
mysqli_close($conn);

// Pearson correlation coefficient function
function pearson_correlation($ratings1, $ratings2) {
    $sum1 = 0; $sum2 = 0; $sum1Sq = 0; $sum2Sq = 0; $pSum = 0; $n = 0;
    foreach ($ratings1 as $key => $rating1) {
        if (isset($ratings2[$key])) {
            $rating2 = $ratings2[$key];
            $sum1 += $rating1;
            $sum2 += $rating2;
            $sum1Sq += pow($rating1, 2);
            $sum2Sq += pow($rating2, 2);
            $pSum += $rating1 * $rating2;
            $n += 1;
        }
    }
    if ($n == 0) {
        return 0;
    }
    $num = $pSum - ($sum1 * $sum2 / $n);
    $den = sqrt(($sum1SqApologies, it seems that the code I posted earlier got truncated. Here's the complete code for implementing collaborative filtering in PHP using the Pearson correlation coefficient:

