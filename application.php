<?php

$api_url = 'https://interview-task-api.mca.dev/qr-scanner-codes/alpha-qr-gFpwhsQ8fkY1';
$data = json_decode(file_get_contents($api_url));

$domestic = array();
$imported = array();

$target = "true";

foreach ($data as $item) 
{
    if ($item->domestic == $target) 
    {
        $domestic[] = $item;
    } else 
    {
        $imported[] = $item;
    }
}

function compareByName($a, $b) 
{
    return strcmp($a->name, $b->name);
}

usort($domestic, 'compareByName');

usort($imported, 'compareByName');

echo '<pre>';

//  -------------------------------Domestic--------------------------------------------------
echo '.' . ' ' . 'Domestic';
echo '<br>';

foreach ($domestic as $item) 
{
    echo '...' . ' ' . $item->name;
    echo '<br>&nbsp&nbsp&nbsp&nbsp';
    echo 'Price:' . ' ';

    if (strpos($item->price, '.') == false) 
    {
        $updatedPrice = $item->price . ",0";
    } else 
    {
        $updatedPrice = str_replace('.', ',', $item->price);
    }

    echo '$' . $updatedPrice;
    echo '<br>&nbsp&nbsp&nbsp&nbsp';

    if (strlen($item->description) > 10) 
    {
        $item->description = substr($item->description, 0, 10) . '...';
        echo $item->description;
    }

    echo '<br>&nbsp&nbsp&nbsp&nbsp';
    echo 'Weight:' . ' ';

    if (isset($item->weight)) 
    {
        echo $item->weight . 'g';
    } else 
    {
        echo 'N/A';
    }
    
    echo '<br>';
}

//  -------------------------------Imported--------------------------------------------------
echo '.' . ' ' . 'Imported';
echo '<br>'; 

foreach ($imported as $item) 
{
    echo '...' . ' ' . $item->name;
    echo '<br>&nbsp&nbsp&nbsp&nbsp';
    echo 'Price:' . ' ';


    if (strpos($item->price, '.') == false) 
    {
        $updatedPrice = $item->price . ",0";
    } else 
    {
        $updatedPrice = str_replace('.', ',', $item->price);
    }

    echo '$' . $updatedPrice;
    echo '<br>&nbsp&nbsp&nbsp&nbsp';

    if (strlen($item->description) > 10) 
    {
        $item->description = substr($item->description, 0, 10) . '...';
        echo $item->description;
    }

    echo '<br>&nbsp&nbsp&nbsp&nbsp';
    echo 'Weight:' . ' ';

    if (isset($item->weight)) 
    {
        echo $item->weight . 'g';
    } else 
    {
        echo 'N/A';
    }
    
    echo '<br>';
}

//  -------------------------------Domestic cost--------------------------------------------------
$domesticCost = 0;

foreach ($domestic as $item) 
{
    if (isset($item->price)) 
    {
        $domesticCost += $item->price;
    }
}

echo 'Domestic cost:' . ' ';
echo '$' . $domesticCost . ',' . '0';
echo '<br>';

//  -------------------------------Imported cost--------------------------------------------------
$importedCost = 0;

foreach ($imported as $item) 
{
    if (isset($item->price)) 
    {
        $importedCost += $item->price;
    }
}

echo 'Imported cost:' . ' ';
echo '$' . $importedCost . ',' . '0';
echo '<br>';

//  -------------------------------Domestic count--------------------------------------------------
$domesticCount = count($domestic);
echo 'Domestic count:' . ' ';
echo $domesticCount;
echo '<br>';

//  -------------------------------Imported count--------------------------------------------------
$importedCount = count($imported);
echo 'Imported count:' . ' ';
echo $importedCount;
echo '<br>';

?>
