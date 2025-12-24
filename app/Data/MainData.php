<?php

namespace App\Data;

class MainData
{
    public object $banner;
    public object $operating_algorithm;
    public object $our_services;

    public object $get_help;

    public object $why_choose_us;

    public object $reviews_from_our_clients;

    public object $faq;

    public object $seo;

    public function __construct()
    {
        $this->banner = (object) [];
        $this->operating_algorithm = (object) [];
        $this->our_services = (object) [];
        $this->get_help = (object) [];
        $this->why_choose_us = (object) [];
        $this->reviews_from_our_clients = (object) [];
        $this->faq = (object) [];
        $this->seo = (object) [];
    }
}
