<?php
class ApiAdapter
{
    private $api_url;
    private $api_user;
    private $api_pass;
    private $api_version;

    function __construct(
        $api_url,
        $api_user,
        $api_pass,
        $api_version = '6'
    ) {
        $this->api_url = $api_url;
        $this->api_user = $api_user;
        $this->api_pass = $api_pass;
        $this->api_version = $api_version;
    }
}
