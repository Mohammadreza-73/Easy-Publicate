<?php

namespace Samoon\App\Services;

use Goutte\Client;
use InvalidArgumentException;

class ScholarService
{
    private $client;
    private $crawler;
    private array $scholarData = [];
    private array $year = [];
    private array $citation = [];

    public function __construct(string $url)
    {
        $this->client  = new Client();
        $this->crawler = $this->client->request('GET', $url); 
    }

    /**
     * Get User Data From Profile
     *
     * @return array Data
     */
    public function getUserData(): array
    {
        $this->scholarData['user_name']       = $this->crawler->filter('#gsc_prf_in')->text();
        $this->scholarData['user_university'] = $this->crawler->filter('.gsc_prf_il')->text();
        $this->scholarData['user_email']      = $this->crawler->filter('#gsc_prf_ivh')->text();

        return $this->scholarData;
    }

    /**
     * Get Citation Data From Profile
     *
     * @return array Data
     */
    public function getCitationsData(): array
    {
        $this->scholarData['citatoins']                = $this->crawler->filter('table#gsc_rsb_st tr:nth-child(1) td')->eq(1)->text();
        $this->scholarData['last_five_year_citatoins'] = $this->crawler->filter('table#gsc_rsb_st tr:nth-child(1) td')->eq(2)->text();
        $this->scholarData['h_index']                  = $this->crawler->filter('table#gsc_rsb_st tr:nth-child(2) td')->eq(1)->text();
        $this->scholarData['i10_index']                = $this->crawler->filter('table#gsc_rsb_st tr:nth-child(3) td')->eq(1)->text();

        return $this->scholarData;
    }

    /**
     * Get Publication Data From Profile Profile
     *
     * @return array Data
     */
    public function getPublicationsData(): array
    {
        $this->crawler->filter('table#gsc_a_t tbody#gsc_a_b .gsc_a_tr')->each(function ($node) {
            $title   = $node->filter('td.gsc_a_t > a.gsc_a_at')->text();
            $authors = $node->filter('td.gsc_a_t > div.gs_gray')->eq(0)->text();
            $venue   = $node->filter('td.gsc_a_t > div.gs_gray')->eq(1)->text();
            $citedBy = $node->filter('td.gsc_a_c > a.gsc_a_ac.gs_ibl')->text();
            $year    = $node->filter('td.gsc_a_y > span.gsc_a_h')->text();
            
            $this->scholarData['publications'][] = [
                'title'   => $title,
                'authors' => $authors,
                'venue'   => $venue,
                'citedBy' => $citedBy,
                'year'    => $year
            ];
        });

        return $this->scholarData;
    }

    /**
     * Get Citation per Year From Profile
     *
     * @return array Data
     */
    public function getCitationsPerYearData(): array
    {
        $this->crawler->filter('div.gsc_md_hist_b > span.gsc_g_t')->each(function ($node) {
            $year = $node->text();
            $this->year[] = $year;
        });

        $this->crawler->filter('div.gsc_md_hist_b a.gsc_g_a > span.gsc_g_al')->each(function ($node) {
            $citation = $node->text();
            $this->citation[] = $citation;
        });
        
        // TODO: Chekc for zero citation
        try {
            if ( count($this->year) != count($this->citation) )
                throw new InvalidArgumentException('We have zero citation for a year');

            $this->scholarData['citations_per_year'] = array_combine($this->year, $this->citation);
            
        } catch (InvalidArgumentException $e) {
            die($e);
        }

        return $this->scholarData;
    }

    /**
     * Get All Data From Profile
     *
     * @return array Data
     */
    public function getData(): array
    {
        $this->scholarData = array_merge(
            $this->getUserData(),
            $this->getCitationsData(),
            $this->getCitationsPerYearData(),
            $this->getPublicationsData()
        );

        return $this->scholarData;
    }
}