
$(document).ready(function(){
    $('.phone-box').materialbox();
  });

$('input[type="radio"]').on('click',function(){
    if($('input#phone').is(':checked')){
        $('.dev-input, .imei-input').removeClass('hide');
        $('.brand-input, .model-input').addClass('hide');
        $('input.autocomplete.devices, input.imei').prop('required',true);
    }if($('input#other').is(':checked')){
        $('input.autocomplete.devices, input.imei').removeAttr('required');
        $('.dev-input, .imei-input').addClass('hide');
        $('input#model-dev').val('');
        $('input#brand-dev').val('');
        $('.brand-input, .model-input').removeClass('hide');
    }
});

function load_img(model){
    $('.preloader-image-phone').removeClass('hide');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            }
        });
    $.ajax({
        dataType: 'html',
        url:'/phone-arena-img/'+model,
        type: 'GET',
        data:{
        },
        success: function(result){
            //console.log(result);
            var parent_search = $($.parseHTML(result)).find('div#phones');
            console.log(parent_search);
            var tips = new Object();
            var f_c = $(parent_search).find('div.s_listing div.s_block_4:first');
                console.log('this is '+this);
                var src = $(f_c).find('a img').attr('src');
                console.log(src);
                $('img.responsive-img-phone').attr('src',src);
                $('.preloader-image-phone').addClass('hide');
        },
        error: function (xhr, b, c) {
            console.log('response error: \n');
            console.log(xhr);
            console.log(b);
            console.log(c);
            }
    });
}
var pas = false;
function openingHours(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                'Access-Control-Allow-Origin': '*'
            }
        });
    $.ajax({
        dataType: 'jsonp',
        url:'https://maps.googleapis.com/maps/api/place/details/json',
        type: 'GET',
        data:{
            'placeid':'ChIJKUz510t8JRMRVPfw2-GzWHM',
            'key':'AIzaSyAAK6y8tZ4VlyEKfCUzV7LvxTNLN6Me6S8'
        },
        success: function(result){
            console.log(result);
            
        },
        error: function (xhr, b, c) {
            console.log('response error: \n');
            console.log(xhr);
            console.log(b);
            console.log(c);
            }
    });
}

var clicky;

    $(document).mousedown(function(e) {
        // The latest element clicked
        clicky = $(e.target);
    });

    // when 'clicky == null' on blur, we know it was not caused by a click
    // but maybe by pressing the tab key
    $(document).mouseup(function(e) {
        clicky = null;
    });

$('.brand-logo').on('mouseover',function(){
    $('.brand-logo-part').css('color','#ffab00');
});
$('.brand-logo').on('mouseout',function(){
    $('.brand-logo-part').css('color','#fff');
});
function handleFocusOut(){
    $('ul.pagination').show();
    $('input.people.autocomplete2show').val('');
    $('input.repairs.autocomplete2showREP').val('');
    $('div.collection.with-header.people').show();
    $('div.collection.with-header.repairs').show();
    $('ul.dropdown-content').hide();
}

function handleCollectionShowPeople(){
    if($('input.autocomplete.people').val()!=''){
        $('ul.pagination').hide();
        $('div.collection.with-header.people').hide();
        $('ul.dropdown-content').show();
    }else{
        $('div.collection.with-header.people').show();
        $('ul.pagination').show();
        $('ul.dropdown-content').hide();
    }
}
function handleCollectionShowRepairs(){
    if($('input.autocomplete2showREP.repairs').val()!=''){
        $('ul.pagination').hide();
        $('div.collection.with-header.repairs').hide();
        $('ul.dropdown-content').show();
    }else{
        $('div.collection.with-header.repairs').show();
        $('ul.pagination').show();
        $('ul.dropdown-content').hide();
    }
}




$('.autocomplete-content').on('click', 'li', function () {            
     $('.autocomplete-content').hide();
});

$('input.autocomplete.devices').on('keyup',function(){ $('.autocomplete-content').show();})

$.fn.searchModels = function(){
    var $autocomplete = $('<ul style="width: 100%;position: absolute;"class="autocomplete-content dropdown-content"></ul>');
    $('input.autocomplete.devices').keyup(function(){
        if($('input.autocomplete.devices').val()==''){
            $('.device-preloader').addClass('hide');
            $('.help-button').removeClass('hide');
        }else{
            $('.device-preloader').removeClass('hide');
            $('.help-button').addClass('hide');
        }
        
        $('input[name="brand"]').val('');
        $('img.responsive-img-phone').attr('src','');
        $('input[name="model"]').val('');
        console.log('sto cercando.. '+$('input.autocomplete.devices').val());
        $('ul.autocomplete.content.dropdown-content').remove();
        var $input = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                
            }
        });
        $.ajax({
            url:'https://fonoapi.freshpixl.com/v1/getdevice',
            type: 'GET',
            data:{
                'token':'15045954778ae6eec5a699010275f8def0c38edc83b69bab',
                'device':$input.val(),
                'limit':'10',
            },
            success: function(result){
                $input.focusout(function(){
                    if(clicky != null){
                        console.log(clicky[0].className);
                    }
                    
                    if($('input[name="brand"]').val()=='' && $('input[name="model"]').val()==''){
                    $('input.devices').val('');
                    if(clicky[0].className != 'device-list-ajax'){
                        $autocomplete.empty();
                    }else{
                        console.log('beccato!');
                    }
                }
                });
                console.log(result);
                
                if(result.status === 'error' && !pas && $('input.devices').val() != ''){
                    console.log('non trovato. chiamo phonearena');
                    pas = true;
                    $('.help-button').addClass('hide');
                    $('.device-preloader').removeClass('hide');
                    try_phone_arena($input.val());
                }else{
                    pas = false;
                    console.log('inserisco risultati in lista');
                    $autocomplete.empty();
                    $('input.autocomplete.devices').after($autocomplete);
                    $('.device-preloader').addClass('hide');
                    $('.help-button').removeClass('hide');
                    if($input.val()!=''){
                        for(var i = 0; i < 6; i++){
                            if(result[i]){
                                var autocompleteOption = $('<li data-model="'+result[i].DeviceName+'" data-brand="'+result[i].Brand+'"></li>');
                                autocompleteOption.append('<span class="device-list-ajax">'+result[i].DeviceName+'</span>');
                                $autocomplete.append(autocompleteOption);
                            }
                        }
                    }else{
                    }
                
                    $autocomplete.on('click', 'li', function () {
                    $('button.insert_person i').html('send');
                    $('input[name="model"]').val($(this).data('model'));
                    $('input[name="brand"]').val($(this).data('brand'));
                    load_img($(this).data('model'));
                    $input.val($(this).text().trim());
                    $input.trigger('change');
                    $autocomplete.empty();
                  });
                }
            },
            error: function (xhr, b, c) {
                var $insert_person_i = $('a.insert_person i');
                $insert_person_i.text('add');
                console.log('response error: \n');
                console.log(xhr);
                console.log(b);
                console.log(c);
                }
        });
    });
        
};

function try_phone_arena(term){
    $('.help-button').addClass('hide');
    $('.device-preloader').removeClass('hide');
    $('input.autocomplete.devices').keyup(function(){
        if($('input.autocomplete.devices').val() == ''){
            $('.device-preloader').addClass('hide');
            $('.help-button').removeClass('hide');
        }else{
            
        }
        pas = false;
        $autocomplete.empty();
    });
    $('input[name="brand"]').val('');
    $('img.responsive-img-phone').attr('src','');
    $('input[name="model"]').val('');
    console.log('sto cercando in phonearena.. '+$('input.autocomplete.devices').val());
    $('ul.autocomplete-content.dropdown-content').remove();
    var $autocomplete = $('<ul class="autocomplete-content dropdown-content"></ul>');
    var $input = $('input.autocomplete.devices'); //$(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        crossOrigin: true,
        url:'/search-phonearena/'+term,
        type: 'GET',
        dataType:'html',
        data:{
            //'term':$input.val()
        },
        success: function(result){
            $input.focusout(function(){
                    if(clicky != null){
                        console.log(clicky[0].className);
                    }
                    
                    if($('input[name="brand"]').val()=='' && $('input[name="model"]').val()==''){
                    $('input.devices').val('');
                    if(clicky[0].className != 'device-list-ajax'){
                        $autocomplete.empty();
                    }else{
                        console.log('beccato!');
                    }
                }
                });
            var parent_search = $($.parseHTML(result)).find('div#phones');
            console.log(parent_search);
            var tips = new Object();
            var f_c = $(parent_search).find('div.s_listing div.s_block_4').each(function(){
                console.log('this is '+this);
                
                var nameminus = $(this).find('h3 a:not(span a)').attr('href').split('/')[2];
                //console.log(nameminus);
                var nameonly = nameminus.split('_')[0];
                var nametip = nameonly.replace(/-/g, " ");
                var brand = nametip.split('_')[0];
                
                //nametip = nametip.replace('Review', "");
                //nametip = nametip.replace('Plus', "");
                //tips[nametip] = $(this).find('h3 a:not(span a)').attr('href');
                tips[nametip] = {
                    'brand':brand,
                    'model':nametip
                }
                console.log(nametip);
                nametip = ''+nametip;
            });
            console.log(tips);
            $('input.autocomplete.devices').after($autocomplete);
            
            //show_phone_arena_tips(tips);
            if($input.val()!=''){
                            for(device in tips){
                                if(device){
                                    console.log('device iterated is');
                                    console.log(device);
                                    var autocompleteOption = $('<li data-model="'+device+'" data-brand="'+device.split(' ')[0]+'"></li>');
                                    autocompleteOption.append('<span class="device-list-ajax">'+device+'</span>');
                                    $autocomplete.append(autocompleteOption);
                                }
                            }
                            $('.device-preloader').addClass('hide');
                            $('.help-button').removeClass('hide');
                            pas = false;
                    }else{
                    }
                
                $autocomplete.on('click', 'li', function () {
                $('button.insert_person i').html('send');
                $('input[name="model"]').val($(this).data('model'));
                $('input[name="brand"]').val($(this).data('brand'));
                console.log('model is '+$(this).data('model'));
                load_img($(this).data('model'));
                $input.val($(this).text().trim());
                $input.trigger('change');
                $autocomplete.empty();
            });
        },
        error: function (xhr, b, c) {
            var $insert_person_i = $('a.insert_person i');
            $insert_person_i.text('add');
            console.log('response error: \n');
            console.log(xhr);
            console.log(b);
            console.log(c);
            }
    });
}
$('input.autocomplete.devices').searchModels();

function autocompletePeople(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var people = {
        'data':{}
    };
    $.ajax({
        url:'/ajax-people',
        type: 'GET',
        success: function(dat){
            var len = dat.length;
            for (var i = 0; i < len; i++) {
              var nome_cognome = dat[i].nome+" "+dat[i].cognome;
              var peopledata = people['data'];
              var info = {'nome':dat[i].nome,'cognome':dat[i].cognome,'id':dat[i].id}
              peopledata[nome_cognome] = info;
            }
            //console.log(data);
            $('input.autocomplete.people').autocompletesb(people);
            $('input.autocomplete2show.people').autocompletesb2show(people);
        },
        error: function (xhr, b, c) {
            var $insert_person_i = $('a.insert_person i');
            $insert_person_i.text('add');
            console.log('response error: \n');
            console.log(xhr);
            console.log(b);
            console.log(c);
            }
});
}

$.fn.autocompletesb = function(options){
    // Defaults
    var defaults = {
        data: {}
    };
    options = $.extend(defaults, options);

    return this.each(function() {
        var $input = $(this);
        var data = options.data,
            $inputDiv = $input.closest('.input-field'); // Div to append on
        //console.log(options);
        // Check if data isn't empty
        if (!$.isEmptyObject(data)) {
            // Create autocomplete element
            var $autocomplete = $('<ul class="autocomplete-content dropdown-content"></ul>');
        
            // Append autocomplete element
            if ($inputDiv.length) {
                $inputDiv.append($autocomplete); // Set ul in body
            }
            else{
                $input.after($autocomplete);
            }
            var highlight = function(string, $el) {
                var img = $el.find('img');
                var matchStart = $el.text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
                    matchEnd = matchStart + string.length - 1,
                    beforeMatch = $el.text().slice(0, matchStart),
                    matchText = $el.text().slice(matchStart, matchEnd + 1),
                    afterMatch = $el.text().slice(matchEnd + 1);
                $el.html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
                if (img.length) {
                    $el.prepend(img);
                }
            };
            // Perform search
            $input.on('keyup', function (e) {
            // Capture Enter
            if (e.which === 13) {
                $autocomplete.find('li').first().click();
                //return;
            }else{
                $('button.insert_person i').html('add');
            }
    
            var val = $input.val().toLowerCase();
            $autocomplete.empty();
    
            // Check if the input isn't empty
            if (val !== '') {
                $('input[name="id"]').val('');
                $('input[name="nome"]').val('');
                $('input[name="cognome"]').val('');
                var i = 0;
                for(var key in data) {
                    if (data.hasOwnProperty(key) &&
                        key.toLowerCase().indexOf(val) !== -1 &&
                        key.toLowerCase() !== val && i < 6) {
                            var autocompleteOption = $('<li data-id="'+data[key].id+'" data-nome="'+data[key].nome+'" data-cognome="'+data[key].cognome+'"></li>');
                            autocompleteOption.append('<span>'+ key +'</span>');
                            $autocomplete.append(autocompleteOption);
                            highlight(val, autocompleteOption);
                            i++;
                        }else{
                            /*
                            var autocompleteOption = $('<li><span>Aggiungi Cliente</span></li>');
                            $autocomplete.append(autocompleteOption);
                            return false;
                            */
                        }
                }
            }else{
            }
        });
        // Set input value
        $autocomplete.on('click', 'li', function () {
            $('button.insert_person i').html('send');
            $('input[name="id"]').val($(this).data('id'));
            $('input[name="nome"]').val($(this).data('nome'));
            $('input[name="cognome"]').val($(this).data('cognome'));
            $input.val($(this).text().trim());
            $input.trigger('change');
            $autocomplete.empty();
            });
        }
    });
};

$.fn.autocompletesb2show = function(options){
    // Defaults
    var defaults = {
        data: {}
    };
    options = $.extend(defaults, options);

    return this.each(function() {
        var $input = $(this);
        var data = options.data,
            $inputDiv = $input.closest('.input-field'); // Div to append on
        //console.log(options);
        // Check if data isn't empty
        if (!$.isEmptyObject(data)) {
            // Create autocomplete element
            var $autocomplete = $('<ul class="autocomplete-content dropdown-content"></ul>');
        
            // Append autocomplete element
            if ($inputDiv.length) {
                $inputDiv.append($autocomplete); // Set ul in body
            }
            else{
                $input.after($autocomplete);
            }
            var highlight = function(string, $el) {
                var img = $el.find('img');
                var matchStart = $el.text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
                    matchEnd = matchStart + string.length - 1,
                    beforeMatch = $el.text().slice(0, matchStart),
                    matchText = $el.text().slice(matchStart, matchEnd + 1),
                    afterMatch = $el.text().slice(matchEnd + 1);
                $el.html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
                if (img.length) {
                    $el.prepend(img);
                }
            };
            // Perform search
            $input.on('keyup', function (e) {
            // Capture Enter
            if (e.which === 13) {
                $autocomplete.find('li').first().click();
                //return;
            }else{
                $('button.insert_person i').html('add');
            }
    
            var val = $input.val().toLowerCase();
            $autocomplete.empty();
    
            // Check if the input isn't empty
            if (val !== '') {
                $('input[name="id"]').val('');
                $('input[name="nome"]').val('');
                $('input[name="cognome"]').val('');
                var i=0;
                for(var key in data) {
                    if (data.hasOwnProperty(key) &&
                        key.toLowerCase().indexOf(val) !== -1 &&
                        key.toLowerCase() !== val && i<6) {
                            var autocompleteOption = $('<li data-id="'+data[key].id+'" data-nome="'+data[key].nome+'" data-cognome="'+data[key].cognome+'"></li>');
                            autocompleteOption.append('<a href="/person/'+data[key].id+'"><span>'+ key +'</span></a>');
                            $autocomplete.append(autocompleteOption);
                            i++;
                            //highlight(val, autocompleteOption);
                        }else{
                            /*
                            var autocompleteOption = $('<li><span>Aggiungi Cliente</span></li>');
                            $autocomplete.append(autocompleteOption);
                            return false;
                            */
                        }
                }
            }else{
                $autocomplete.empty();
                handleFocusOut();
            }
        });
        // Set input value
        $autocomplete.on('click', 'li', function () {
            $input.val($(this).text().trim());
            $autocomplete.empty();
            //handleFocusOut();
            });
        }
    });
};

$('.datanascita').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 250 // Creates a dropdown of 15 years to control year
  });

function handleFocusOutDevices(){
    if($('input[name="brand"]').val()=='' && $('input[name="model"]').val()==''){
        $('input.devices').val('');
    }
}

function handleKeyUpDevices(){
}

$('input.autocomplete.devices').focusout(function(){
    if($('input[name="brand"]').val()=='' && $('input[name="model"]').val()==''){
        $(this).val('');
    }
});

$('input.autocomplete2show.people').focusout(function(){
    $(this).val('');
});

function getRepairs(page) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : 'repairs-pagination?page=' + page,
        dataType: 'json',
        type: 'POST'
    }).done(function (data) {
        console.log(data);
        var pagination = $('ul.pagination.repairs');
        pagination.empty();
        pagination.css('text-align','center');
        var header = $('div.collection.with-header.repairs div.collection-header');
        $('div.collection.with-header.repairs').empty();
        //$('div#rip.collection.with-header.container').css('border','0px solid');*/
        $('div.collection.with-header.repairs').append(header);
        for(var i = 0; i < data.data.length; i++){
            var repair = '';
            var href_rip = 'href="/repair/'+data.data[i].id+'"';
            switch(data.data[i].stato){
                case 'creata':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Creata"'+
                    'style="color:grey">hourglass_empty</i>'+
                    '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'iniziata':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Iniziata"'+
                    'style="color:grey">done</i>'+
                     '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'finita':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Finita (non ancora pronta)"'+
                    'style="color:grey">done_all</i>'+
                     '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'in_lista_per_centro':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="In lista per l\'assistenza"'+
                    'style="color:grey">local_shipping</i>'+
                     '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'in_assistenza':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="In centro assistenza"'+
                    'style="color:grey">location_on</i>'+
                     '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'pronta':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Pronta per il ritiro"'+
                    'style="color:#4CAF50">done_all</i>'+
                    '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'ritirata_dal_centro_assistenza':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Tornata dall\'assistenza"'+
                    'style="color:#4CAF50">done_all</i>'+
                    '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case 'consegnata':
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Consegnata"'+
                    'style="color:#4CAF50">tag_faces</i>'+
                    '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                case null:
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="senza stato"'+
                    'style="color:grey">error</i>'+
                     '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
                default:
                    repair = '<a '+href_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="senza stato"'+
                    'style="color:grey">error</i>'+
                     '</div>Modello: '+data.data[i].device.model+' ('+data.data[i].person.nome+' '+data.data[i].person.cognome+')';
                    if(data[i].garanzia){
                       repair = repair + '<span data-badge-caption="" class="new badge green" style="margin-right:0.5em">garanzia</span>';
                    }
                    repair = repair +'</a>';
                    break;
            }
            $('div.collection.with-header.repairs').append(repair);
            $('.tooltipped').tooltip({delay: 50});
        }
        for(var i = 0; i <= (data.last_page); i++){
            if(i == 0){
                var prev_page = data.current_page - 1;
                if(data.current_page == i + 1){
                    pagination.append('<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>');
                }else{
                    pagination.append('<li class="waves-effect"><a href="page='+prev_page+'"><i class="material-icons">chevron_left</i></a></li>');
                }
            }
            if(i == (data.last_page)){
                if(data.current_page == data.last_page){
                    pagination.append('<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>');
                }else{
                    pagination.append('<li class="waves-effect"><a href="page='+(data.current_page + 1)+'"><i class="material-icons">chevron_right</i></a></li>');
                }
            }else{
                if( (i + 1) == data.current_page){
                    pagination.append('<li class="active"><a  href="page='+(i + 1)+'">'+(i + 1)+'</a></li>');
                }else{
                    pagination.append('<li class="waves-effect"><a href="page='+(i + 1)+'">'+(i + 1)+'</a></li>');
                }
            }
        }
        $('div.collection.with-header.repairs').append(pagination);
        //$('.posts').html(data);
        //location.hash = page;
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}

function getPeople(page) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : 'people-pagination?page=' + page,
        dataType: 'json',
        type: 'POST'
    }).done(function (data) {
        console.log(data);
        var pagination = $('ul.pagination.people');
        pagination.empty();
        pagination.css('text-align','center');
        var header = $('div#ppl.container div.collection.with-header div.collection-header');
        $('div#ppl.container div.collection.with-header').empty();
        //$('div#ppl.container div.collection.with-header').css('border','0px solid');*/
        $('div#ppl.container div.collection.with-header').append(header);
        for(var i = 0; i < data.data.length; i++){
            //var info_rips;
            /*if(data.data[i].repairs.length==1){
                info_rips = 'una riparazione';
            }else{
                info_rips = data.data[i].repairs.length+' riparazioni';
            }*/
            var person = '<a href="/person/'+data.data[i].id+'" class="collection-item avatar">'+
                    '<i class="material-icons circle  amber accent-4">perm_identity</i>'+
                    '<span class="title">'+data.data[i].nome+' '+data.data[i].cognome+'</span>'+
                    '<p>X riparazioni in corso<br>0 debiti</p>'+
                    //'<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>'+
                '</a>';
                $('div#ppl.container div.collection.with-header').append(person);
        }
        for(var i = 0; i <= (data.last_page); i++){
            if(i == 0){
                var prev_page = data.current_page - 1;
                if(data.current_page == i + 1){
                    pagination.append('<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>');
                }else{
                    pagination.append('<li class="waves-effect"><a href="page='+prev_page+'"><i class="material-icons">chevron_left</i></a></li>');
                }
            }
            if(i == (data.last_page)){
                if(data.current_page == data.last_page){
                    pagination.append('<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>');
                }else{
                    pagination.append('<li class="waves-effect"><a href="page='+(data.current_page + 1)+'"><i class="material-icons">chevron_right</i></a></li>');
                }
            }else{
                if( (i + 1) == data.current_page){
                    pagination.append('<li class="active"><a  href="page='+(i + 1)+'">'+(i + 1)+'</a></li>');
                }else{
                    pagination.append('<li class="waves-effect"><a href="page='+(i + 1)+'">'+(i + 1)+'</a></li>');
                }
            }
        }
        $('div#ppl.container div.collection.with-header').append(pagination);
        //$('.posts').html(data);
        //location.hash = page;
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}

function getLab(page) {
    $(this).href=
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : 'lab-pagination?page=' + page,
        dataType: 'json',
        type: 'POST'
    }).done(function (data) {
        console.log(data);
        var container = $('div#lab.collection.with-header.container');
        for(var i = 0; i < data.data.length; i++){
            var repair = '';
            console.log(data.data[i].stato);
            var id_rip = 'data-id="'+data.data[i].id+'"';
            var href_rip = 'href="/repair/'+data.data[i].id+'"';
            switch(data.data[i].stato){
                case 'creata':
                    repair = '<a '+id_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Creata"'+
                    'style="color:grey">hourglass_empty</i>'+
                    '</div>ID: '+data.data[i].id+' desc:'+data.data[i].note+'</a>';
                    break;
                case 'iniziata':
                    repair = '<a '+id_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Iniziata"'+
                    'style="color:grey">done</i>'+
                    '</div>ID: '+data.data[i].id+' desc:'+data.data[i].note+'</a>';
                    break;
                case 'finita':
                    repair = '<a '+id_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Finita (non ancora pronta)"'+
                    'style="color:grey">done_all</i>'+
                    '</div>ID: '+data.data[i].id+' desc:'+data.data[i].note+'</a>';
                    break;
                case 'pronta':
                    repair = '<a '+id_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="Pronta per il ritiro"'+
                    'style="color:#4CAF50">done_all</i>'+
                    '</div>ID: '+data.data[i].id+' desc:'+data.data[i].note+'</a>';
                    break;
                case null:
                    repair = '<a '+href_rip+id_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="senza stato"'+
                    'style="color:grey">error</i>'+
                    '</div>ID: '+data.data[i].id+' desc:'+data.data[i].note+'</a>';
                    break;
                default:
                    repair = '<a '+id_rip+' data-activates="slide-lab" '+
                    ' class="collection-item lab-item updated">'+
                    '<div class="secondary-content">'+
                    '<i class="tooltipped material-icons" data-tooltip="senza stato"'+
                    'style="color:grey">error</i>'+
                    '</div>ID: '+data.data[i].id+' desc:'+data.data[i].note+'</a>';
                    break;
            }
            container.append(repair);
            $('.tooltipped').tooltip({delay: 50});
        }
        $('a.lab-item.updated').on('click',function(){
            load_repair_info($(this).data('id'));
        });
        $('a.lab-item.updated').sideNav({
                  menuWidth: '100%', // Default is 240
                  edge: 'right', // Choose the horizontal origin
                  closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                  draggable: false // Choose whether you can drag to open on touch screens
            });
        if(data.next_page_url =='null' || data.next_page_url == null){
            $('a.refresh-lab').attr('href','');
            $('a.refresh-lab').hide();
        }else{
            $('a.refresh-lab').attr('href','page='+(parseInt($('a.refresh-lab').attr('href').split('page=')[1]) + 1));
        }
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}

function load_repair_info(id){
    $('.info_owner, .info_device, .note_lab, .note_rip, .change-state-lab, .update-lab, .finish-state-lab, .deliverable-lab').addClass('hide');
    $('.preloader-wrapper').removeClass('hide');
    console.log('I am about to search id:' + id);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        data: {'id':id},
        url : 'repair-info',
        dataType: 'json',
        type: 'POST'
        }).done(function(data){
            setTimeout(function(){
                $('.info_owner, .info_device, .note_lab, .note_rip').removeClass('hide');
                $('.preloader-wrapper').addClass('hide');
                console.log(data);
                $('.repair_info_nome').empty().text('Nome: '+data.person.nome);
                $('.repair_info_cognome').empty().text('Cognome: '+data.person.cognome);
                $('.repair_info_tel').empty().text('Telefono: '+data.person.telefono);
                $('.repair_info_modello').empty().text('Modello: '+data.device.model);
                $('.repair_info_marca').empty().text('Marca: '+data.device.brand);
                $('.repair_info_imei').empty().text('Imei: '+data.device.imei);
                switch(data.stato){
                    case 'creata':
                        $('.update-lab').addClass('hide');
                        $('.finish-state-lab').addClass('hide');
                        $('.change-state-lab').removeClass('hide');
                        $('.note-field').addClass('hide');
                        $('.note-field1 textarea').val(data.note);
                        $('.note-field label').addClass('active');
                        $('.note-field1 label').addClass('active');
                        $('button.change-state-lab').text('Ripara');
                        $('input.change-state-lab').val(data.id)
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').text('hourglass_empty');
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').css('color','grey');
                        
                        break;
                    case 'iniziata':
                        $('.finish-state-lab').removeClass('hide');
                        $('.change-state-lab').addClass('hide');
                        $('.note-field').removeClass('hide');
                        $('.update-lab').removeClass('hide');
                        
                        $('.note-field1 textarea').val(data.note);
                        $('.note-field textarea').val(data.note_lab);
                        $('.note-field label').addClass('active');
                        $('.note-field1 label').addClass('active');
                        $('button.change-state-lab').text('Finisci');
                        if(data.assistenza === true){
                        }else{
                            $('.deliverable-lab').removeClass('hide');
                            $('div#modal-deliverable.modal .modal-footer a.set-deliverable').prop('href','/set-deliverable-lab/'+data.id);
                        }
                        $('div#modal-change.modal .modal-footer a.finish-action').prop('href','/finish-state-lab/'+data.id);
                        $('input.change-state-lab').val(data.id);
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').text('done');
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').css('color','grey');
                        
                        break;
                    case 'ritirata_dal_centro_assistenza':
                        $('.update-lab').addClass('hide');
                        $('.finish-state-lab').addClass('hide');
                        $('.change-state-lab').removeClass('hide');
                        $('.note-field').addClass('hide');
                        $('.note-field1 textarea').val(data.note);
                        $('.note-field label').addClass('active');
                        $('.note-field1 label').addClass('active');
                        $('button.change-state-lab').text('Ripara');
                        $('input.change-state-lab').val(data.id)
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').text('hourglass_empty');
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').css('color','grey');
                        break;
                    /*default:
                        $('.update-lab').addClass('hide');
                        break;*/
                    /*case 'finita':
                        $('button.change-state-lab').removeClass('change-state').text('Quì hai finito');
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').text('done_all');
                        $('div#lab.collection a[data-id="'+data.id+'"] a div.secondary-content i').css('color','grey');
                        break;
                    case 'ritirata':
                        $('button.change-state-lab').removeClass('change-state').text('Ormai è stata consegnata');
                        $('div#lab.collection a[data-id="'+data.id+'"] div.secondary-content i').text('done_all');
                        $('div#lab.collection a[data-id="'+data.id+'"] div.secondary-content i').css('color','#4CAF50');
                        break;*/
                }
            }, 1600);
        }).fail(function() {
            //alert('Posts could not be loaded.');
    });
}

function change_state(){
    $('.progress').removeClass('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        data:{
            'note':$('.note-field textarea').val()
        },
        url : 'change-state-lab/'+$('input.change-state-lab').val(),
        dataType: 'json',
        type: 'POST'
    }).done(function (data){
        console.log(data);
        setTimeout(function(){
            var lab_item = $('div#lab.collection a.lab-item[data-id="'+data.id+'"]');
            var lab_icon = $('div#lab.collection a.lab-item[data-id="'+data.id+'"] div.secondary-content i');
            switch(data.stato){
                case 'creata':
                    $('button.change-state-lab').text('Inizia');
                    lab_icon.text('hourglass_empty');
                    lab_icon.css('color','grey');
                    break;
                case 'iniziata':
                    $('button.change-state-lab').addClass('hide');
                    $('button.finish-state-lab').removeClass('hide');
                    $('.modal-change').modal();
                    $('div#modal-change.modal .modal-footer a.finish-action').prop('href','/finish-state-lab/'+data.id);
                    $('.update-lab').removeClass('hide');
                    $('.note-field textarea').val(data.note_lab);
                    $('button.change-state-lab').addClass('hide');
                    $('div.note-field').removeClass('hide');
                    if(data.assistenza === true){
                        }else{
                            $('.deliverable-lab').removeClass('hide');
                            $('div#modal-deliverable.modal .modal-footer a.set-deliverable').prop('href','/set-deliverable-lab/'+data.id);
                        }
                    lab_icon.text('done');
                    lab_icon.css('color','grey');
                    break;
                /*case 'finita':
                    $('button.change-state-lab').text('Quì hai finito');
                    //$('button.change-state-lab').sideNav('hide');
                    lab_item.remove();
                    break;*/
                /*case 'ritirata':
                    $('button.change-state-lab').text('Ormai è stata consegnata');
                    lab_item.remove();
                    break;*/
            }
            $('.finish-state-lab').removeClass('hide');
            Materialize.toast('Stato Cambiato in: '+data.stato, 4000);
            $('.progress').addClass('hide');
        },800);
       
    }).fail(function(){
        //$('.progress').addClass('hide');
        //alert('State could not be changed.');
    });
}

function update_lab(){
    $('.progress').removeClass('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        data:{
            'note_lab':$('.note-field textarea').val()
        },
        url : 'update-note-lab/'+$('input.change-state-lab').val(),
        dataType: 'json',
        type: 'POST'
    }).done(function (data){
        console.log(data);
        setTimeout(function(){
            $('.note-field textarea').val(data.note_lab)
            Materialize.toast('Note Salvate!', 4000);
            $('.progress').addClass('hide');
        },800);
       
    }).fail(function(){
        $('.progress').addClass('hide');
        alert('State could not be changed.');
    });
}

$('.send_sms_status').on('click',function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : '/sms-status-repair/'+$(this).data('id'),
        dataType: 'json',
        type: 'POST'
    }).done(function (data){
        console.log(data);
        if(data.status === 200){
            Materialize.toast('SMS inviato correttamente! 🤖', 4000);
        }else{
            Materialize.toast('Qualcosa è adato storto! 😕', 4000);
        }
        setTimeout(function(){
        },800);
       
    }).fail(function(data){
        console.log(data);
    });
});

$('a.test-reset-p').on('click',function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url : '/password/email',
        data:{
            'email':'microtel.tre@gmail.com'
        },
        dataType: 'json',
        type: 'POST'
    }).done(function (data){
        console.log(data);
        if(data.status === 200){
            Materialize.toast('SMS inviato correttamente! 🤖', 4000);
        }else{
            Materialize.toast('Qualcosa è adato storto! 😕', 4000);
        }
        setTimeout(function(){
        },800);
       
    }).fail(function(data){
        console.log(data);
    });
});