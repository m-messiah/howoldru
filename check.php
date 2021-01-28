<?php

function validate($data) {
    $result = new stdClass();
    $result->status = "OK";
    $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
    if ($name == "" || $name != $data['name']) {
        $result->status = "ERROR";
        $result->field = "name";
        $result->reason = "incorrect symbols";
        return $result;
    };
    $result->name = $name;
    $now = new DateTime();
    try {
        $birthday = DateTime::createFromFormat("Y-m-d", $data['birthday']);
        if (!$birthday instanceof DateTime) {
            throw new Exception('wrong date');
        }
        if ($birthday < DateTime::createFromFormat("Y", '1900')) {
            throw new Exception("you are too old to use it");
        }
        if ($birthday > $now) {
            throw new Exception("your birthday must be in the past");
        }
    } catch (Exception $e) {
        $result->status = "ERROR";
        $result->field = "birthday";
        $result->reason = $e->getMessage();
        return $result;
    }
    $result->age = $birthday->diff($now)->format('%y');
    return $result;
};
header('Content-type: application/json');
$result = validate($_POST);
echo json_encode($result);
?>
