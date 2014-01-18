<?php

function parse_when($data) {
  $data = strtolower($data);
  $m = 0;
  $h = 0;
  $d = 0;

  $matches = array();

  // match number + units (e.g., 12days, 2hours)
  if (preg_match("/^(\d+)(minutes|minute|mins|min|hours|hour|hrs|hr|days|day)$/", $data, $matches)) {
    // remove first element
    array_shift($matches);
    $str = implode(" ", $matches);
    $epoch = strtotime($str);
  }

  // match time
  if (preg_match("/^(\d+)(am|pm)(tomorrow)?/", $data, $matches)) {
    // remove first element
    array_shift($matches);
    $str = implode(" ", $matches);
    $epoch = strtotime($str);
  }

  // match date
  if (preg_match("/^(january|february|march|april|may|june|july|august|september|october|november|december|jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)(\d+)$/", $data, $matches)) {
    // remove first element
    array_shift($matches);
    $str = implode(" ", $matches);
    $epoch = strtotime($str);
  } 

  // match day of the week
  if (preg_match("/^(sunday|monday|tuesday|wednesday|thursday|friday|saturday|sun|mon|tues|wed|thurs|fri|sat)$/", $data, $matches)) {
    // remove first element
    array_shift($matches);
    $str = implode(" ", $matches);
    $epoch = strtotime($str);
  } 

  // return (int)$epoch;
  return date("c", (int)$epoch);
}


echo parse_when("12min") . "\n";
echo parse_when("1amtomorrow") . "\n";
echo parse_when("jan20") . "\n";
