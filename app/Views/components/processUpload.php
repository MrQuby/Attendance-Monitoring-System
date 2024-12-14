<?php
    require_once(__DIR__ . '/../../Models/SessionManager.php');
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../Models/Student.php');
    require_once(__DIR__ . '/../../../vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;

    SessionManager::startSession();
    if (!SessionManager::isAdminLoggedIn()) {
        die(json_encode(['success' => false, 'message' => 'Unauthorized access']));
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die(json_encode(['success' => false, 'message' => 'Invalid request method']));
    }

    try {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('No file uploaded or upload error occurred');
        }

        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, ['csv', 'xlsx', 'xls'])) {
            throw new Exception('Invalid file format. Only CSV and Excel files are allowed.');
        }

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file['tmp_name']);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        // Remove header row
        $headers = array_shift($data);
        
        // Convert headers to lowercase and remove spaces
        $headers = array_map(function($header) {
            return strtolower(str_replace(' ', '_', trim($header)));
        }, $headers);

        // Map data to associative array
        $mappedData = [];
        foreach ($data as $row) {
            if (!empty(array_filter($row))) {
                $mappedRow = [];
                foreach ($headers as $index => $header) {
                    $mappedRow[$header] = $row[$index] ?? null;
                }
                $mappedData[] = $mappedRow;
            }
        }

        // Process the data
        $studentModel = new Student($pdo);
        $result = $studentModel->bulkUploadStudents($mappedData);

        // Format the response message to be more user-friendly
        $duplicateCount = 0;
        $birthdateErrors = 0;
        $courseErrors = 0;
        $nameErrors = 0;
        $idErrors = 0;
        $rfidErrors = 0;
        $yearLevelErrors = 0;
        $successCount = isset($result['successCount']) ? $result['successCount'] : 0;
        
        if (isset($result['errors'])) {
            foreach ($result['errors'] as $error) {
                if (strpos($error, 'Duplicate entry') !== false || strpos($error, 'already exists') !== false) {
                    $duplicateCount++;
                } else if (strpos($error, 'Invalid birthdate format') !== false) {
                    $birthdateErrors++;
                } else if (strpos($error, 'Invalid course code') !== false) {
                    $courseErrors++;
                } else if (strpos($error, 'Missing required fields (Student ID') !== false) {
                    $idErrors++;
                } else if (strpos($error, 'Missing RFID') !== false) {
                    $rfidErrors++;
                } else if (strpos($error, 'Missing year level') !== false) {
                    $yearLevelErrors++;
                } else if (strpos($error, 'Missing required fields') !== false || 
                          strpos($error, 'Missing First Name') !== false || 
                          strpos($error, 'Missing Last Name') !== false) {
                    $nameErrors++;
                }
            }
        }

        $messages = [];
        
        // Add success message if any students were uploaded
        if ($successCount > 0) {
            $messages[] = "$successCount students added successfully";
        }
        
        // Add error messages in order of importance
        if ($duplicateCount > 0) {
            $messages[] = "$duplicateCount students already in the system";
        }
        if ($idErrors > 0) {
            $messages[] = "$idErrors students with missing student ID";
        }
        if ($rfidErrors > 0) {
            $messages[] = "$rfidErrors students with missing RFID";
        }
        if ($nameErrors > 0) {
            $messages[] = "$nameErrors students with missing first name or last name";
        }
        if ($yearLevelErrors > 0) {
            $messages[] = "$yearLevelErrors students with missing year level";
        }
        if ($birthdateErrors > 0) {
            $messages[] = "$birthdateErrors students with incorrect birthdate format";
        }
        if ($courseErrors > 0) {
            $messages[] = "$courseErrors students with invalid course code";
        }

        // If no messages, show appropriate message
        if (empty($messages)) {
            $result['message'] = "No students were added.";
        } else {
            $result['message'] = implode(" and ", $messages) . ".";
        }

        unset($result['errors']); // Remove detailed errors from response

        echo json_encode($result);

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
