<?php

namespace uTorrent\model;

class Filter {

    const QUALITY_ALL = -1;
    const QUALITY_NONE = 0;
    const QUALITY_HDTV = 1;
    const QUALITY_TVRIP = 2;
    const QUALITY_DVDRIP = 4;
    const QUALITY_SVCD = 8;
    const QUALITY_DSRIP = 16;
    const QUALITY_DVBRIP = 32;
    const QUALITY_PDTV = 64;
    const QUALITY_HRHDTV = 128;
    const QUALITY_HRPDTV = 256;
    const QUALITY_DVDR = 512;
    const QUALITY_DVDSCR = 1024;
    const QUALITY_720P = 2048;
    const QUALITY_1080I = 4096;
    const QUALITY_1080P = 8192;
    const QUALITY_WEBRIP = 16384;
    const QUALITY_SATRIP = 32768;

    public $filterId;
    /**
     * Give download highest priority
     * @var bool
     */
    public $prio;
    public $smartEpFilter;
    /**
     * Filter matches original name instead of decoded name
     * @var bool
     */
    public $addStopped;
    public $origname;
    public $name;
    public $filter;
    public $notFilter;
    /**
     * Path to save torrents to
     * @var string
     */
    public $saveIn;
    public $feedId;
    public $label;

    /*
     * "RSSFILTER_ID": 0
, "RSSFILTER_FLAGS": 1
, "RSSFILTER_NAME": 2
, "RSSFILTER_FILTER": 3
, "RSSFILTER_NOT_FILTER": 4
, "RSSFILTER_DIRECTORY": 5
, "RSSFILTER_FEED": 6
, "RSSFILTER_QUALITY": 7
, "RSSFILTER_LABEL": 8
, "RSSFILTER_POSTPONE_MODE": 9
, "RSSFILTER_LAST_MATCH": 10
, "RSSFILTER_SMART_EP_FILTER": 11
, "RSSFILTER_REPACK_EP_FILTER": 12
, "RSSFILTER_EPISODE_FILTER_STR": 13
, "RSSFILTER_EPISODE_FILTER": 14
, "RSSFILTER_RESOLVING_CANDIDATE": 15
     */
    public static function fromData(array $data) {
        $filter = new Filter();
        $filter->filterId = $data[0];
        // Bitmask for settings:
        // 1 = enabled. Not sure how to disable it. UI doesn't seem to support it
        $filter->origname = (bool)(2 & $data[1]);
        $filter->prio = (bool)(4 & $data[1]);
        $filter->smartEpFilter = (bool)(8 & $data[1]);
        $filter->addStopped = (bool)(16 & $data[1]);

        $filter->name = $data[2];
        $filter->filter = $data[3];
        $filter->notFilter = $data[4];
        $filter->saveIn = $data[5];
        $filter->feedId = $data[6];
        $filter->quality = $data[7];
        $filter->label = $data[8];
        return $filter;
    }

    /**
     * Turn model into an array of parameters for the api
     * @return array
     */
    public function toParams() {
        $params = array();
        foreach (array('filterId', 'origname', 'prio', 'smartEpFilter', 'addStopped',
                'name', 'filter', 'notFilter', 'saveIn', 'feedId', 'quality', 'label') as $field) {
            if ($this->$field !== null) {
                $paramName = preg_replace_callback('/[A-Z]/', function($match){
                    return '-'.strtolower($match[0]);
                }, $field);
                $params[$paramName] = $this->$field;
            }
        }
        return $params;
    }
}