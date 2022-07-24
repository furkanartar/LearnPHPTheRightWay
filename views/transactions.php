<?php
    $income = 0;
    $expense = 0;
    $totalAmount = null;

    include(APP_PATH . 'App.php');
?>

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
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
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
                <?php 
                    $csvDatas = (getCSVDataFromFile(FILES_PATH, 'csv'));
                    
                    $dateColumnNumber = array_search('Date', $csvDatas[0]);
                    $checkColumnNumber = array_search('Check #', $csvDatas[0]);
                    $descriptionColumnNumber = array_search('Description', $csvDatas[0]);
                    $amountColumnNumber = array_search('Amount', $csvDatas[0]);

                    foreach ($csvDatas as $row):
                        if (is_integer(array_search('Date', $row)))
                            continue;

                        $amount = (float) stringSeparator($row[$amountColumnNumber], ['$', ',']);
                ?>
                   <tr style="text-align: center;">
                        <td style="width: 25%;"><?= dateFormatter($row[$dateColumnNumber]) ?></td>
                        <td style="width: 25%;"><?= $row[$checkColumnNumber] ?></td>
                        <td style="width: 25%;"><?= $row[$descriptionColumnNumber] ?></td>
                        <td style="width: 25%; <?= ($amount) > 0 ? 'color:green' : 'color:red' ?>">
                        <?php
                            if (($amount) > 0) {
                                $income += $amount;
                                echo '+$' . number_format($amount, 2, ',', '.');
                            } else {
                                $expense += $amount;
                                $amount = stringSeparator($amount, ['-']);
                                echo '-$' . number_format($amount, 2, ',', '.');
                            }
                        ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= number_format($income, 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= number_format($expense, 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= number_format($income + $expense, 2, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>


























<!-- 





<table style="width:100%">
    <thead>
        <th>Date</th>
        <th>Check</th>
        <th>Description</th>
        <th>Amount</th>
    </thead>
    <tbody>
        
    </tbody>
</table> -->