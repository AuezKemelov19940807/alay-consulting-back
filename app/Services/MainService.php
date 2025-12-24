<?php

namespace App\Services;

use App\Data\MainData;
use App\Services\BannerService;

class MainService
{
    public function __construct(
        protected BannerService                  $bannerService,
        protected OperatingAlgorithmService      $operatingAlgorithmService,
        protected  OurServiceService             $ourServiceService,
        protected AccountingConsultationsService $accountingConsultationsService,
        protected  WhyChooseUsService             $whyChooseUsService,
        protected  ClientReviewService            $reviewService,
        protected  FaqService                    $faqService,
        protected  SeoService                    $seoService,
    )
    {
    }

    /**
     * Возвращает объект main с banner на нужном языке
     */
    public function getMain(string $locale = 'ru'): MainData
    {
        $main = new MainData();

        // Берём баннер с нужным языком
        $main->banner = $this->bannerService->getFirst($locale);
        $main->operating_algorithm = $this->operatingAlgorithmService->get($locale);
        $main->our_services = $this->ourServiceService->get($locale);
        $main->get_help = $this->accountingConsultationsService->getFirst($locale);
        $main->why_choose_us = $this->whyChooseUsService->getFirst($locale);
        $main->reviews_from_our_clients = $this->reviewService->getFirst($locale);
        $main->faq = $this->faqService->get($locale);
        $main->seo = $this->seoService->get($locale);
        return $main;
    }
}
