<?php

namespace Xfers\Error;

class InvalidRequest extends Base
{
    public function __construct(
        $message,
        $xfersParam,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null
    ) {
        parent::__construct($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders);
        $this->xfersParam = $xfersParam;
    }

    public function getxfersParam()
    {
        return $this->xfersParam;
    }
}
