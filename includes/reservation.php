<?php
session_start();

include 'connection.php';

// Get the JSON data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Check if JSON was properly decoded
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

if (isset($data['step'])) {
    $_SESSION['reservation']['step'] = $data['step'];
    unset($data['step']);
}

if (isset($data['action']) && $data['action'] === 'itinerary') {
    unset($data['action']);
    $_SESSION['reservation']['itinerary'] = $data;
}

if (isset($data['action']) && $data['action'] === 'vehicle') {
    unset($data['action']);

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM vehicles WHERE id = ?");
    $stmt->bind_param('i', $data['id']);  // Assuming the id is an integer
    $stmt->execute();
    $vehicle_result = $stmt->get_result();
    $vehicle = $vehicle_result->fetch_assoc();

    if ($vehicle) {
        $vehicle['imgSrc'] = "/assets/images/vehicles/{$vehicle['slug']}.avif";
        $_SESSION['reservation']['vehicle'] = $vehicle;
    } else {
        echo json_encode(['error' => 'Vehicle not found']);
        exit;
    }

    $data = $_SESSION['reservation'];
}

if (isset($data['action']) && $data['action'] === 'add_add_on') {
    $stmt = $con->prepare("SELECT * FROM add_ons WHERE id = ?");
    $stmt->bind_param('i', $data['id']);
    $stmt->execute();
    $add_on_result = $stmt->get_result();
    $add_on = $add_on_result->fetch_assoc();

    if ($add_on) {
        // Merge new add-on with current add-ons in the session object and sort by id
        $_SESSION['reservation']['add_ons'][$add_on['id']] = $add_on;
        uasort($_SESSION['reservation']['add_ons'], function ($a, $b) {
            return $a['id'] - $b['id'];
        });
    } else {
        echo json_encode(['error' => 'Add-on not found']);
        exit;
    }

    $data = $_SESSION['reservation'];
}

if (isset($data['action']) && $data['action'] === 'remove_add_on') {
    $stmt = $con->prepare("SELECT * FROM add_ons WHERE id = ?");
    $stmt->bind_param('i', $data['id']);
    $stmt->execute();
    $add_on_result = $stmt->get_result();
    $add_on = $add_on_result->fetch_assoc();

    if ($add_on && isset($_SESSION['reservation']['add_ons'][$add_on['id']])) {
        // Remove add-on from current add-ons in the session object
        unset($_SESSION['reservation']['add_ons'][$add_on['id']]);
    } else {
        echo json_encode(['error' => 'Add-on not found or not in session']);
        exit;
    }

    $data = $_SESSION['reservation'];
}

if (isset($data['action']) && $data['action'] === 'reset_reservation') {
    unset($_SESSION['reservation']);
}

if (isset($data['action']) && $data['action'] === 'reset_itinerary') {
    unset($_SESSION['reservation']['itinerary']);
}

if (isset($data['action']) && $data['action'] === 'reset_car_selection') {
    unset($_SESSION['reservation']['vehicle']);
}

if (isset($data['action']) && $data['action'] === 'reset_add_ons') {
    unset($_SESSION['reservation']['add_ons']);
}

if (isset($data['action']) && $data['action'] === 'reset_contact_info') {
    unset($_SESSION['reservation']['contact_info']);
}

// Send back the data as JSON
echo json_encode($data ? $data : $_POST);
