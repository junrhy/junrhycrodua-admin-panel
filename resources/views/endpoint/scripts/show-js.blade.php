$(document).ready(function () {
  const email = "{{ $allAuth['email'] }}";
  const password = "{{ $allAuth['password'] }}";
  const brand_id = "{{ $allAuth['brand_id'] }}";

  let bearerToken = "";

  $(function(){
    login();
  });

  function login(){
    $.ajax({
      type: 'POST',   
      url: "https://api.junrhycrodua.com/api/login",
      headers: {
          'Accept': 'application/json'
      },
      data: {
      	  'email': email,
      	  'password': password,
      	  'brand_id': brand_id
      },
      success: function (response) {
        bearerToken = response.token;
        index();
      },
      error: function (response) {
          console.log(response);
      }
    });
  }

  function logout(){
    $.ajax({
      type: 'POST',   
      url: "https://api.junrhycrodua.com/api/logout",
      headers: {
          'Authorization': 'Bearer ' + bearerToken,
          'Accept': 'application/json'
      },
      success: function (response) {
          // console.log(response);
      },
      error: function (response) {
          console.log(response);
      }
    });
  }
  
  function index(){
    $.ajax({
      type: 'GET',   
      url: "{{ $endpoint->endpoint_url }}",
      headers: {
          'Authorization': 'Bearer ' + bearerToken,
          'Accept': 'application/json'
      },
      success: function (response) {
        responseToTable(response);
        logout();
      },
      error: function (response) {
          console.log(response);
      }
    });
  }

  function responseToTable(response) {
    var headers = Object.keys(response.data[0]);
        
    var loop = 0;
    var th = '';
    while (loop < headers.length) {
      switch (headers[loop]) {
        case 'id':
          break;
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

    $('#indexTable th:first').after(th);

    $.each(response.data, function(index, item) {
      var objKeys = Object.keys(item);
      var objValues = Object.values(item);

      var loop = 0;
      var td = '';
      while (loop < objKeys.length) {
        switch (objKeys[loop]) {
          case 'id':
            var id = objValues[loop];
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
      
      $('#indexTable tbody').append(
        '<tr id="'+id+'">\
          <td><input type="checkbox" name="endpoints" value="'+id+'"></td>'+td+'</tr>');

      var edit = '<button class="btn btn-sm btn-warning">Edit</button>';

      $('td:last').after('<td>'+edit+'</td>');
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
});