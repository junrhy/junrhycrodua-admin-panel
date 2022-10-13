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
    $(tableElement+' thead > tr').empty();
    $(tableElement+' tbody').empty();

    var headers = Object.keys(response.data[0]);
        
    var loop = 0;
    var th = '';
    while (loop < headers.length) {
      switch (headers[loop]) {
        case 'created_at':
          th = th + '<th data-field="'+headers[loop]+'">Created</th>';
          break;
        case 'updated_at':
          th = th + '<th data-field="'+headers[loop]+'">Updated</th>';
          break;
        default:
          let field = headers[loop];
          field = field.replace("_", " ");
          th = th + '<th data-field="'+headers[loop]+'">'+camelCase(field)+'</th>';
      }
      loop = loop + 1;
    }    

    $(tableElement+' thead > tr').append(th);

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

    $("#indexTable").DataTable(); 
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