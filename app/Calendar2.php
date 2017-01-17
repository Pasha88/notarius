<?php

use App\Calendar;

class Calendar2 {

    public function __construct(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    private $dayLabels = array("Пон.","Втор.","Среда","Четв.","Пят.","Суб.","Воскр.");
    private $currentYear=0;
    private $currentMonthRus=0;
    private $currentMonth=0;
    private $currentDay=0;
    private $currentDate=null;
    private $daysInMonth=0;
    private $naviHref= null;
    private $myNumber = 0;

    function getMonthRus($num_month = false) {
// если не задан номер месяца
        if(!$num_month) {

            $num_month = date('n');
        }

        $monthes = array(
            1 => 'Январь' , 2 => 'Февраль' , 3 => 'Март' ,
            4 => 'Апрель' , 5 => 'Май' , 6 => 'Июнь' ,
            7 => 'Июль' , 8 => 'Август' , 9 => 'Сентябрь' ,
            10 => 'Октябрь' , 11 => 'Ноябрь' ,
            12 => 'Декабрь'
        );
// получаем название месяца из массива
        $name_month = $monthes[$num_month];
// вернем название месяца
        return $name_month;
    }

    public function getMonth() {
        $month = $this->currentMonth;
        return $month;
    }
    public function getYear() {
        $year = $this->currentYear;
        return $year;
    }

    public function show() {
        $year  = null;
        $month = null;

        if(null==$year&&isset($_GET['year'])){
            $year = $_GET['year'];
        }else if(null==$year){
            $year = date("Y",time());
        }

        if(null==$month&&isset($_GET['month'])){
            $month = $_GET['month'];
        }else if(null==$month){
            $month = date("m",time());
        }

        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->currentMonthRus = $month;
        $this->daysInMonth=$this->_daysInMonth($month,$year);

        $content='<div id="calendar">'.
            '<div class="box">'.
            $this->_createNavi().
            '</div>'.
            '<div class="box-content">'.
            '<ul class="label">'.$this->_createLabels().'</ul>';
        $content.='<div class="clear"></div>';
        $content.='<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($month,$year);
        // Create weeks in a month
        for( $i=0; $i<$weeksInMonth; $i++ ){

            //Create days in a week
            for($j=1;$j<=7;$j++){
                $posts = null;
                $newDay = $i*7+$j;
                $dayStatus = 0;

                $content.=$this->_showDay($newDay, $dayStatus);

            }
        }

        $content.='</ul>';
        $content.='<div class="clear"></div>';
        $content.='</div>';
        $content.='</div>';
        return $content;
    }

    private function _showDay($cellNumber, $newDay){

        if($this->currentDay==0){

            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                $this->currentDay=1;
            }
        }

        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            $cellContent = $this->currentDay;
            $this->currentDay++;
        }else{
            $this->currentDate =null;
            $cellContent=null;
        }

        $postN = null;
        if(is_int($cellContent))
         $postN = Calendar::where('day', '=',  $this->currentDay-1)->where('month', '=', $this->currentMonth)->where('year', '=', $this->currentYear)->where('busy', '=', 1)->get();

        $checkForWeekend = 0;
        if($cellNumber%7-6==0 || $cellNumber%7==0 ) {
            $checkForWeekend = 1;
        }
        //$errors = array_filter($postN);
        $number = count($postN);
         if ($number > 0 && $checkForWeekend != 1) {
            return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
            ($cellContent == null ? 'mask' : '') . ' calendar_red' . '">' . $cellContent . '</li>';
        } elseif($checkForWeekend == 1) {
             return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
             ($cellContent == null ? 'mask' : '') . ' calendar_bard' . '">' . $cellContent . '</li>';
         }
         else {
            return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
            ($cellContent == null ? 'mask' : '') . ' calendar_default' . '">' . $cellContent . '</li>';
        }
    }

    /**
     * create navigation
     */
    private function _createNavi(){

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $thisMonth = $this->currentMonth>12?1:intval($this->currentMonth);

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        $monthRussia = $this->getMonthRus($thisMonth);

        $monthRus = date('Y',strtotime($this->currentYear.'-'.$this->currentMonth.'-1'));

        return
            '<div class="header">'.
            '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Пред.</a>'.
            '<span class="title">'.$monthRussia.' '.$monthRus.'</span>'.
            '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">След.</a>'.
            '</div>';
    }

    private function _createLabels(){

        $content='';

        foreach($this->dayLabels as $index=>$label){
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
        }
        return $content;
    }

    private function _weeksInMonth($month=null,$year=null){

        if( null==($year) ) {
            $year =  date("Y",time());
        }

        if(null==($month)) {
            $month = date("m",time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

        if($monthEndingDay<$monthStartDay){

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    private function _daysInMonth($month=null,$year=null){

        if(null==($year))
            $year =  date("Y",time());

        if(null==($month))
            $month = date("m",time());

        return date('t',strtotime($year.'-'.$month.'-01'));
    }



}