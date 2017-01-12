$('a.print-repair').on('click',function(){
    var doc = new jsPDF();
    var code = ''+$('input[name="seriale"]').val();
 	JsBarcode("#barcode", code);
    var can = document.getElementById('barcode');
    doc.text(20, 30, 'Ricevuta riparazione per Smartbit');
    doc.setFontSize(10);
    doc.text(20, 40, $('.modello-ricevuta').text()+"\n"+
    $('.marca-ricevuta').text()+
    "\nImei:"+$('.imei-ricevuta').text()+"\nData ricezione: "+$('.today').text());
    doc.text(110, 40, 'Cliente:\n'+$('.nome-ricevuta').text()+"\n"+$('.cognome-ricevuta').text()+"\n"+$('.recapito-ricevuta').text());
    doc.text(20, 70,'Note:');
    doc.setDrawColor(255,171,0);
    doc.rect(25, 72, 160, 20);
    doc.setFontSize(8);
    doc.text(26, 75,''+$('.note-ricevuta').text());
    doc.setFontSize(8);
    doc.text(20,96,
    "1. Il cliente è pregato di ritirare il dispositivo riparato entro un massimo di 6 mesi (180 giorni) \n"+
    "che verranno contati a partire dal giorno dell'avvenuta riparazione. Passati 180 giorni la presente \n "+
    "ricevuta non sarà più valida.\n\n"+
    "2. la garanzia è di soli 3 mesi (90 giorni) che verranno contati a partire dal giorno dell'eventuale \n"+
    "riparazione del cellulare e copre solamente il guasto riparato. Dopo il ritiro del dispositivo non si \n"+
    "assume alcuna responsabilità per eventuali problemi che dovessero insorgere.\n\n"+
    "3. Si prega di rimuovere (se il dispositivo ne è munito o ne permette l'alloggiamento) sim-card e memory-card.\n\n"+
    "4. I dati del dispositivo devono essere trascritti, poichè c'è il rischio che durante la riparazione\n"+
    "essi possano essere cancellati.\n\n"+
    "5. Si prega di provare subito il dispositivo per controllare se funziona, in caso contrario decade la garanzia.\n\n"+
    "6. Si autorizza il trattamento dei dati personali in base art. 13 del D. Lgs. 196/2003.\n\n"+
    "Firma __________________\n\n"+
    "Smartbit S.R.L. Via Casilina 343 Valmontone (RM) Tel.06/95995061\n"+
    "Grazie per aver scelto smartbit!"
    );
    var data = can.toDataURL( "image/jpeg" );
    doc.addImage(data, 'JPEG', 80, 165);
    doc.addPage();
    doc.setFontSize(16);
    doc.text(20, 30, 'Ricevuta riparazione per Smartbit');
    doc.setFontSize(10);
    doc.text(20, 40, $('.modello-ricevuta').text()+"\n"+
    $('.marca-ricevuta').text()+
    "\nImei:"+$('.imei-ricevuta').text()+"\nData ricezione: "+$('.today').text());
    doc.text(110, 40, 'Cliente:\n'+$('.nome-ricevuta').text()+"\n"+$('.cognome-ricevuta').text()+"\n"+$('.recapito-ricevuta').text());
    doc.text(20, 70,'Note:');
    doc.setDrawColor(255,171,0);
    doc.rect(25, 72, 160, 20);
    doc.setFontSize(8);
    doc.text(26, 75,''+$('.note-ricevuta').text());
    doc.setFontSize(8);
    doc.text(20,96,
    "1. Il cliente è pregato di ritirare il dispositivo riparato entro un massimo di 6 mesi (180 giorni) \n"+
    "che verranno contati a partire dal giorno dell'avvenuta riparazione. Passati 180 giorni la presente \n "+
    "ricevuta non sarà più valida.\n\n"+
    "2. la garanzia è di soli 3 mesi (90 giorni) che verranno contati a partire dal giorno dell'eventuale \n"+
    "riparazione del cellulare e copre solamente il guasto riparato. Dopo il ritiro del dispositivo non si \n"+
    "assume alcuna responsabilità per eventuali problemi che dovessero insorgere.\n\n"+
    "3. Si prega di rimuovere (se il dispositivo ne è munito o ne permette l'alloggiamento) sim-card e memory-card.\n\n"+
    "4. I dati del dispositivo devono essere trascritti, poichè c'è il rischio che durante la riparazione\n"+
    "essi possano essere cancellati.\n\n"+
    "5. Si prega di provare subito il dispositivo per controllare se funziona, in caso contrario decade la garanzia.\n\n"+
    "6. Si autorizza il trattamento dei dati personali in base art. 13 del D. Lgs. 196/2003.\n\n"+
    "Firma __________________\n\n"+
    "Smartbit S.R.L. Via Casilina 343 Valmontone (RM) Tel.06/95995061\n"+
    "Grazie per aver scelto smartbit!"
    );
    var data = can.toDataURL( "image/jpeg" );
    doc.addImage(data, 'JPEG', 80, 165);
    doc.save('ricevuta_'+$('input[name="seriale"]').val()+'.pdf');
});

$('a.print-ddt').on('click',function(){
    
});