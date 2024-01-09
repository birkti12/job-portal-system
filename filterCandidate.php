

<?php
// ...
session_start();
require_once("../db.php");
// Display previous preferences and matching job posts in a table
if ($result->num_rows > 0) {
    // Create an array to store the matched users
    $matchedUsers = array();

    while ($row = $result->fetch_assoc()) {
        $jobtitle = $row["jobtitle"];
        $city = $row["city"];

        // Modify the query to filter by job title and city
        $job_post_sql = "SELECT jp.jobtitle, jp.city, u.qualification
            FROM job_post jp
            INNER JOIN company c ON jp.id_company = c.id_company
            INNER JOIN users u ON c.id_user = u.id_user
            WHERE jp.jobtitle LIKE '%$jobtitle%' AND jp.city = '$city'";
        $job_post_result = $conn->query($job_post_sql);

        if ($job_post_result->num_rows > 0) {
            while ($job_post_row = $job_post_result->fetch_assoc()) {
                $matchedUsers[] = array(
                    'jobtitle' => $job_post_row['jobtitle'],
                    'city' => $job_post_row['city'],
                    'qualification' => $job_post_row['qualification']
                );
            }
        }
    }

    // Sort the matched users based on qualification (in descending order)
    usort($matchedUsers, function ($a, $b) {
        $qualifications = array('PhD', 'MSc', 'BSc', 'Diploma');
        $qualificationA = array_search($a['qualification'], $qualifications);
        $qualificationB = array_search($b['qualification'], $qualifications);
        return $qualificationB - $qualificationA;
    });

    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Matching Job Posts</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <style>
            body {
                padding: 20px;
            }
            table {
                width: 100%;
            }
            th, td {
                padding: 10px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h2>Matching Job Posts</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Job Title</th>
                    <th>City</th>
                    <th>Qualification</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($matchedUsers as $user) {
        echo '<tr>
                <td>' . $user['jobtitle'] . '</td>
                <td>' . $user['city'] . '</td>
                <td>' . $user['qualification'] . '</td>
              </tr>';
    }

    echo '</tbody>
        </table>
    </body>
    </html>';
} else {
    echo "No match preferences found.";
}

// ...
?>