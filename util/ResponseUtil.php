<?php

function update_session(){
    $expire = time() + 60 * 10;
    $_SESSION['expire_time'] = $expire;
}

function return_data()
{
    $args = func_get_args();
    switch (func_num_args()) {
        case 1:
            return_data1($args[0]);
            break;
        case 2:
            return_data2($args[0], $args[1]);
            break;
    }
}

function return_data1(Response $response)
{
    if (!isset($response->code))
        $response->code = $response->UNKNOWN_ERROR;
    $response->format($response->code);
    $return_response = new ReturnResponse();
    $return_response->code = $response->code;
    $return_response->data = $response->data;
    $return_response->message = $response->message;
    echo json_encode($return_response);
    exit(0);
}

function return_data2(Response $response, $code)
{
    if (!isset($code))
        $response->code = $response->UNKNOWN_ERROR;
    $response->format($code);
    $return_response = new ReturnResponse();
    $return_response->code = $response->code;
    $return_response->data = $response->data;
    $return_response->message = $response->message;
    echo json_encode($return_response);
    exit(0);
}