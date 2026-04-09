<?php

if (isset($_POST["flag"])) {

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
}

class Calendar {

    /**
     * Constructor
     */
    public function __construct() {
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    /*     * ******************* PROPERTY ******************* */

    private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    private $currentYear = 0;
    private $currentMonth = 0;
    private $currentDay = 0;
    private $currentDate = null;
    private $daysInMonth = 0;
    private $naviHref = null;

    /* print out the calendar */

    public function show() {
        isset($year) == null;

        isset($month) == null;

        if (null == isset($year) && isset($_POST['year'])) {

            $year = $_POST['year'];
        } else if (null == isset($year)) {

            $year = date("Y", time());
        }

        if (null == isset($month) && isset($_POST['month'])) {

            $month = isset($_POST['month']);
        } else if (null == isset($month)) {

            $month = date("m", time());
        }

        $this->currentYear = $year;

        $this->currentMonth = $month;

        $this->daysInMonth = $this->_daysInMonth($month, $year);

        $content = '<div id="calendar">' .
                '<div class="box">' .
                $this->_createNavi() .
                '</div>' .
                '<div class="box-content">' .
                '<ul class="label">' . $this->_createLabels() . '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($month, $year);
        // Create weeks in a month
        for ($i = 0; $i < $weeksInMonth; $i++) {

            //Create days in a week
            for ($j = 1; $j <= 7; $j++) {
                $content .= $this->_showDay($i * 7 + $j, $month, $year);
            }
        }

        $content .= '</ul>';

        $content .= '<div class="clear"></div>';

        $content .= '</div>';
        $content .= '</div>';
        return $content;
    }

    /*     * ******************* PRIVATE ********************* */

    /**
     * create the li element for ul
     */
    private function _showDay($cellNumber, $month, $year) {

        if ($this->currentDay == 0) {

            $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));

            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {

                $this->currentDay = 1;
            }
        }

        if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {

            $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;
        } else {

            $this->currentDate = null;

            $cellContent = null;
        }

//Testing//
        $p = new _postingview;
        $res = $p->event((isset($_POST["groupid"]) ? $_POST["groupid"] : $_GET["groupid"]));
        if ($res != false) {
            while ($row = mysqli_fetch_assoc($res)) {
                $m = new _postfield;
                $rm = $m->read($row["idspPostings"]);
                if ($rm != false) {
                    while ($rs = mysqli_fetch_assoc($rm)) {
                        if ($rs["spPostFieldLabel"] == "Start Date") {
                            $date = $rs["spPostFieldValue"];
                            $m = date("m", strtotime($date));
                            $y = date("Y", strtotime($date));
                            $d = date("d", strtotime($date));
                            if ($month == $m && $year == $y)
                                if ($d == $cellContent) {
                                    $cellContent .= "<a href='../post-details/?postid=" . $row["idspPostings"] . "' style='font-size:10px;'><b>" . $row["spPostingtitle"] . "</b></a>";
                                }
                        }
                    }
                }
            }
        }
        //Testing Complete//
        return '<li id="li-' . $this->currentDate . '" class="commentoverflow' . ($cellNumber % 7 == 1 ? 'start' : ($cellNumber % 7 == 0 ? 'end ' : ' ')) . ($cellContent == null ? 'mask' : '') . '" style="' . (strlen($cellContent) > 2 ? 'background-color:yellow' : '') . '">' . $cellContent . '</li>';
    }

    /**
     * create navigation
     */
    private function _createNavi() {

        $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;

        $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;

        $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;

        $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;

        return
                '<div class="header">' .
                '<a class="prev eventdate" href="#" data-month=' . sprintf('%02d', $preMonth) . ' data-year=' . $preYear . ' data-groupid=' . (isset($_POST["groupid"]) ? $_POST["groupid"] : $_GET["groupid"]) . '>Prev</a>' .
                '<span class="title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
                '<a class="next eventdate" data-month=' . sprintf("%02d", $nextMonth) . ' data-year=' . $nextYear . ' data-groupid=' . (isset($_POST["groupid"]) ? $_POST["groupid"] : $_GET["groupid"]) . '>Next</a>' .
                '</div>';
    }

    /**
     * create calendar week labels
     */
    private function _createLabels() {

        $content = '';

        foreach ($this->dayLabels as $index => $label) {

            $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
        }

        return $content;
    }

    /**
     * calculate number of weeks in a particular month
     */
    private function _weeksInMonth($month = null, $year = null) {

        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month, $year);

        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

        if ($monthEndingDay < $monthStartDay) {

            $numOfweeks++;
        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular month
     */
    private function _daysInMonth($month = null, $year = null) {

        if (null == ($year))
            $year = date("Y", time());

        if (null == ($month))
            $month = date("m", time());

        return date('t', strtotime($year . '-' . $month . '-01'));
    }

}

$calendar = new Calendar();
echo $calendar->show();
?>
