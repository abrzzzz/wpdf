<?php 
namespace Abrz\WPDF\Services\Route\Enums;

enum RouteHttpMethodEnum : string
{

    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
    case ANY = 'ANY';

}