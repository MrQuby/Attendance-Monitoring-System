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

        // Format error messages for duplicate entries
        if (!$result['success'] && isset($result['errors'])) {
            $duplicateErrors = array_filter($result['errors'], function($error) {
                return strpos($error, 'Duplicate entry') !== false;
            });
            
            if (!empty($duplicateErrors)) {
                // Extract student IDs from error messages
                $duplicateIds = array_map(function($error) {
                    preg_match("/SCC-\d+/", $error, $matches);
                    return $matches[0] ?? '';
                }, $duplicateErrors);
                
                // Create a user-friendly message
                $result = [
                    'success' => false,
                    'message' => "The following students are already in the system:\n" . 
                                implode(", ", array_filter($duplicateIds)) . 
                                "\n\nPlease remove these students from your upload file or update them individually."
                ];
            }
        }

        echo json_encode($result);

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
