<?php
define('FPDF_FONTPATH','./font/'); 
//questo file e la cartella font si trovano nella stessa directory
//require('barcode.php');

use App\Includes;

session_start();
$cod = $_SESSION['cod'];
$aut = $_SESSION['autorizzato'];


date_default_timezone_set('Europe/Rome');

$_SESSION['menu']='home';
$_SESSION['title']='RICEVUTA RIPARAZIONE';


$id_rip = $_GET['id'];
//$id_rip_int = (int)$id_rip;
$id_dec = $id_rip_int % 10;
    /*
    if($id_dec<1){
       $id_rip= '00000000'.$id_rip_int;
     
    }
    if($id_dec>=1 && $id_dec<10){
        $id_rip= '0000000'.$id_rip_int;
    }
    if($id_dec<10){
        $id_rip= '0000000'.$id_rip_int;
    }
     * */
    $prtotpdf = '';
    $prtot = $_GET['prc'];
    if(isset($prtot)){
        $prtotpdf = $prtot;
        $prtotpdf = (int)$prtotpdf;
    }

if($cod=='Latini' or $cod=='Ciafrei' and $aut === 1){
    //$image = 'images/pdf_logo.jpg';
    $pdfhtml = new PDF_EAN13('P','mm',array(210,297));
// inizializza il documento
$pdfhtml->header = 0;
$pdfhtml->footer = 0;

$pdfhtml->AliasNbPages();
// aggiunge una pagina
$pdfhtml->AddPage();
//$initialY = $pdfhtml->GetY();
//$pdfhtml->SetY(0);
//$pdfhtml->Image($image,$pdfhtml->GetX()+19,$pdfhtml->GetY()+10,15,15);
//$pdfhtml->SetY($initialY);
$pdfhtml->SetFont('Arial','',9);
$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,0,'Informazioni dispositivo ricevuto:',0,'C',0);
$pdfhtml->ln(4.5);
$telefono = $_GET['rec'];
$marca = $_GET['mar'];
$modello = $_GET['mod'];
$dataric = $_GET['ricf'];
$imei_pdf = $_GET['itr'];
$pdfhtml->Cell(20);
$pdfhtml->MultiCell(150,2.9," -Marca:".$marca."\n -Modello: ".$modello."\n -Data ricezione: ".$dataric."\n -IMEI: ".$imei_pdf,0,'L',0); 
$pdfhtml->ln(2);
$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,0,'Informazioni del Cliente:',0,'C',0);
$pdfhtml->ln(4.5);
$nome_cliente_pd = $_GET['pp'];
$cognome_cliente_pd = $_GET['ppc'];
$pdfhtml->Cell(20);
$pdfhtml->MultiCell(150,2.9, " -Nome: ".$nome_cliente_pd."\n -Cognome: ".$cognome_cliente_pd."\n -Recapito: +39 ".$telefono,0,'L',0);
$pdfhtml->ln(2);
$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,0,'Descrizione difetto:',0,'C',0);
$pdfhtml->ln(4.5);
$desc = $_GET['desc'];
$desc = utf8_decode($desc);
if($desc!==''){
    $pdfhtml->Cell(10);
    $pdfhtml->MultiCell(170,4,"\n".$desc."\n ",1,'L',0);
}

$parts = '';
$p1= $_GET['p1'];
if($p1!=''){
    $p1e = explode('_', $p1);
    $p1 = '-'.$p1e[0];
    $parts=$parts.$p1.' ';
    }
$p2= $_GET['p2'];
if($p2!=''){
    $p2e = explode('_', $p2);
    $p2 = '-'.$p2e[0];
    $parts=$parts.$p2.' ';
    }
$p3= $_GET['p3'];
if($p3!=''){
    $p3e = explode('_', $p3);
    $p3 = '-'.$p3e[0];
    $parts=$parts.$p3.' ';
}
$p4= $_GET['p4'];
if($p4!=''){
    $p4e = explode('_', $p4);
    $p4 = '-'.$p4e[0];
    $parts=$parts.$p4.' ';
}
if($parts!==''){
    //$pdfhtml->ln(5);
    $pdfhtml->Cell(70);
    $pdfhtml->Cell(0,10,'Sostituzione pezzo richiesta:','C');
    $pdfhtml->ln(8);
    $pdfhtml->Cell(10);
    $pdfhtml->MultiCell(170,8,$parts,1,'C',0);
}
$pdfhtml->ln(2);
if($prtotpdf !== 0){
    $prtot_desc = 'Prezzo totale: '.$prtotpdf.' euro';
    $prtot_desc = utf8_decode($prtot_desc);
    $pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,8,$prtot_desc,1,'C',0);
$pdfhtml->ln(5);
}
//$pdfhtml->Cell(45);
//$pdfhtml->MultiCell(100,5,'Codice riparazione',0,'C',0); 
$y = $pdfhtml->getY();
//$pdfhtml->EAN13(88.5,$y,$id_rip);
//$pdfhtml->Code39(88.5, $y, $id_rip);
$pdfhtml->setY(185);
$pdfhtml->SetFont('Arial','',11); //('Times','',11);

$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,0,'Informazioni dispositivo ricevuto:',0,'C',0);
$pdfhtml->ln(4.5);
$marca = $_GET['mar'];
$modello = $_GET['mod'];
$dataric = $_GET['ricf'];
$imei_pdf = $_GET['itr'];
$pdfhtml->Cell(20);
$pdfhtml->MultiCell(150,4," -Marca:".$marca."\n -Modello: ".$modello."\n -Data ricezione: ".$dataric."\n -IMEI: ".$imei_pdf,0,'L',0); 
$pdfhtml->ln(2);
$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,0,'Informazioni del Cliente:',0,'C',0);
$pdfhtml->ln(4.5);
$nome_cliente_pd = $_GET['pp'];
$cognome_cliente_pd = $_GET['ppc'];
$pdfhtml->Cell(20);
$pdfhtml->MultiCell(150,4, " -Nome: ".$nome_cliente_pd."\n -Cognome: ".$cognome_cliente_pd."\n -Recapito: +39 ".$telefono,0,'L',0);
$pdfhtml->ln(2);
$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,0,"Descrizione difetto:",0,'C',0);
$pdfhtml->ln(4.5);
$desc = $_GET['desc'];
$desc = utf8_decode($desc);
if($desc!==''){
    $pdfhtml->Cell(10);
    $pdfhtml->MultiCell(170,4,"\n".$desc."\n ",1,'L',0);
}


$parts = '';
$p1= $_GET['p1'];
if($p1!=''){
    $p1e = explode('_', $p1);
    $p1 = '-'.$p1e[0];
    $parts=$parts.$p1.' ';
    }
$p2= $_GET['p2'];
if($p2!=''){
    $p2e = explode('_', $p2);
    $p2 = '-'.$p2e[0];
    $parts=$parts.$p2.' ';
    }
$p3= $_GET['p3'];
if($p3!=''){
    $p3e = explode('_', $p3);
    $p3 = '-'.$p3e[0];
    $parts=$parts.$p3.' ';
}
$p4= $_GET['p4'];
if($p4!=''){
    $p4e = explode('_', $p4);
    $p4 = '-'.$p4e[0];
    $parts=$parts.$p4.' ';
}
if($parts!==''){
    //$pdfhtml->ln(5);
    $pdfhtml->Cell(70);
    $pdfhtml->Cell(0,10,'Sostituzione pezzo richiesta:','C');
    $pdfhtml->ln(8);
    $pdfhtml->Cell(10);
    $pdfhtml->MultiCell(170,8,$parts,0,'C',0);
}
$pdfhtml->ln(2);
if($prtotpdf !== 0){
    $prtot_desc = 'Prezzo totale: '.$prtotpdf.' euro';
    $prtot_desc = utf8_decode($prtot_desc);
    $pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,5,$prtot_desc,1,'C',0);
$pdfhtml->ln(5);
}
$pdfhtml->SetFont('Arial','',12);
$pdfhtml->Cell(45);
$pdfhtml->MultiCell(100,5,'Seriale riparazione',0,'C',0);
$y2 = $pdfhtml->getY();
$pdfhtml->MultiCell(100,5,'Firma',0,'C',0);
$pdfhtml->MultiCell(100,5,'___________',0,'C',0);
//$pdfhtml->EAN13(88.5,$y,$id_rip);
$pdfhtml->Code39(88.5, $y2, $id_rip);
$pdfhtml->setY($y+10); //115
$pdfhtml->SetFont('Arial','',10);
$pdfhtml->Cell(10);
$pdfhtml->MultiCell(170,5,"Gentile cliente, ti invitiamo a leggere attentamente i seguenti termini:",0,'C',0);
$pdfhtml->ln(3);
$pdfhtml->Cell(10);
$pdfhtml->SetFont('Arial','',8);
$string_dec = utf8_decode("1. Il cliente è pregato di ritirare il dispositivo riparato entro un massimo di 6 mesi (180 giorni) che verranno contati a partire dal giorno dell'avvenuta riparazione. Passati 180 giorni la presente ricevuta non sarà più valida.\n"
        ."2. la garanzia è di soli 3 mesi (90 giorni) che verranno contati a partire dal giorno dell'eventuale riparazione del cellulare e copre solamente il guasto riparato. Dopo il ritiro del dispositivo non si assume alcuna responsabilità per eventuali problemi che dovessero insorgere.\n"
        ."3. Si prega di rimuovere (se il dispositivo ne è munito o ne permette l'alloggiamento) sim-card e memory-card.\n"
        ."4. I dati del dispositivo devono essere trascritti, poichè c'è il rischio che durante la riparazione essi possano essere cancellati.\n"
        ."5. Si prega di provare subito il dispositivo per controllare se funziona, in caso contrario decade la garanzia.\n"
        ."6. Si autorizza il trattamento dei dati personali in base art. 13 del D. Lgs. 196/2003.");
$pdfhtml->MultiCell(170,3.5,$string_dec,0,'L',0);
$pdfhtml->ln(5);
$pdfhtml->Cell(10);
$pdfhtml->SetFont('Arial','',8);
$pdfhtml->MultiCell(160,5,"Smartbit S.R.L. Via Casilina 343 Valmontone (RM) Tel.06/95995061 \nGrazie per aver scelto smartbit! Puoi tenere sotto controllo la riparazione inserendo il seriale nella pagina riportata dal link \nwww.microtelservice.it/tracking",0,'L',0);//EX C
$pdfhtml->ln(5);
$pdfhtml->Cell(90);
$pdfhtml->MultiCell(100,5,'Seriale riparazione',0,'C',0);
$y2 = $pdfhtml->getY();
$pdfhtml->MultiCell(100,5,'Firma',0,'C',0);
$pdfhtml->MultiCell(100,5,'___________',0,'C',0);
//$pdfhtml->EAN13(88.5,$y,$id_rip);
    $pdfhtml->Code39(130, $y2, $id_rip);
$pdfhtml->Line(20, $y2+13, 210-20, $y2+13); // 20mm from each edge
//$pdfhtml->Line(50, 45, 210-50, 45); // 50mm from each edge
$pdfhtml->Output('ticket1.pdf','I'); 
    


}


/*
?>$pdfhtml->Cell(70);
$pdfhtml->Cell(0,10,'Informazioni dispositivo ricevuto:','C');
$pdfhtml->ln(10);
$marca = $_GET['mar'];
$modello = $_GET['mod'];
$dataric = $_GET['ricf'];

//$pdfhtml->Cell(5);
$pdfhtml->MultiCell(190,5,'-Marca:'.$marca.' -Modello: '.$modello.' -Data ricezione: '.$dataric.' -IMEI: '.$imei_pdf,0,'C',0); 
$pdfhtml->ln(5);
$pdfhtml->Cell(75);
$pdfhtml->Cell(0,0,'Informazioni del Cliente:','C');
$pdfhtml->ln(5);
$nome_cliente_pd = $_GET['pp'];
$pdfhtml->Cell(60);
$pdfhtml->Cell(10,6, 'Nome: '.$nome_cliente_pd);
$cognome_cliente_pd = $_GET['ppc'];
$pdfhtml->Cell(30);
$pdfhtml->Cell(10,6, 'Cognome: '.$cognome_cliente_pd);
$pdfhtml->ln(5);
$pdfhtml->Cell(10);
$pdfhtml->Cell(170,10,'Descrizione difetto:',0, 0, 'C');
$pdfhtml->ln(8);
$desc = $_GET['desc'];
if($desc!==''){
    $pdfhtml->Cell(10);
    $pdfhtml->MultiCell(170,4,$desc,1,'C',0);
}
 * 
 */