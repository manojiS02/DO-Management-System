<?php
//// ========================
//// Database connection
//// ========================
//$host = "localhost";
//$user = "root";
//$pass = "apple123";
//$dbname = "education";
//
//$conn = new mysqli($host, $user, $pass, $dbname);
//
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//
//// ========================
//// Handle Form Submission
//// ========================
////if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
//    // Main Employee Data
////    $serial_number = $_POST['serial_number'];
//    $file_number = $_POST['file_number'];
//    $employee_name = $_POST['employee_name'];
//    $nic = $_POST['nic'];
//    $dob = $_POST['date_of_birth'];
//    $gender = $_POST['gender'];
//    $trainee_date = $_POST['date_of_trainee_training_appointment'];
//    $release_date = $_POST['date_of_release_from_divisional_secretariat'];
//    $appointment_date = $_POST['date_of_appointment'];
//    $assume_duties_date = $_POST['date_of_assuming_duties_in_zone'];
//    $eff_test_date = $_POST['date_of_passing_efficiency_test'];
//    $tamil_release_date = $_POST['date_of_tamil_release'];
//    $confirm_date = $_POST['date_of_appointment_confirmed'];
//
//    // Insert into Employees
//    $stmt = $conn->prepare("INSERT INTO Employees
//        (file_number, employee_name, nic, date_of_birth, gender,
//        date_of_trainee_training_appointment, date_of_release_from_divisional_secretariat,
//        date_of_appointment, date_of_assuming_duties_in_zone, date_of_passing_efficiency_test,
//        date_of_tamil_release, date_of_appointment_confirmed)
//        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
//    $stmt->bind_param("ssssssssssss", $file_number, $employee_name, $nic,
//        $dob, $gender, $trainee_date, $release_date, $appointment_date,
//        $assume_duties_date, $eff_test_date, $tamil_release_date, $confirm_date);
//    $stmt->execute();
//    $employee_id = $stmt->insert_id;
//
//    // Multi-value inserts
//    if (!empty($_POST['addresses'])) {
//        foreach ($_POST['addresses'] as $address) {
//            if ($address != "") {
//                $conn->query("INSERT INTO EmployeeAddresses (employee_id, address) VALUES ('$employee_id', '$address')");
//            }
//        }
//    }
//
//    if (!empty($_POST['phones'])) {
//        foreach ($_POST['phones'] as $phone) {
//            if ($phone != "") {
//                $conn->query("INSERT INTO EmployeeTelephones (employee_id, phone_number) VALUES ('$employee_id', '$phone')");
//            }
//        }
//    }
//
//    if (!empty($_POST['whatsapps'])) {
//        foreach ($_POST['whatsapps'] as $whatsapp) {
//            if ($whatsapp != "") {
//                $conn->query("INSERT INTO EmployeeWhatsApp (employee_id, whatsapp_number) VALUES ('$employee_id', '$whatsapp')");
//            }
//        }
//    }
//
//    if (!empty($_POST['school_name'])) {
//        foreach ($_POST['school_name'] as $index => $school) {
//            if ($school != "") {
//                $start = $_POST['school_start'][$index];
//                $end = $_POST['school_end'][$index];
//                $conn->query("INSERT INTO EmployeeSchoolAttachments (employee_id, school_name, start_date, end_date)
//                              VALUES ('$employee_id', '$school', '$start', '$end')");
//            }
//        }
//    }
//
//    if (!empty($_POST['attach_date'])) {
//        foreach ($_POST['attach_date'] as $index => $attach_date) {
//            if ($attach_date != "") {
//                $period = $_POST['attach_period'][$index];
//                $conn->query("INSERT INTO EmployeeAttachments (employee_id, date_of_attachment, period)
//                              VALUES ('$employee_id', '$attach_date', '$period')");
//            }
//        }
//    }
//
//    echo "<p style='color:green;'>Employee data saved successfully!</p>";
//    echo "<a href='../client/employee_form.html'>Back to Form</a>";
//}
//?>


<?php
// ========================
// Database connection
// ========================
$host = "localhost";
$user = "root";
$pass = "apple123";
$dbname = "education";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ========================
// Handle Form Submission
// ========================
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Main Employee Data
    $file_number = $_POST['file_number'];
    $employee_name = $_POST['employee_name'];
    $nic = $_POST['nic'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $trainee_date = $_POST['date_of_trainee_training_appointment'];
    $release_date = $_POST['date_of_release_from_divisional_secretariat'];
    $appointment_date = $_POST['date_of_appointment'];
    $assume_duties_date = $_POST['date_of_assuming_duties_in_zone'];
    $eff_test_date = $_POST['date_of_passing_efficiency_test'];
    $tamil_release_date = $_POST['date_of_tamil_release'];
    $confirm_date = $_POST['date_of_appointment_confirmed'];

    // ========================
    // Insert into Employees
    // ========================
    $stmt = $conn->prepare("INSERT INTO Employees
        (file_number, employee_name, nic, date_of_birth, gender,
        date_of_trainee_training_appointment, date_of_release_from_divisional_secretariat,
        date_of_appointment, date_of_assuming_duties_in_zone, date_of_passing_efficiency_test,
        date_of_tamil_release, date_of_appointment_confirmed)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssss", $file_number, $employee_name, $nic,
        $dob, $gender, $trainee_date, $release_date, $appointment_date,
        $assume_duties_date, $eff_test_date, $tamil_release_date, $confirm_date);
    $stmt->execute();

    // ========================
    // Multi-value inserts
    // ========================

    // Addresses
    if (!empty($_POST['addresses'])) {
        $addrStmt = $conn->prepare("INSERT INTO EmployeeAddresses (file_number, address) VALUES (?, ?)");
        foreach ($_POST['addresses'] as $address) {
            if ($address != "") {
                $addrStmt->bind_param("ss", $file_number, $address);
                $addrStmt->execute();
            }
        }
    }

    // Phone numbers
    if (!empty($_POST['phones'])) {
        $phoneStmt = $conn->prepare("INSERT INTO EmployeeTelephones (file_number, phone_number) VALUES (?, ?)");
        foreach ($_POST['phones'] as $phone) {
            if ($phone != "") {
                $phoneStmt->bind_param("ss", $file_number, $phone);
                $phoneStmt->execute();
            }
        }
    }

    // WhatsApp numbers
    if (!empty($_POST['whatsapps'])) {
        $waStmt = $conn->prepare("INSERT INTO EmployeeWhatsApp (file_number, whatsapp_number) VALUES (?, ?)");
        foreach ($_POST['whatsapps'] as $whatsapp) {
            if ($whatsapp != "") {
                $waStmt->bind_param("ss", $file_number, $whatsapp);
                $waStmt->execute();
            }
        }
    }

    // School attachments
    if (!empty($_POST['school_name'])) {
        $schoolStmt = $conn->prepare("INSERT INTO EmployeeSchoolAttachments (file_number, school_name, start_date, end_date) VALUES (?, ?, ?, ?)");
        foreach ($_POST['school_name'] as $index => $school) {
            if ($school != "") {
                $start = $_POST['school_start'][$index];
                $end = $_POST['school_end'][$index];
                $schoolStmt->bind_param("ssss", $file_number, $school, $start, $end);
                $schoolStmt->execute();
            }
        }
    }

    // Other attachments
    if (!empty($_POST['attach_date'])) {
        $attachStmt = $conn->prepare("INSERT INTO EmployeeAttachments (file_number, date_of_attachment, period) VALUES (?, ?, ?)");
        foreach ($_POST['attach_date'] as $index => $attach_date) {
            if ($attach_date != "") {
                $period = $_POST['attach_period'][$index];
                $attachStmt->bind_param("sss", $file_number, $attach_date, $period);
                $attachStmt->execute();
            }
        }
    }

    echo "<p style='color:green;'>Employee data saved successfully!</p>";
    echo "<a href='employee_form.html'>Back to Form</a>";
}
?>
