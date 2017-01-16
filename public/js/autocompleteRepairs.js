
            
function autocompleteRepairs(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var repairs = {
        'data':{}
    };
    $.ajax({
        url:'/ajax-repairs',
        type: 'GET',
        success: function(dat){
            console.log('repairs ajax:');
            console.log(dat);
            var len = dat.length;
            for (var i = 0; i < len; i++) {
              var seriale = dat[i].seriale;
              var repairsdata = repairs['data'];
              var info = {'seriale':dat[i].seriale,'id':dat[i].id,'modello':dat[i].device.model,'proprietario':dat[i].person.nome+' '+dat[i].person.cognome}
              repairsdata[seriale] = info;
            }
            //console.log(data);
            $('input.autocomplete2showREP.repairs').autocompletesb2showREP(repairs);
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
$.fn.autocompletesb2showREP = function(options){
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
                var i=0;
                for(var key in data) {
                    if (data.hasOwnProperty(key) &&
                        key.toLowerCase().indexOf(val) !== -1 &&
                        key.toLowerCase() !== val && i<6) {
                            var autocompleteOption = $('<li data-seriale="'+data[key].seriale+'" data-modello="'+data[key].modello+'" data-proprietario="'+data[key].proprietario+'"></li>');
                            autocompleteOption.append('<a href="/repair/'+data[key].id+'"><span>'+data[key].modello+' ('+data[key].seriale +')</span></a>');
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