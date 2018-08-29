//const url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
const url=`http://127.0.0.1/my/courses/soap/task2/client/index.php`;

function checkStorage(){
    if (localStorage.length!=0){
        let entry = JSON.parse(localStorage.getItem('entry'));
        showOnTable(entry);
    }
}

function getCarList(){
    let formData = {
        'action': 'getCarList'
    };
    $.post(url, formData, function( data ) {
        showOnTable(data)
    }, "json");
}

function getDetails(id){
    let formData = {
        'action': 'getById',
        'id': id
    };
    $.post(url, formData, function( data ) {
        showOnDetails(data)
    }, "json");
}

function searchCars(){
    let year = $('input[name=year]').val();
    //if (year){

        let formData = {
            'filter': {'mark': $('select[name=mark]').val(),
                'model'              : $('input[name=model]').val(),
                'year'              : $('input[name=year]').val(),
                'engine'             : $('input[name=engine]').val(),
                'color': $('select[name=color]').val(),
                'maxspeed'    : $('input[name=maxspeed]').val(),
                'price'    : $('input[name=price]').val(),
            },
            'action': 'searchCars'
        };
        $.post(url, formData, function( data ) {
            if (data['errors']){
                let t = document.getElementById("results");
                t.innerHTML = '<h3 class="text-danger">Error: '+data.errors+'</h3>';

            }else
            {
                showOnTable(data);
            }

        }, "json");
    //}else{
        //alert('Enter the year!');
    //}
}

function order(){
    let formData = {
        'action': 'order',
        'orderData': {
            'idcar': $('input[name=id]').val(),
            'firstname': $('input[name=name]').val(),
            'lastname': $('input[name=surname]').val(),
            'payment': $('select[name=paytype]').val(),
        }
    };
    $.post(url, formData, function(data) {
        let div = document.getElementById("results");
        let id = data.id;
        div.innerHTML = "<h3 class='text-success'>The car with id="+id+" is successfully ordered!</h3>";
    }, "json");
}

function getOrderForm(id){
    let formData = {
        'action': 'getOrderForm',
        'id': id
    };
    $.post(url, formData, function( data ) {
        let div = document.getElementById("results");
        div.innerHTML = data;
    }, "html");
}

function fillModelList(){
    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({a: 1, action: 'getCarList'})
    })
        .then(response => response.json())
        .then(json=>{
            localStorage.setItem('entry', JSON.stringify(json));
            showOnModelList(json);
        });
}

function showOnTable(entry){
    let t = document.getElementById("results");
    //let table=objToTable(entry);
    //t.innerHTML=objToTable(entry);
    let table=carsListToTable(entry);
    t.innerHTML=table;

    let t2 = document.getElementById("details");
    t2.innerHTML="";
}

function showOnDetails(entry){
    let t = document.getElementById("details");
    //let table=objToTable(entry);
    //t.innerHTML=objToTable(entry);

    let table=objToTable(entry);
    let html = "<h3>Car details</h3>"+table;
    t.innerHTML = html;

}

function showOnModelList(cars){
    let t = document.getElementById("model");
    let htmlVal='<option value="">------Select model</option>';
    for(let car in cars){
        htmlVal+= '<option>' + cars[car].model + '</option>';
    }
    t.innerHTML=htmlVal;
}


function carsListToTable(cars){
    let table='<table class="table" id="table">';
    if (cars.length){
        table+='<tr class="row">';
        table+='<th class="col-lg-1">id</th> <th class="col-lg-4">mark</th> '
            +'<th class="col-lg-5">model</th> <th class="col-lg-1"></th> <th class="col-lg-1"></th>';
        table+='</tr>';
        for(let i in cars){
            let id=cars[i]['id'];
            table+='<tr class="row">';
            table+='<td class="col-lg-1">'+id+'</td> <td class="col-lg-4">'
                +cars[i]['mark']+'</td> <td class="col-lg-5">'+cars[i]['model']+'</td>';
            table+='<td class="col-lg-1">'+
                '<button type="submit" class="btn btn-primary"'+
                'onclick="getDetails('+id+')">Details</button>'+
                '</td>';
            table+='<td class="col-lg-1">'+
                '<button type="submit" class="btn btn-danger"'+
                'onclick="getOrderForm('+id+')">Order</button>'+
                '</td>';
            table+='</tr>';
        }
        table+='</table>';
    }
    return table;
}

function objToTable(o){
    let table='<table class="table" id="table">';
    if (o.length){
        table+='<tr>';
        for(key in o[0]){
            table+='<th>'+key+'</th>';
        }
        table+='</tr>';
        for(row in o){
            table+='<tr>';
            for (cell in o[row]){
                table+='<td>'+o[row][cell]+'</td>';
            }
            table+='</tr>';
        }
    }else{
        table+='<tr>';
        for(key in o){
            table+='<th>'+key+'</th>';
        }
        table+='</tr>';

        table+='<tr>';
        for(key in o){
            table+='<td>'+o[key]+'</td>';
        }
        table+='</tr>';
    }
    table+='</table>';
    return table;
}






