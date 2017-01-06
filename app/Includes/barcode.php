<?php
define('FPDF_FONTPATH', 'font/');
require('fpdf.php');



class PDF_EAN13 extends FPDF
{
function EAN13($x, $y, $barcode, $h=16, $w=.35)
{
    $this->Barcode($x, $y, $barcode, $h, $w, 13);
}

function UPC_A($x, $y, $barcode, $h=16, $w=.35)
{
    $this->Barcode($x, $y, $barcode, $h, $w, 12);
}

function GetCheckDigit($barcode)
{
    //Compute the check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $r;
}

function TestCheckDigit($barcode)
{
    //Test validity of check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    return ($sum+$barcode{12})%10==0;
}

function Barcode($x, $y, $barcode, $h, $w, $len)
{
    //Padding
    $barcode=str_pad($barcode, $len-1, '0', STR_PAD_LEFT);
    if($len==12)
        $barcode='0'.$barcode;
    //Add or control the check digit
    if(strlen($barcode)==12)
        $barcode.=$this->GetCheckDigit($barcode);
    elseif(!$this->TestCheckDigit($barcode))
        $this->Error('Incorrect check digit');
    //Convert digits to bars
    $codes=array(
        'A'=>array(
            '0'=>'0001101', '1'=>'0011001', '2'=>'0010011', '3'=>'0111101', '4'=>'0100011', 
            '5'=>'0110001', '6'=>'0101111', '7'=>'0111011', '8'=>'0110111', '9'=>'0001011'), 
        'B'=>array(
            '0'=>'0100111', '1'=>'0110011', '2'=>'0011011', '3'=>'0100001', '4'=>'0011101', 
            '5'=>'0111001', '6'=>'0000101', '7'=>'0010001', '8'=>'0001001', '9'=>'0010111'), 
        'C'=>array(
            '0'=>'1110010', '1'=>'1100110', '2'=>'1101100', '3'=>'1000010', '4'=>'1011100', 
            '5'=>'1001110', '6'=>'1010000', '7'=>'1000100', '8'=>'1001000', '9'=>'1110100')
        );
    $parities=array(
        '0'=>array('A', 'A', 'A', 'A', 'A', 'A'), 
        '1'=>array('A', 'A', 'B', 'A', 'B', 'B'), 
        '2'=>array('A', 'A', 'B', 'B', 'A', 'B'), 
        '3'=>array('A', 'A', 'B', 'B', 'B', 'A'), 
        '4'=>array('A', 'B', 'A', 'A', 'B', 'B'), 
        '5'=>array('A', 'B', 'B', 'A', 'A', 'B'), 
        '6'=>array('A', 'B', 'B', 'B', 'A', 'A'), 
        '7'=>array('A', 'B', 'A', 'B', 'A', 'B'), 
        '8'=>array('A', 'B', 'A', 'B', 'B', 'A'), 
        '9'=>array('A', 'B', 'B', 'A', 'B', 'A')
        );
    $code='101';
    $p=$parities[$barcode{0}];
    for($i=1;$i<=6;$i++)
        $code.=$codes[$p[$i-1]][$barcode{$i}];
    $code.='01010';
    for($i=7;$i<=12;$i++)
        $code.=$codes['C'][$barcode{$i}];
    $code.='101';
    //Draw bars
    for($i=0;$i<strlen($code);$i++)
    {
        if($code{$i}=='1')
            $this->Rect($x+$i*$w, $y, $w, $h, 'F');
    }
    //Print text uder barcode
    $this->SetFont('Arial', '', 12);
    $this->Text($x, $y+$h+11/$this->k, substr($barcode, -$len));
}

function Header(){
    // Logo
    //$this->Image('pdflogo.jpg',23,6,20);
    $this->Image('micon5.png',38,12,12);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(27.5);
    // Title
    $this->Cell(135,15,'Ricevuta di riparazione presso Smart Bit S.R.L.',0,0,'R');
    
    // Line break
    $this->Ln(20);
}
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
}

function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5){

    $wide = $baseline;
    $narrow = $baseline / 3 ; 
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn'; 
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial','',10);
    $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code[$i];
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq[$bar] == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
}

function Codabar($xpos, $ypos, $code, $start='A', $end='A', $basewidth=0.35, $height=15) {
    $barChar = array (
        '0' => array (6.5, 10.4, 6.5, 10.4, 6.5, 24.3, 17.9),
        '1' => array (6.5, 10.4, 6.5, 10.4, 17.9, 24.3, 6.5),
        '2' => array (6.5, 10.0, 6.5, 24.4, 6.5, 10.0, 18.6),
        '3' => array (17.9, 24.3, 6.5, 10.4, 6.5, 10.4, 6.5),
        '4' => array (6.5, 10.4, 17.9, 10.4, 6.5, 24.3, 6.5),
        '5' => array (17.9,    10.4, 6.5, 10.4, 6.5, 24.3, 6.5),
        '6' => array (6.5, 24.3, 6.5, 10.4, 6.5, 10.4, 17.9),
        '7' => array (6.5, 24.3, 6.5, 10.4, 17.9, 10.4, 6.5),
        '8' => array (6.5, 24.3, 17.9, 10.4, 6.5, 10.4, 6.5),
        '9' => array (18.6, 10.0, 6.5, 24.4, 6.5, 10.0, 6.5),
        '$' => array (6.5, 10.0, 18.6, 24.4, 6.5, 10.0, 6.5),
        '-' => array (6.5, 10.0, 6.5, 24.4, 18.6, 10.0, 6.5),
        ':' => array (16.7, 9.3, 6.5, 9.3, 16.7, 9.3, 14.7),
        '/' => array (14.7, 9.3, 16.7, 9.3, 6.5, 9.3, 16.7),
        '.' => array (13.6, 10.1, 14.9, 10.1, 17.2, 10.1, 6.5),
        '+' => array (6.5, 10.1, 17.2, 10.1, 14.9, 10.1, 13.6),
        'A' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
        'T' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
        'B' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
        'N' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
        'C' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
        '*' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
        'D' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
        'E' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
    );
    $this->SetFont('Arial','',13);
    $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);
    $code = strtoupper($start.$code.$end);
    for($i=0; $i<strlen($code); $i++){
        $char = $code[$i];
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<7; $bar++){
            $lineWidth = $basewidth*$seq[$bar]/6.5;
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $basewidth*10.4/6.5;
    }
}


}


class PDF_Codabar extends FPDF
{

}
/* EXAMPLE
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->EAN13(80, 40, '123456789012');
$pdf->Output();
 *
 */
?>