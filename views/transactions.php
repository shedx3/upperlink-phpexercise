<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 6px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 18px;
            }

            tfoot tr th {
                text-align: right;
            }
            .expense {
                color: red;
            }
            .income {
                color: green;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- YOUR CODE -->
                <?php
                    // Variable Declaration
                    include '../app/App.php';
                    $data = getFile();
                    $totExpense = getTotals()[1];
                    $totIncome = getTotals()[0];
                    $dataLength = count($data);
                    $netTot = getTotals()[2];
                ?>

                <?php
                    for($i = 1; $i<$dataLength; $i++) {
                        $itemLength = count($data[$i]);
                        $singleRow = "";
                        $lastIndex = $itemLength - 1;
                        for ($f = 0; $f < $itemLength; $f++) {
                            if ($f === 0) {                 // check if 1st column and change date format if true
                                $arrDate = $data[$i][$f];
                                $arrDate = explode('/', $arrDate); // Split string
                                $setDate =  date("M d, Y", mktime(0,0,0,$arrDate[0],$arrDate[1],$arrDate[2]));
                                $singleRow .= "<td>". $setDate . "</td>";
                            }
                            elseif ($f !== $lastIndex) {        // check if item is not the last column
                                $singleRow .= "<td>". $data[$i][$f]."</td>";
                            } else {
                                if (str_starts_with($data[$i][$f], '-')) {      // To check if amount is an expense and color red
                                    $singleRow .= "<td class='expense'>". $data[$i][$f]."</td>";
                                } else {                                        // To check amount is an income and add color green
                                    $singleRow .= "<td class='income'>". $data[$i][$f]."</td>";
                                }
                            }
                        }
                        echo "<tr>". $singleRow . "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <?php echo "<td>$". $totIncome . "</td>"; ?>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <?php echo "<td>-$". $totExpense . "</td>"; ?>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <?php echo "<td>$" . $netTot . "</td>" ?>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
