<?php

function jsonResponse(array $data, int $statusCode = 200): void
{
    header_remove();
    header("Content-Type: application/json");
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}
