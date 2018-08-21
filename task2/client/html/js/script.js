
function checkStorage(){
    if (localStorage.length!=0){
        let entry = JSON.parse(localStorage.getItem('entry'));
        showOnTable(entry);
    }
}

function getCarList(){
    url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
    //url=`http://127.0.0.1/my/courses/soap/task2/client/index.php`;
    var formData = {
        'action': 'getCarList'
    };
    $.post(url, formData, function( data ) {
        showOnTable(data)
    }, "json");
}

function getDetails(id){
    url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
    //url=`http://127.0.0.1/my/courses/soap/task2/client/index.php`;
    var formData = {
        'action': 'getById',
        'id': id
    };
    $.post(url, formData, function( data ) {
        showOnDetails(data)
    }, "json");
}

function searchCars(){
    url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
    //url=`http://127.0.0.1/my/courses/soap/task2/client/index.php`;
    var formData = {
        'filter': {'model': $('select[name=model]').val(),
            'year'              : $('input[name=year]').val(),
            'engine'             : $('input[name=engine]').val(),
            'color': $('select[name=color]').val(),
            'maxspeed'    : $('input[name=maxspeed]').val(),
            'price'    : $('input[name=price]').val(),
        },
        'action': 'searchCars'
    };
    $.post(url, formData, function( data ) {
        showOnTable(data)
    }, "json");
}

function fillModelList(){
    //url=`http://127.0.0.1/my/courses/soap/task2/client/index.php?action=getCarList`;
    //url=`http://192.168.0.15/~user12/soap/task2/client/index.php?action=getCarList`;
    url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
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
    let t = document.getElementById("table");
    //let table=objToTable(entry);
    //t.innerHTML=objToTable(entry);

    let table=carsListToTable(entry);
    t.innerHTML=carsListToTable(entry);
}

function showOnDetails(entry){
    let t = document.getElementById("details");
    //let table=objToTable(entry);
    //t.innerHTML=objToTable(entry);

    let table=objToTable(entry);
    t.innerHTML=table;
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
    let table='';
    if (cars.length){
        table+='<tr>';
        table+='<th>id</th> <th>mark</th> <th>model</th> <th></th>';
        table+='</tr>';

        for(let i in cars){
            let id=cars[i]['id'];
            table+='<tr>';
            table+='<td>'+id+'</td> <td>'+cars[i]['mark']+'</td> <td>'+cars[i]['model']+'</td>';
            table+='<td>'+
                '<button type="submit" class="btn btn-primary"'+
                'onclick="getDetails('+id+')">Details</button>'+
                '</td>';

            table+='</tr>';
        }
    }
    return table;
}

function objToTable(o){
    let table='';
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
    return table;
}






