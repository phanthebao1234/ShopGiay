<?php  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Voucher.xls");  
header("Pragma: no-cache");  
header("Expires: 0"); 
    $vocuher = new Voucher();
    $result = $vocuher-> getListAllVoucher();
    $columnHeader = '';  
    $columnHeader = "Voucher Code" . "\t" . "Voucher Name" . "\t" . "Voucher Start" . "\t" . "Voucher End" . "\t" . "Voucher Sale" . "\t" . "Voucher Count" . "\t". "Voucher Status" . "\t";  
    $setData = '';  
    while ($set = $result->fetch()) {  
        $rowData = '';  
        foreach ($set as $value) {  
            $value = '"' . $value . '"' . "\t";  
            $rowData .= $value;  
        }  
        $setData .= trim($rowData) . "\n";  
    }  
    
     

    echo ucwords($columnHeader) . "\n" . $setData . "\n";
?>
