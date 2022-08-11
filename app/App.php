<?php

declare(strict_types = 1);

// Your Code

function getFile() {
    $openFile = fopen("../transaction_files/sample_1.csv", "r");

    while (($data = fgetcsv($openFile, 1000, ",")) !== FALSE) {
        $array[] = $data;
    };

    fclose($openFile);

    return $array;
}

function getTotals() {
    $data = getFile();
    $incomeSum = 0;
    $expenseSum = 0;
    $dataLength = count($data);
    
    for ($i=1; $i<$dataLength; $i++) {
        $lastItemIndex = count($data[$i]) - 1;
        $arrValue = $data[$i][$lastItemIndex];
        if (!str_starts_with($arrValue,"-")) {       // check if positive value
            $incomeValue = trim_data($arrValue);
            $incomeSum += $incomeValue;
        } else {
            $expenseValue = trim_data($arrValue);
            $expenseSum += $expenseValue;
        }
    }
    $netSum = $incomeSum + $expenseSum;
    
    $incomeSum = number_format($incomeSum, 2);      // round up to 2 d.p

    $expenseSum = number_format($expenseSum, 2);
    $expenseSum = str_replace('-', '', $expenseSum);        // remove the '-' from expenses
    
    $netTotal = number_format($netSum, 2);

    $totalsArr = array($incomeSum, $expenseSum, $netSum);

    return $totalsArr;
}

function trim_data($data) {
    $data = str_replace('$', '', $data);    // remove the dollar sign
    $data = str_replace(',', '', $data);    // remove ','
    $data = (float)$data;       // convert to a number

    return $data;
}
?>