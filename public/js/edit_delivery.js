$('.date').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
        //format: 'dd-mm-yyyy'    
      });
      
//inizializzazione modal spedizione
 $('#edit-delivery-repairs a.edit-delivery-repair').each(function(){
     var list_item = $(this);
     $('#modal-chose-repair .modal-content .collection .collection-item').each(function(){
         var modal_item = $(this);
         if(list_item.data('id')==modal_item.data('id')){
             modal_item.addClass('hide');
             return;
         }
     });
 });
 var backup_old_repairs = new Object();
 var backup_old_center = new Object();
 var backup_old_date = $('input[name="date"]').val();
 var repairs_to_update_to_delivery = new Object();//Array();
 var center_to_add_to_delivery = new Object();//Array();
 center_to_add_to_delivery['id'] = $('#edit-delivery-center.collection .collection-item').data('id');
 center_to_add_to_delivery['indirizzo'] = $('#edit-delivery-center.collection .collection-item').data('address');
 center_to_add_to_delivery['recapito'] = $('#edit-delivery-center.collection .collection-item').data('rec');
 center_to_add_to_delivery['nome'] = $('#edit-delivery-center.collection .collection-item').data('title');
  $('#edit-delivery-repairs a.edit-delivery-repair').each(function(){
     repairs_to_update_to_delivery[$(this).data('id')] = $(this).data('show');
     backup_old_repairs[$(this).data('id')] = $(this).data('show');
 });
 console.log('dispositivi da spedire:');
 console.log(repairs_to_update_to_delivery);
 backup_old_center['id'] = $('#edit-delivery-center.collection .collection-item').data('id');
 backup_old_center['indirizzo'] = $('#edit-delivery-center.collection .collection-item').data('address');
 backup_old_center['recapito'] = $('#edit-delivery-center.collection .collection-item').data('rec');
 backup_old_center['nome'] = $('#edit-delivery-center.collection .collection-item').data('title');

  //fine inizializzazione
 
 //Activate Edit Mode
 $('a.activate-edit-mode-delivery').on('click',function(){
     $('a.update-delivery').removeClass('hide');
     $('a.delete-delivery').addClass('hide');
     $('a.go-delivery').addClass('hide');
     $('a.activate-edit-mode-delivery').addClass('hide');
     $('a.cancel-edit-delivery').removeClass('hide');
     $('input[name="date"]').removeAttr('disabled');
     $('input[name="date"]').prop('readonly',false).addClass('date');
     if($('input[name="date"]').hasClass('date')){
         $('.date').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
        });
     }
     
     $('a.trigger-to-add-repairs').removeClass('hide').addClass('edit-delivery-repair').attr('href','#modal-chose-repair');
     $('#edit-delivery-center.collection .collection-item').attr('href','#modal-chose-center');
     $('#edit-delivery-center.collection .collection-item').removeClass('edit-delivery-center');
     $('#edit-delivery-repairs.collection .collection-item span.secondary-content').removeClass('hide');
     $('#edit-delivery-center.collection .collection-item span.secondary-content').removeClass('hide');
 });
 
 //Deactivate Edit Mode
 $('a.cancel-edit-delivery').on('click',function(){
   
     $('input[name="center_to_update"]').val('');
       var a = '<a data-rec="'+backup_old_center['recapito']+'"'+
              'data-address="'+backup_old_center['indirizzo']+'"'+
              'data-title="'+backup_old_center['nome']+'"'+
              'data-id="'+backup_old_center['id']+'"'+
              'href="#modal-chose-center"'+
              'class="edit-delivery-center collection-item avatar">'+
              '<i class="material-icons smartbit circle">location_on</i>'+
              '<span class="title">'+backup_old_center['nome']+'</span>'+
              '<p class="truncate">'+backup_old_center['indirizzo']+'<br>'+
              'recapito: '+backup_old_center['recapito']+
              '</p>'+
              '<span class="secondary-content"><i class="material-icons">edit</i></span>'+
              '</a>';
       var header = $('#edit-delivery-center.collection .collection-header');
       $('#edit-delivery-center.collection').empty();
       $('#edit-delivery-center.collection').append(header);
       $('#edit-delivery-center.collection').append(a);
 $('#modal-chose-repair .modal-content .collection .collection-item').each(function(){
             if($(this).hasClass('active')){
                 $(this).removeClass('active').addClass('hide');
             }
         });
         $('input[name="repairs_to_update"]').val('');
         var header = $('#edit-delivery-repairs .collection-header');
         $('#edit-delivery-repairs').empty();
            $('#edit-delivery-repairs').append(header);
         for(id in backup_old_repairs){
             if(id !==null){
                 console.log('quelli che stanno per essere rimessi sono:');
                 console.log(backup_old_repairs[id]);
                 $('#edit-delivery-repairs').append(
                 '<a data-id="'+id+'"'+
                 'class="edit-delivery-repair collection-item"'+
                 'data-show="'+backup_old_repairs[id]+'">'+
                 backup_old_repairs[id]+
                 '<span style="cursor:pointer" class="remove-repair-from-delivery secondary-content">'+
                 '<i class="material-icons">delete</i></span></a>'
                 );
             }
         }
         for(var i=0;i<backup_old_repairs.length;i++){
                delete backup_old_repairs[i];
            }
         $('#edit-delivery-repairs a.edit-delivery-repair span.remove-repair-from-delivery').on('click',function(){
                var id = $(this).closest('a').data('id');
                remove_repairs_from_list(id);
 		    });
 	       center_to_add_to_delivery['id'] = $('#edit-delivery-center.collection .collection-item').data('id');
         center_to_add_to_delivery['indirizzo'] = $('#edit-delivery-center.collection .collection-item').data('address');
         center_to_add_to_delivery['recapito'] = $('#edit-delivery-center.collection .collection-item').data('rec');
         center_to_add_to_delivery['nome'] = $('#edit-delivery-center.collection .collection-item').data('title');
          $('#edit-delivery-repairs a.edit-delivery-repair').each(function(){
             repairs_to_update_to_delivery[$(this).data('id')] = $(this).data('show');
             backup_old_repairs[$(this).data('id')] = $(this).data('show');
         });
   $('input[name="date"]').val(backup_old_date);
   
     $('a.update-delivery').addClass('hide');
     $('a.go-delivery').removeClass('hide');
     $('a.delete-delivery').removeClass('hide');
     $('a.activate-edit-mode-delivery').removeClass('hide');
     $('a.cancel-edit-delivery').addClass('hide');
     $('input[name="date"]').attr('disabled','');
     $('input[name="date"]').prop('readonly',true).removeClass('date').removeClass('picker__input');
     
     $('a.trigger-to-add-repairs').addClass('hide').removeClass('edit-delivery-repair').attr('href','');
     $('#edit-delivery-center.collection .collection-item').attr('href','');
     $('#edit-delivery-center.collection .collection-item').removeClass('edit-delivery-center');
     $('#edit-delivery-repairs.collection .collection-item span.secondary-content').addClass('hide');
     $('#edit-delivery-center.collection .collection-item span.secondary-content').addClass('hide');
 });
 
 //gestione sul click del bottone per aggiungere riparazioni alla spedizione
 $('a[href="#modal-chose-repair"]').on('click',refresh_modal_repair_list);
 function refresh_modal_repair_list(){
     $('#modal-chose-repair .modal-content .collection .collection-item').each(function(){
         $(this).removeClass('active').removeClass('white-text');//css('color','#000000');
     });
 }
 
 //gestione rimozione riparazione per spedizione (NON MODAL)
 function remove_repairs_from_list(id){
     console.log('sto eliminando id n° '+id);
     delete repairs_to_update_to_delivery[id];
       console.log('riparazioni da aggiornare :');
       console.log(repairs_to_update_to_delivery);
        $('#modal-chose-repair .modal-content .collection .collection-item[data-id="'+
        id+'"]').removeClass('hide');
        $('#modal-chose-repair .modal-content .collection .collection-item[data-id="'+
        id+'"]').removeClass('white-text').addClass('black-text');
     $('#edit-delivery-repairs a.edit-delivery-repair[data-id="'+id+'"]').remove();
 }
 $('#edit-delivery-repairs a.edit-delivery-repair span.remove-repair-from-delivery').on(
     'click',function(){
        var id = $(this).closest('a').data('id');
        remove_repairs_from_list(id);
 });
 
 //gestione modal di scelta nuovo centro per spedizione
 $('#modal-chose-center .modal-content .collection .collection-item').on(
     'click',function(){
         center_to_add_to_delivery['id'] = null;
         center_to_add_to_delivery['nome'] = null;
         center_to_add_to_delivery['recapito'] = null;
         center_to_add_to_delivery['indirizzo'] = null;
     $('#modal-chose-center .modal-content .collection .collection-item').each(function(){
         $(this).removeClass('active white-text').addClass('smartbit-text');
         $(this).children('i').removeClass('smartbit-text white').addClass('smartbit');
         center_to_add_to_delivery['id'] = null;
         center_to_add_to_delivery['nome'] = null;
         center_to_add_to_delivery['recapito'] = null;
         center_to_add_to_delivery['indirizzo'] = null;
     });
     if($(this).hasClass('active')){
         center_to_add_to_delivery = null
         console.log('centro scelto: '+center_to_add_to_delivery);
         console.log(center_to_add_to_delivery);
         $(this).children('i').removeClass('smartbit').addClass('smartbit-text white');
         $(this).removeClass('active white-text').addClass('smartbit-text');
     }else{
         $(this).children('i').removeClass('smartbit').addClass('smartbit-text white');
         center_to_add_to_delivery['id'] = $(this).data('id');
         center_to_add_to_delivery['recapito'] = $(this).data('rec');
         center_to_add_to_delivery['indirizzo'] = $(this).data('address');
         center_to_add_to_delivery['nome'] = $(this).data('title');
         console.log('centro scelto: '+center_to_add_to_delivery);
         console.log(center_to_add_to_delivery);
         $(this).addClass('active white-text');
     }
 });
 
 //gestione modal di scelta di riparazioni
 $('#modal-chose-repair .modal-content .collection .collection-item').on(
     'click',function(){
     if($(this).hasClass('active')){
            delete repairs_to_update_to_delivery[$(this).data('id')];
            console.log('riparazioni scelte :');
            console.log(repairs_to_update_to_delivery);
         $(this).removeClass('active white-text');
     }else{
         //center_to_add_to_delivery = $(this).data('id');
         repairs_to_update_to_delivery[$(this).data('id')] = $(this).text();
         console.log('riparazioni scelte :');
         console.log(repairs_to_update_to_delivery);
         $(this).addClass('active white-text');
     }
 });
 
 //gestione modal per selezionare le riparazioni scelte
 $('#modal-chose-repair .modal-footer .update-repair-to-delivery').on(
     'click',function(){
         $('#modal-chose-repair .modal-content .collection .collection-item').each(function(){
             if($(this).hasClass('active')){
                 $(this).removeClass('active').addClass('hide');
             }
         });
         var json_reps = JSON.stringify(repairs_to_update_to_delivery);
         $('input[name="repairs_to_update"]').val(json_reps);
         var header = $('#edit-delivery-repairs .collection-header');
         $('#edit-delivery-repairs').empty();
            $('#edit-delivery-repairs').append(header);
         for(id in repairs_to_update_to_delivery){
             if(id !==null){
                 console.log('quelli che stanno per essere rimessi sono:');
                 console.log(repairs_to_update_to_delivery[id]);
                 $('#edit-delivery-repairs').append(
                 '<a data-id="'+id+'"'+
                 'class="edit-delivery-repair collection-item"'+
                 'data-show="'+repairs_to_update_to_delivery[id]+'">'+
                 repairs_to_update_to_delivery[id]+
                 '<span style="cursor:pointer" class="remove-repair-from-delivery secondary-content">'+
                 '<i class="material-icons">delete</i></span></a>'
                 );
             }
         }
         for(var i=0;i<repairs_to_update_to_delivery.length;i++){
                delete repairs_to_update_to_delivery[i];
            }
         $('#edit-delivery-repairs a.edit-delivery-repair span').on('click',function(){
                var id = $(this).closest('a').data('id');
                remove_repairs_from_list(id);
 		    });
     });
     
 //gestione modal per seleionare il centro scelto
 $('#modal-chose-center .modal-footer .add-center-to-delivery').on(
   'click',function(){
       $('input[name="center_to_update"').val(center_to_add_to_delivery['id']);
       var a = '<a data-rec="'+center_to_add_to_delivery['recapito']+'"'+
              'data-address="'+center_to_add_to_delivery['indirizzo']+'"'+
              'data-title="'+center_to_add_to_delivery['nome']+'"'+
              'data-id="'+center_to_add_to_delivery['id']+'"'+
              'href="#modal-chose-center"'+
              'class="edit-delivery-center collection-item avatar">'+
              '<i class="material-icons smartbit circle">location_on</i>'+
              '<span class="title">'+center_to_add_to_delivery['nome']+'</span>'+
              '<p>'+center_to_add_to_delivery['indirizzo']+'<br>'+
              'recapito: '+center_to_add_to_delivery['recapito']+
              '</p>'+
              '<span class="secondary-content"><i class="material-icons">edit</i></span>'+
              '</a>';
       var header = $('#edit-delivery-center.collection .collection-header');
       $('#edit-delivery-center.collection').empty();
       $('#edit-delivery-center.collection').append(header);
       $('#edit-delivery-center.collection').append(a);
   });
   
 //gestione dell'update finale
 $('.update-delivery').on('click',function(){
   console.log('dada settata: '+$('input[name="date"]').val());
   if(Object.keys(repairs_to_update_to_delivery).length == 0){
     Materialize.toast('Non puoi spedire 0 telefoni, che ne dici di eliminare la spedizione?', 4000);
     $('input[name="center_to_update"]').val('');
       var a = '<a data-rec="'+backup_old_center['recapito']+'"'+
              'data-address="'+backup_old_center['indirizzo']+'"'+
              'data-title="'+backup_old_center['nome']+'"'+
              'data-id="'+backup_old_center['id']+'"'+
              'href="#modal-chose-center"'+
              'class="edit-delivery-center collection-item avatar">'+
              '<i class="material-icons smartbit circle">location_on</i>'+
              '<span class="title">'+backup_old_center['nome']+'</span>'+
              '<p class="truncate">'+backup_old_center['indirizzo']+'<br>'+
              'recapito: '+backup_old_center['recapito']+
              '</p>'+
              '<span class="secondary-content"><i class="material-icons">edit</i></span>'+
              '</a>';
       var header = $('#edit-delivery-center.collection .collection-header');
       $('#edit-delivery-center.collection').empty();
       $('#edit-delivery-center.collection').append(header);
       $('#edit-delivery-center.collection').append(a);
 $('#modal-chose-repair .modal-content .collection .collection-item').each(function(){
             if($(this).hasClass('active')){
                 $(this).removeClass('active').addClass('hide');
             }
         });
         $('input[name="repairs_to_update"]').val('');
         var header = $('#edit-delivery-repairs .collection-header');
         $('#edit-delivery-repairs').empty();
            $('#edit-delivery-repairs').append(header);
         for(id in backup_old_repairs){
             if(id !==null){
                 console.log('quelli che stanno per essere rimessi sono:');
                 console.log(backup_old_repairs[id]);
                 $('#edit-delivery-repairs').append(
                 '<a data-id="'+id+'"'+
                 'class="edit-delivery-repair collection-item"'+
                 'data-show="'+backup_old_repairs[id]+'">'+
                 backup_old_repairs[id]+
                 '<span style="cursor:pointer" class="remove-repair-from-delivery secondary-content">'+
                 '<i class="material-icons">delete</i></span></a>'
                 );
             }
         }
         for(var i=0;i<backup_old_repairs.length;i++){
                delete backup_old_repairs[i];
            }
         $('#edit-delivery-repairs a.edit-delivery-repair span.remove-repair-from-delivery').on('click',function(){
                var id = $(this).closest('a').data('id');
                remove_repairs_from_list(id);
 		    });
 	       center_to_add_to_delivery['id'] = $('#edit-delivery-center.collection .collection-item').data('id');
         center_to_add_to_delivery['indirizzo'] = $('#edit-delivery-center.collection .collection-item').data('address');
         center_to_add_to_delivery['recapito'] = $('#edit-delivery-center.collection .collection-item').data('rec');
         center_to_add_to_delivery['nome'] = $('#edit-delivery-center.collection .collection-item').data('title');
          $('#edit-delivery-repairs a.edit-delivery-repair').each(function(){
             repairs_to_update_to_delivery[$(this).data('id')] = $(this).data('show');
             backup_old_repairs[$(this).data('id')] = $(this).data('show');
         });
   $('input[name="date"]').val(backup_old_date);
   
     $('a.update-delivery').addClass('hide');
     $('a.go-delivery').removeClass('hide');
     $('a.delete-delivery').removeClass('hide');
     $('a.activate-edit-mode-delivery').removeClass('hide');
     $('a.cancel-edit-delivery').addClass('hide');
     $('input[name="date"]').attr('disabled','');
     $('input[name="date"]').prop('readonly',true).removeClass('date').removeClass('picker__input');
     
     $('a.trigger-to-add-repairs').addClass('hide').removeClass('edit-delivery-repair').attr('href','');
     $('#edit-delivery-center.collection .collection-item').attr('href','');
     $('#edit-delivery-center.collection .collection-item').removeClass('edit-delivery-center');
     $('#edit-delivery-repairs.collection .collection-item span.secondary-content').addClass('hide');
     $('#edit-delivery-center.collection .collection-item span.secondary-content').addClass('hide');
     
   }else{
     var data_preview = {
            'repairs_update':repairs_to_update_to_delivery,
            'centers_update':center_to_add_to_delivery,
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
            'repairs_update':repairs_to_update_to_delivery,
            'centers_update':center_to_add_to_delivery,
            'date':$('input[name="date"]').val()
        },
        url : '/update-delivery/'+$('input[name="dlid_"]').val(),
        dataType: 'json',
        type: 'POST'
    }).done(function (data){
        backup_old_center = center_to_add_to_delivery;
        backup_old_repairs = repairs_to_update_to_delivery;
      console.log(data);
      console.log('----');
      console.log('backup_rapairs:');
      console.log(backup_old_repairs);
      console.log('----');
      console.log('backup_center:');
      console.log(backup_old_center);
      Materialize.toast('Modifiche salvate! 😀', 4000);
      $('a.update-delivery').addClass('hide');
     $('a.go-delivery').removeClass('hide');
     $('a.delete-delivery').removeClass('hide');
     $('a.activate-edit-mode-delivery').removeClass('hide');
     $('a.cancel-edit-delivery').addClass('hide');
     $('input[name="date"]').attr('disabled','');
     $('input[name="date"]').prop('readonly',true).removeClass('date').removeClass('picker__input');
     
     $('a.trigger-to-add-repairs').addClass('hide').removeClass('edit-delivery-repair').attr('href','');
     $('#edit-delivery-center.collection .collection-item').attr('href','');
     $('#edit-delivery-repairs.collection .collection-item span.secondary-content').addClass('hide');
     $('#edit-delivery-center.collection .collection-item span.secondary-content').addClass('hide');
    }).fail(function(){
        Materialize.toast('Qualcosa è andato storto 😕', 4000)
        //$('.progress').addClass('hide');
        //alert('State could not be changed.');
    });
   }
    
 });
   // FINE EDIT DELIVERY MANAGEMENT