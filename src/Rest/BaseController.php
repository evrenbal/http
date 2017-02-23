<?php

namespace Baka\Http\Rest;

use \Phalcon\Http\Response;
use \Phalcon\Mvc\Controller;

/**
 * Default REST API Base Controller
 */
class BaseController extends Controller
{

    /**
     * Set JSON response for AJAX, API request
     *
     * @param mixed $content
     * @param integer $statusCode
     * @param string $statusMessage
     *
     * @return \Phalcon\Http\Response
     */
    public function response($content, int $statusCode = 200, string $statusMessage = 'OK'): Response
    {
        $di = \Phalcon\DI::getDefault();
        $response = [
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'content' => $content,
        ];

        if ($di->getConfig()->application->debug->logRequest) {
            $di->getLog('request')->addInfo('RESPONSE', $response);
        }

        // Create a response since it's an ajax
        $response = new Response();
        $response->setStatusCode($statusCode, $statusMessage);
        $response->setJsonContent($content);

        return $response;
    }
}
