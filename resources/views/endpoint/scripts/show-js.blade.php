$(document).ready(function () {
  let endpoint = "{{ $endpoint->endpoint_url }}";
  let type = 'GET';

  $("#btn-submit").click(function(){
    type = $("#action").val();
    endpoint = $("#text-field-endpoint").val();

    index();
  });

  function index(){
    $.ajax({
      type: type,   
      url: endpoint,
      headers: JSON.parse(replaceAll("{{ $headers }}", 'double-qoute', '"')),
      data: JSON.parse(replaceAll("{{ $data }}", 'double-qoute', '"')),
      success: function (response) {
        if (response && response.data.length > 0) {
          responseToTable(response, '#indexTable');
        } else {
          console.log(response);
        }
      },
      error: function (response) {
        console.log(response);
      }
    });
  }

  function responseToTable(response, tableElement = '') {
    $(tableElement+' thead').empty();
    $(tableElement+' tbody').empty();
    $('#toggleColumn').empty();
    $('#dateRange').empty();

    var headers = Object.keys(response.data[0]);
        
    var loop = 0;
    var th = '';
    var columns = '';
    while (loop < headers.length) {
      switch (headers[loop]) {
        case 'created_at':
          th = th + '<th data-field="'+headers[loop]+'">Created</th>';
          columns = columns + '<a href="#" class="toggle-vis" data-column="'+loop+'">Created</a> - '; 
          break;
        case 'updated_at':
          th = th + '<th data-field="'+headers[loop]+'">Updated</th>';
          columns = columns + '<a href="#" class="toggle-vis" data-column="'+loop+'">Updated</a>'; 
          break;
        default:
          let field = headers[loop];
          field = field.replace("_", " ");
          th = th + '<th data-field="'+headers[loop]+'">'+camelCase(field)+'</th>';
          columns = columns + '<a href="#" class="toggle-vis" data-column="'+loop+'">'+camelCase(field)+'</a> - ';
      }
      loop = loop + 1;
    }    

    $('#toggleColumn').append('<b>Toggle Columns</b>: '+columns);
    $(tableElement+' thead').append('<tr>'+th+'</tr>');
    $(tableElement+' thead').append('<tr class="filters">'+th+'</tr>');

    $.each(response.data, function(index, item) {
      var objKeys = Object.keys(item);
      var objValues = Object.values(item);

      var loop = 0;
      var td = '';
      while (loop < objKeys.length) {
        switch (objKeys[loop]) {
          case 'id':
            var id = objValues[loop];
            td = td + '<td>'+objValues[loop]+'</td>';
            break;
          case 'created_at':
            date = new Date(objValues[loop]);
            td = td + '<td>'+ date.toDateString() + ' ' + formatAMPM(date) + '</td>';
            break;
          case 'updated_at':
            date = new Date(objValues[loop]);
            td = td + '<td>'+ date.toDateString() + ' ' + formatAMPM(date) + '</td>';
            break;
          default:
            td = td + '<td>'+objValues[loop]+'</td>';
        }
        loop = loop + 1;
      }
      
      $(tableElement+' tbody').append(
        '<tr id="'+id+'">'+td+'</tr>');
    });    

    $.fn.columnCount = function() {
      return $('th', $(this).find('thead tr:first')).length;
    };

    $('#indexTable').dataTable().fnDestroy();

    var table = $("#indexTable").DataTable({
      dom: 'Bfltip',
      buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5'
      ],
      orderCellsTop: true,
      fixedHeader: true,
      initComplete: function() {
        var api = this.api();
        // For each column
        api.columns().eq(0).each(function(colIdx) {
            var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
            var title = $(cell).text();
            $(cell).html( '<input type="text" placeholder="'+title+'" />' );

            $('input', $('.filters th').eq($(api.column(colIdx).header()).index()) )
              .off('keyup change')
              .on('keyup change', function (e) {
                  e.stopPropagation();
                  // Get the search value
                  $(this).attr('title', $(this).val());
                  var regexr = '({search})'; //$(this).parents('th').find('select').val();
                  var cursorPosition = this.selectionStart;
                  // Search the column for that value
                  api
                      .column(colIdx)
                      .search((this.value != "") ? regexr.replace('{search}', '((('+this.value+')))') : "", this.value != "", this.value == "")
                      .draw();
                  $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
            });
        });
      },
      order: [[0, 'desc']]
    });

    var columnCount = $("#indexTable").columnCount();

    table.column(0).visible(false);
    table.column(columnCount - 1).visible(false);
    table.column(columnCount - 2).visible(false);

    $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();
        var column = table.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });

    var minDate, maxDate;
 
    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date( data[4] );
     
            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }
    );

    $('#dateRange').append('<b>Date Started</b> <input type="text" id="min" name="min"> <b>Date Ended</b> <input type="text" id="max" name="max"><br>');

    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });

    $('#min, #max').on('change', function () {
        table.draw();
    });
  }

  function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
  }

  function camelCase(str){
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
  }

  function getAllUrlParams(url) {
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
    var obj = {};

    if (queryString) {
      queryString = queryString.split('#')[0];

      var arr = queryString.split('&');

      for (var i = 0; i < arr.length; i++) {
        var a = arr[i].split('=');
        var paramName = a[0];
        var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

        paramName = paramName.toLowerCase();
        if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

        if (paramName.match(/\[(\d+)?\]$/)) {

          var key = paramName.replace(/\[(\d+)?\]/, '');
          if (!obj[key]) obj[key] = [];

          if (paramName.match(/\[\d+\]$/)) {
            var index = /\[(\d+)\]/.exec(paramName)[1];
            obj[key][index] = paramValue;
          } else {
            obj[key].push(paramValue);
          }
        } else {
          if (!obj[paramName]) {
            obj[paramName] = paramValue;
          } else if (obj[paramName] && typeof obj[paramName] === 'string'){
            obj[paramName] = [obj[paramName]];
            obj[paramName].push(paramValue);
          } else {
            obj[paramName].push(paramValue);
          }
        }
      }
    }

    return obj;
  }

  function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
  }
});