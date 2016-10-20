<?php
function curl($url) {
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }

function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }

$i = 1;
for ($i; $i < 1594; $i++) {

if ($i == 17 or $i == 148 or $i == 149 or $i == 150 or $i == 151 or $i == 152
or $i == 153 or $i == 154) {
  continue;
}


$url = "http://magicseaweed.com/Les-Huttes-Surf-Report/" . strval($i);

$scraped_website = curl($url);


$spot = scrape_between($scraped_website, '<title>', 'Surf');

if ($spot[0] == 4) {
  continue;
}
echo $spot;
echo " " . $i . "<br>";

}
?>
