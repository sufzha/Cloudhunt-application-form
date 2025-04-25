<?php
// --- Initialize message variables ---
$successMessage = "";
$errorMessage = "";

// --- Process form only if it's a POST request ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Database Configuration ---
    $servername = "localhost"; // Usually 'localhost' for XAMPP
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password is empty
    $dbname = "cloudhunt_db"; // Your database name

    // --- Create Connection ---
    $conn = new mysqli($servername, $username, $password, $dbname);

    // --- Check Connection ---
    if ($conn->connect_error) {
        // Set error message instead of dying immediately
        $errorMessage = "Database Connection Failed: " . $conn->connect_error;
        // In a real application, you might want to log this error instead of showing details
    } else {
        // --- Get data from the form ---
        // Using null coalescing operator (??) as a basic safety net if a field isn't set
        $teamName = $_POST['teamName'] ?? '';
        $state = $_POST['state'] ?? '';
        $challenge = $_POST['challenge'] ?? '';

        $member1Name = $_POST['member1Name'] ?? '';
        $member1Email = $_POST['member1Email'] ?? '';
        $member1Mobile = $_POST['member1Mobile'] ?? '';
        $member1Status = $_POST['member1Status'] ?? '';
        $member1FieldOfStudy = $_POST['member1FieldOfStudy'] ?? '';
        $member1Institution = $_POST['member1Institution'] ?? '';

        $member2Name = $_POST['member2Name'] ?? '';
        $member2Email = $_POST['member2Email'] ?? '';
        $member2Mobile = $_POST['member2Mobile'] ?? '';
        $member2Status = $_POST['member2Status'] ?? '';
        $member2FieldOfStudy = $_POST['member2FieldOfStudy'] ?? '';
        $member2Institution = $_POST['member2Institution'] ?? '';

        $member3Name = $_POST['member3Name'] ?? '';
        $member3Email = $_POST['member3Email'] ?? '';
        $member3Mobile = $_POST['member3Mobile'] ?? '';
        $member3Status = $_POST['member3Status'] ?? '';
        $member3FieldOfStudy = $_POST['member3FieldOfStudy'] ?? '';
        $member3Institution = $_POST['member3Institution'] ?? '';

        $member4Name = $_POST['member4Name'] ?? '';
        $member4Email = $_POST['member4Email'] ?? '';
        $member4Mobile = $_POST['member4Mobile'] ?? '';
        $member4Status = $_POST['member4Status'] ?? '';
        $member4FieldOfStudy = $_POST['member4FieldOfStudy'] ?? '';
        $member4Institution = $_POST['member4Institution'] ?? '';

        $member5Name = $_POST['member5Name'] ?? '';
        $member5Email = $_POST['member5Email'] ?? '';
        $member5Mobile = $_POST['member5Mobile'] ?? '';
        $member5Status = $_POST['member5Status'] ?? '';
        $member5FieldOfStudy = $_POST['member5FieldOfStudy'] ?? '';
        $member5Institution = $_POST['member5Institution'] ?? '';

        $teamIntroduction = $_POST['teamIntroduction'] ?? '';
        $howDidYouFindUs = $_POST['howDidYouFindUs'] ?? '';

        // --- Basic Validation (Check if required fields are empty) ---
        // Note: HTML 'required' attribute provides client-side validation,
        // but server-side validation is still important.
        if (empty($teamName) || empty($state) || empty($challenge) ||
            empty($member1Name) || empty($member1Email) || /* ... add all other required fields ... */
            empty($member5Institution) || empty($teamIntroduction) || empty($howDidYouFindUs))
        {
            $errorMessage = "Please fill in all required fields.";
        } else {
            // --- Prepare SQL Statement (Use Prepared Statements for Security) ---
            $sql = "INSERT INTO applications (
                        teamName, state, challenge,
                        member1Name, member1Email, member1Mobile, member1Status, member1FieldOfStudy, member1Institution,
                        member2Name, member2Email, member2Mobile, member2Status, member2FieldOfStudy, member2Institution,
                        member3Name, member3Email, member3Mobile, member3Status, member3FieldOfStudy, member3Institution,
                        member4Name, member4Email, member4Mobile, member4Status, member4FieldOfStudy, member4Institution,
                        member5Name, member5Email, member5Mobile, member5Status, member5FieldOfStudy, member5Institution,
                        teamIntroduction, howDidYouFindUs
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                // Error preparing statement
                $errorMessage = "Error preparing statement: " . htmlspecialchars($conn->error);
            } else {
                // --- Bind Parameters to Statement ---
                // 's' means string type. We have 35 parameters.
                $stmt->bind_param(
                    "sssssssssssssssssssssssssssssssssss", // 35 's'
                    $teamName, $state, $challenge,
                    $member1Name, $member1Email, $member1Mobile, $member1Status, $member1FieldOfStudy, $member1Institution,
                    $member2Name, $member2Email, $member2Mobile, $member2Status, $member2FieldOfStudy, $member2Institution,
                    $member3Name, $member3Email, $member3Mobile, $member3Status, $member3FieldOfStudy, $member3Institution,
                    $member4Name, $member4Email, $member4Mobile, $member4Status, $member4FieldOfStudy, $member4Institution,
                    $member5Name, $member5Email, $member5Mobile, $member5Status, $member5FieldOfStudy, $member5Institution,
                    $teamIntroduction, $howDidYouFindUs
                );

                // --- Execute Statement ---
                if ($stmt->execute()) {
                    // Success
                    $successMessage = "Application Submitted Successfully! Thank you for registering for Cloudhunt IKM Besut x Runcloud 2025.";
                    // Optionally clear POST data to prevent resubmission on refresh, though redirect is better
                    // $_POST = array();
                } else {
                    // Failure
                    $errorMessage = "Error Submitting Application: " . htmlspecialchars($stmt->error);
                }

                // --- Close Statement ---
                $stmt->close();
            }
        }
        // --- Close Connection ---
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloudhunt IKM Besut x Runcloud 2025</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom CSS for the animated background */
        .gradient-bg {
            background: linear-gradient(45deg, #6b7280, #374151, #1f2937); /* Shades of gray */
            background-size: 300% 300%;
            animation: animateBackground 10s ease infinite;
        }
        @keyframes animateBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Styles for messages */
        .message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.375rem; /* rounded-md */
            font-weight: bold;
        }
        .message-success {
            background-color: #d1fae5; /* green-100 */
            border: 1px solid #6ee7b7; /* green-300 */
            color: #065f46; /* green-800 */
        }
        .message-error {
            background-color: #fee2e2; /* red-100 */
            border: 1px solid #fca5a5; /* red-300 */
            color: #991b1b; /* red-800 */
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center py-10">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-2xl">

        <?php if (!empty($successMessage)): ?>
            <div class="message message-success text-center">
                <?php echo $successMessage; ?>
                 <p><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class='mt-2 inline-block text-indigo-600 hover:text-indigo-800'>Submit another application</a></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="message message-error">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Only show the form if submission wasn't successful OR if it's the initial GET request -->
        <?php if (empty($successMessage)): ?>
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 text-center">Cloudhunt IKM Besut x Runcloud 2025</h1>
                <p class="text-gray-600 text-center">25 April, 8:00 pm - 27 April, 5:00 pm</p>
                 <div class="mt-4">
                    <!-- Make sure the images folder is in the same directory as this PHP file -->
                    <img src="images.jpg" alt="OUR POSTER" class="w-full rounded-md">
                </div>
            </div>

            <!-- Form posts data to the same file -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                <div>
                    <label for="teamName" class="block text-gray-700 text-sm font-bold mb-2">Team Name:</label>
                    <input type="text" id="teamName" name="teamName" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div>
                    <label for="state" class="block text-gray-700 text-sm font-bold mb-2">Your State:</label>
                    <select id="state" name="state" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select your state</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Putrajaya">Putrajaya</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </select>
                </div>

                <div>
                    <label for="challenge" class="block text-gray-700 text-sm font-bold mb-2">Your Selected Challenge:</label>
                    <select id="challenge" name="challenge" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select a challenge</option>
                        <option value="Challenge 1">Challenge 1</option>
                        <option value="Challenge 2">Challenge 2</option>
                        <option value="Challenge 3">Challenge 3</option>
                    </select>
                </div>

                <!-- Team Member 1 -->
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Team Member 1</h2>
                <div>
                    <label for="member1Name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                    <input type="text" id="member1Name" name="member1Name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member1Email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                    <input type="email" id="member1Email" name="member1Email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member1Mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile Number:</label>
                    <input type="tel" id="member1Mobile" name="member1Mobile" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member1Status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                    <select id="member1Status" name="member1Status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select status</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                        <option value="unemployed_fresh_graduate">Unemployed Fresh Graduate</option>
                    </select>
                </div>
                <div>
                    <label for="member1FieldOfStudy" class="block text-gray-700 text-sm font-bold mb-2">Field of Study:</label>
                    <input type="text" id="member1FieldOfStudy" name="member1FieldOfStudy" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member1Institution" class="block text-gray-700 text-sm font-bold mb-2">Educational Institution:</label>
                    <input type="text" id="member1Institution" name="member1Institution" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Team Member 2 -->
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Team Member 2</h2>
                <div>
                    <label for="member2Name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                    <input type="text" id="member2Name" name="member2Name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                 <div>
                    <label for="member2Email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                    <input type="email" id="member2Email" name="member2Email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member2Mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile Number:</label>
                    <input type="tel" id="member2Mobile" name="member2Mobile" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member2Status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                    <select id="member2Status" name="member2Status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select status</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                        <option value="unemployed_fresh_graduate">Unemployed Fresh Graduate</option>
                    </select>
                </div>
                <div>
                    <label for="member2FieldOfStudy" class="block text-gray-700 text-sm font-bold mb-2">Field of Study:</label>
                    <input type="text" id="member2FieldOfStudy" name="member2FieldOfStudy" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member2Institution" class="block text-gray-700 text-sm font-bold mb-2">Educational Institution:</label>
                    <input type="text" id="member2Institution" name="member2Institution" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>


                <!-- Team Member 3 -->
                 <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Team Member 3</h2>
                <div>
                    <label for="member3Name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                    <input type="text" id="member3Name" name="member3Name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                 <div>
                    <label for="member3Email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                    <input type="email" id="member3Email" name="member3Email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member3Mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile Number:</label>
                    <input type="tel" id="member3Mobile" name="member3Mobile" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member3Status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                    <select id="member3Status" name="member3Status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select status</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                        <option value="unemployed_fresh_graduate">Unemployed Fresh Graduate</option>
                    </select>
                </div>
                <div>
                    <label for="member3FieldOfStudy" class="block text-gray-700 text-sm font-bold mb-2">Field of Study:</label>
                    <input type="text" id="member3FieldOfStudy" name="member3FieldOfStudy" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member3Institution" class="block text-gray-700 text-sm font-bold mb-2">Educational Institution:</label>
                    <input type="text" id="member3Institution" name="member3Institution" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>


                <!-- Team Member 4 -->
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Team Member 4</h2>
                <div>
                    <label for="member4Name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                    <input type="text" id="member4Name" name="member4Name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                 <div>
                    <label for="member4Email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                    <input type="email" id="member4Email" name="member4Email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member4Mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile Number:</label>
                    <input type="tel" id="member4Mobile" name="member4Mobile" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member4Status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                    <select id="member4Status" name="member4Status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select status</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                        <option value="unemployed_fresh_graduate">Unemployed Fresh Graduate</option>
                    </select>
                </div>
                <div>
                    <label for="member4FieldOfStudy" class="block text-gray-700 text-sm font-bold mb-2">Field of Study:</label>
                    <input type="text" id="member4FieldOfStudy" name="member4FieldOfStudy" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member4Institution" class="block text-gray-700 text-sm font-bold mb-2">Educational Institution:</label>
                    <input type="text" id="member4Institution" name="member4Institution" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>


                <!-- Team Member 5 -->
                 <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Team Member 5</h2>
                <div>
                    <label for="member5Name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                    <input type="text" id="member5Name" name="member5Name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                 <div>
                    <label for="member5Email" class="block text-gray-700 text-sm font-bold mb-2">Email Address:</label>
                    <input type="email" id="member5Email" name="member5Email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member5Mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile Number:</label>
                    <input type="tel" id="member5Mobile" name="member5Mobile" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member5Status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                    <select id="member5Status" name="member5Status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select status</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                        <option value="unemployed_fresh_graduate">Unemployed Fresh Graduate</option>
                    </select>
                </div>
                <div>
                    <label for="member5FieldOfStudy" class="block text-gray-700 text-sm font-bold mb-2">Field of Study:</label>
                    <input type="text" id="member5FieldOfStudy" name="member5FieldOfStudy" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="member5Institution" class="block text-gray-700 text-sm font-bold mb-2">Educational Institution:</label>
                    <input type="text" id="member5Institution" name="member5Institution" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>


                <!-- Team Introduction & How Find Us -->
                <div class="mt-6">
                    <label for="teamIntroduction" class="block text-gray-700 text-sm font-bold mb-2">Please introduce your team and why you want to join this hackathon (in less than 50 words):</label>
                    <textarea id="teamIntroduction" name="teamIntroduction" rows="4" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>

                <div>
                    <label for="howDidYouFindUs" class="block text-gray-700 text-sm font-bold mb-2">How did you find us:</label>
                    <input type="text" id="howDidYouFindUs" name="howDidYouFindUs" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Submit Application
                </button>
            </form>
        <?php endif; ?> <!-- End conditional form display -->

    </div>
</body>
</html>