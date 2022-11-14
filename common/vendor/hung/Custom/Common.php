<?php

namespace Custom;

class Common {

    /**
     * generate table time
     * @param type $date
     * @return type
     */
    public static function generateTime($date) {
        $return = [];
        $start = strtotime($date . ' 05:00:00');
        for ($i = $start; $i <= strtotime($date . ' 23:30:00'); $i = ($i + (30 * 60))) {
            $return[$i] = [
                'time' => date('H:i', $i),
                'next' => date('H:i', ($i + (30 * 60))),
                'date_time' => date('Y-m-d H:i:s', $i),
                'hour' => date('H', $i),
            ];
        }
        return $return;
    }

    /**
     * generate table time
     * @param type $date
     * @return type
     */
    public static function generateTimeBaseOnHour($date) {
        $return = [];
        $start = strtotime($date . ' 06:00:00');
        for ($i = $start; $i <= strtotime($date . ' 23:30:00'); $i = ($i + (60 * 60))) {
            $return[$i] = [
                'time' => date('H:i', $i),
                'next' => date('H:i', ($i + (60 * 60))),
                'date_time' => date('Y-m-d H:i:s', $i),
                'hour' => date('H', $i),
            ];
        }
        return $return;
    }

    /**
     * 
     * @param type $errors
     * @return string
     */
    public static function parserMessage($errors) {
        $message = "";
        foreach ($errors as $item) {
            if (is_array($item)) {
                foreach ($item as $value) {
                    $message .= $value . "<br/>";
                }
            } else {
                $message .= $item . "<br/>";
            }
        }
        return $message;
    }

    /**
     * 
     */
    public static function convertTimezone($date, $format = "Y-m-d H:i:s") {
        $datetime = new \DateTime($date, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $la_time = new \DateTimeZone('Asia/Tokyo');
        $datetime->setTimezone($la_time);
        return $datetime->format($format);
    }

    /**
     * 
     */
    public static function generateCalendar($date) {
        $return = array();
        for ($i = 0; $i < 7; $i++) {
            $time = strtotime($date);
            $return[$time] = array(
                'w' => self::getDayOfWeek(date('w', $time)),
                'date' => date('d-m', $time)
            );
            $date = date('Y-m-d 00:00:00', strtotime($date . ' + 1 day'));
        }
        return $return;
    }

    /**
     * 
     */
    public static function getDayOfWeek($w) {
        $return = array(
            0 => \Yii::t('common', 'Sunday'),
            1 => \Yii::t('common', 'Monday'),
            2 => \Yii::t('common', 'Tuesday'),
            3 => \Yii::t('common', 'Wednesday'),
            4 => \Yii::t('common', 'Thursday'),
            5 => \Yii::t('common', 'Friday'),
            6 => \Yii::t('common', 'Saturday'),
        );
        if (isset($return[$w]))
            return $return[$w];
        return "";
    }

    /**
     * check time future
     */
    public static function checkFuture($date, $hour = 2) {
        $timeOfClass = new \DateTime($date, new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $now = new \DateTime('now', new \DateTimeZone('Asia/Ho_Chi_Minh'));
        if ($now->getTimestamp() <= ($timeOfClass->getTimestamp() - (60 * 60 * $hour))) {
            return true;
        }
        return false;
    }

    /**
     * 
     */
    public static function getCurrentTime() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datetime = new \DateTime("now", new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $datetime->getTimestamp();
    }

    public static function getIp() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
