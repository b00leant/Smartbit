$('.date').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
        //format: 'dd-mm-yyyy'    
      });
      
//inizializzazione modal spedizione
 $('#back-delivery-repairs a.back-delivery-repair').each(function(){
     var list_item = $(this);
     $('#modal-chose-repair-back .modal-content .collection .collection-item').each(function(){
         var modal_item = $(this);
         if(list_item.data('id')==modal_item.data('id')){
             modal_item.addClass('hide');
             return;
         }
     });
 });
 var backup_old_repairs_back = new Object();
 var backup_old_center_back = new Object();
 var backup_old_date_back = $('input[name="date"]').val();
 var repairs_to_update_to_delivery_back = new Object();//Array();
 var center_to_add_to_delivery_back = new Object();//Array();
 var repairs_to_pickup = new Object();
 center_to_add_to_delivery_back['id'] = $('#back-delivery-center.collection .collection-item').data('id');
 center_to_add_to_delivery_back['indirizzo'] = $('#back-delivery-center.collection .collection-item').data('address');
 center_to_add_to_delivery_back['recapito'] = $('#back-delivery-center.collection .collection-item').data('rec');
 center_to_add_to_delivery_back['nome'] = $('#back-delivery-center.collection .collection-item').data('title');
 console.log('il centro è:');
 console.log(center_to_add_to_delivery_back);
 $('#back-delivery-repairs.collection .back-delivery-repair').each(function(){
     repairs_to_update_to_delivery_back[$(this).data('id')] = $(this).data('show');
     backup_old_repairs_back[$(this).data('id')] = $(this).data('show');
 });
  console.log('i dispositivi da ritirare dal centro sono:');
 console.log(repairs_to_update_to_delivery_back);
 backup_old_center_back['id'] = $('#back-delivery-center.collection .collection-item').data('id');
 backup_old_center_back['indirizzo'] = $('#back-delivery-center.collection .collection-item').data('address');
 backup_old_center_back['recapito'] = $('#back-delivery-center.collection .collection-item').data('rec');
 backup_old_center_back['nome'] = $('#back-delivery-center.collection .collection-item').data('title');

 //fine inizializzazione
 
 //Activate Edit Mode
 $('a.activate-back-mode-delivery').on('click',function(){
     $('a.update-back-delivery').removeClass('hide');
     $('a.delete-delivery').addClass('hide');
     $('a.go-back-delivery').addClass('hide');
     $('a.activate-back-mode-delivery').addClass('hide');
     $('a.cancel-back-delivery').removeClass('hide');
     $('input[name="date"]').removeAttr('disabled');
     $('input[name="date"]').prop('readonly',false).addClass('date');
     if($('input[name="date"]').hasClass('date')){
         $('.date').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
        });
     }
     
     $('a.trigger-to-add-repairs-back').removeClass('hide').addClass('back-delivery-repair').attr('href','#modal-chose-repair-back');
     
     $('#back-delivery-repairs.collection .collection-item span.secondary-content').removeClass('hide');
 });
 
 //Deactivate Edit Mode
 $('a.cancel-back-delivery').on('click',function(){
   
     $('input[name="center_to_update"]').val('');
       
       var header = $('#edit-delivery-center.collection .collection-header');
       
 $('#modal-chose-repair-back .modal-content .collection .collection-item').each(function(){
             if($(this).hasClass('active')){
                 $(this).removeClass('active').addClass('hide');
             }
         });
         $('input[name="repairs_to_update"]').val('');
         var header = $('#back-delivery-repairs .collection-header');
         $('#back-delivery-repairs').empty();
            $('#back-delivery-repairs').append(header);
         for(id in backup_old_repairs_back){
             if(id !==null){
                 //console.log('quelli che stanno per essere rimessi sono:');
                 //console.log(backup_old_repairs[id]);
                 $('#back-delivery-repairs').append(
                 '<a data-id="'+id+'"'+
                 'class="back-delivery-repair collection-item"'+
                 'data-show="'+backup_old_repairs_back[id]+'">'+
                 backup_old_repairs_back[id]+
                 '<span style="cursor:pointer" class="remove-repair-from-delivery-back secondary-content">'+
                 '<i class="material-icons">delete</i></span></a>'
                 );
             }
         }
         for(var i=0;i<backup_old_repairs_back.length;i++){
                delete backup_old_repairs_back[i];
            }
         $('#back-delivery-repairs a.back-delivery-repair span').on('click',function(){
                var id = $(this).closest('a').data('id');
                remove_repairs_from_list(id);
 		    });
 	     
          $('#back-delivery-repairs a.back-delivery-repair').each(function(){
             repairs_to_update_to_delivery_back[$(this).data('id')] = $(this).data('show');
             backup_old_repairs_back[$(this).data('id')] = $(this).data('show');
         });
   $('input[name="date"]').val(backup_old_date_back);
   
     $('a.update-back-delivery').addClass('hide');
     $('a.go-back-delivery').removeClass('hide');
     $('a.activate-back-mode-delivery').removeClass('hide');
     $('a.cancel-back-mode-delivery').addClass('hide');
     $('input[name="date"]').attr('disabled','');
     $('input[name="date"]').prop('readonly',true).removeClass('date').removeClass('picker__input');
     
     $('a.trigger-to-add-repairs-back').addClass('hide').removeClass('back-delivery-repair').attr('href','');
     $('#back-delivery-center.collection .collection-item').attr('href','');
     $('#back-delivery-repairs.collection .collection-item span.secondary-content').addClass('hide');
     $('#back-delivery-center.collection .collection-item span.secondary-content').addClass('hide');
 });
 
 //gestione sul click del bottone per aggiungere riparazioni alla spedizione
 $('a[href="#modal-chose-repair-back"]').on('click',refresh_modal_repair_list());
 function refresh_modal_repair_list(){
     $('#modal-chose-repair-back .modal-content .collection .collection-item').each(function(){
         $(this).removeClass('active').removeClass('white-text');//css('color','#000000');
     });
 }
 
 //gestione rimozione riparazione per spedizione (NON MODAL)
 function remove_repairs_from_list(id){
     delete repairs_to_update_to_delivery_back[id];
       console.log('riparazioni da aggiornare :');
       console.log(repairs_to_update_to_delivery_back);
        $('#modal-chose-repair-back .modal-content .collection .collection-item[data-id="'+
        id+'"]').removeClass('hide');
     $('#back-delivery-repairs a.back-delivery-repair[data-id="'+id+'"]').remove();
 }
 $('#back-delivery-repairs a.back-delivery-repair span').on(
     'click',function(){
        var id = $(this).closest('a').data('id');
        remove_repairs_from_list(id);
 });
 
 //gestione modal di scelta di riparazioni
 $('#modal-chose-repair-back .modal-content .collection .collection-item').on(
     'click',function(){
     if($(this).hasClass('active')){
            delete repairs_to_update_to_delivery_back[$(this).data('id')];
            console.log('riparazioni scelte :');
            console.log(repairs_to_update_to_delivery_back);
         $(this).removeClass('active white-text');
     }else{
         //center_to_add_to_delivery = $(this).data('id');
         repairs_to_update_to_delivery_back[$(this).data('id')] = $(this).text();
         console.log('riparazioni scelte :');
         console.log(repairs_to_update_to_delivery_back);
         $(this).addClass('active white-text');
     }
 });
 
 //gestione modal per selezionare le riparazioni scelte
 $('#modal-chose-repair-back .modal-footer .update-repair-to-back-delivery').on(
     'click',function(){
         $('#modal-chose-repair-back .modal-content .collection .collection-item').each(function(){
             if($(this).hasClass('active')){
                 $(this).removeClass('active').addClass('hide');
             }
         });
         var json_reps = JSON.stringify(repairs_to_update_to_delivery_back);
         $('input[name="repairs_to_update"]').val(json_reps);
         var header = $('#back-delivery-repairs .collection-header');
         $('#back-delivery-repairs').empty();
            $('#back-delivery-repairs').append(header);
         for(id in repairs_to_update_to_delivery_back){
             if(id !==null){
                 //console.log('quelli che stanno per essere rimessi sono:');
                 //console.log(repairs_to_update_to_delivery[id]);
                 $('#back-delivery-repairs').append(
                 '<a data-id="'+id+'"'+
                 'class="back-delivery-repair collection-item"'+
                 'data-show="'+repairs_to_update_to_delivery_back[id]+'">'+
                 repairs_to_update_to_delivery_back[id]+
                 '<span style="cursor:pointer" class="remove-repair-from-delivery-back secondary-content">'+
                 '<i class="material-icons">delete</i></span></a>'
                 );
             }
         }
         for(var i=0;i<repairs_to_update_to_delivery_back.length;i++){
                delete repairs_to_update_to_delivery_back[i];
            }
         $('#back-delivery-repairs a.back-delivery-repair span').on('click',function(){
                var id = $(this).closest('a').data('id');
                remove_repairs_from_list(id);
 		    });
 		    console.log('riparazioni da ritirare');
 		    console.log(repairs_to_update_to_delivery_back);
     });
     
 //gestione dell'update finale
 $('.update-back-delivery').on('click',function(){
   console.log('dada settata: '+$('input[name="date"]').val());
   if(Object.keys(repairs_to_update_to_delivery_back).length == 0){
     Materialize.toast('Non puoi ritirare 0 telefoni, che ne dici di eliminare il ritiro?', 4000);
   }else{
     var data_preview = {
            'repairs_update':repairs_to_update_to_delivery_back,
            'date':$('input[name="date"]').val()
        };
    console.log('si sta per richiedere: ');
    console.log(data_preview);
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        data:{
            'repairs_update':repairs_to_update_to_delivery_back,
            'date':$('input[name="date"]').val()
        },
        url : '/update-pickup/'+$('input[name="dlid_"]').val(),
        dataType: 'json',
        type: 'POST'
    }).done(function (data){
        backup_old_center_back = center_to_add_to_delivery_back;
        backup_old_repairs_back = repairs_to_update_to_delivery_back;
      console.log(data);
      console.log('----');
      console.log('backup_rapairs:');
      console.log(backup_old_repairs_back);
      console.log('----');
      console.log('backup_center:');
      console.log(backup_old_center_back);
      Materialize.toast('Modifiche salvate! 😀', 4000);
      $('a.update-back-delivery').addClass('hide');
     $('a.go-back-delivery').removeClass('hide');
     $('a.activate-back-mode-delivery').removeClass('hide');
     $('a.cancel-back-delivery').addClass('hide');
     $('input[name="date"]').attr('disabled','');
     $('input[name="date"]').prop('readonly',true).removeClass('date').removeClass('picker__input');
     
     $('a.trigger-to-add-repairs-back').addClass('hide').removeClass('back-delivery-repair').attr('href','');
     $('#back-delivery-center.collection .collection-item').attr('href','');
     $('#back-delivery-repairs.collection .collection-item span.secondary-content').addClass('hide');
     $('#back-delivery-center.collection .collection-item span.secondary-content').addClass('hide');
    }).fail(function(){
        Materialize.toast('Qualcosa è andato storto 😕', 4000)
        //$('.progress').addClass('hide');
        //alert('State could not be changed.');
    });
   }
    
 });
   // FINE EDIT DELIVERY MANAGEMENT