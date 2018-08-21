
function checkStorage(){
    if (localStorage.length!=0){
        let entry = JSON.parse(localStorage.getItem('entry'));
        showOnTable(entry);
    }
}

function getCarList(){
    //let selectCat=document.getElementById("model");
    //let category=selectCat[selectCat.selectedIndex].text;
    //let num=document.getElementById("input").value;
    var url="";
    //url=`http://127.0.0.1/my/courses/soap/task2/client/index.php?action=getCarList`;
    //url=`http://192.168.0.15/~user12/soap/task2/client/index.php?action=getCarList`;
    //var data = new FormData(document.getElementById("car-form"));
    //data.append("action", "getCarList");

    //url=`http://192.168.0.15/~user12/soap/task2/client/index.php`;
    url=`http://127.0.0.1/my/courses/soap/task2/client/index.php`;
    //fetch(url, {
    //method: 'post',
    //headers: {
    //'Accept': 'application/json',
    //'Content-Type': 'application/json'
    //},
    //body: data
    //})
    //.then(response => response.json())
    //.then(json=>{
    //localStorage.setItem('entry', JSON.stringify(json));
    //showOnTable(json);
    //});

    //fetch(url)
    //.then(response => response.json())
    //.then(json=>{
    //localStorage.setItem('entry', JSON.stringify(json));
    //showOnTable(json);
    //});

    // var data= { action: 'getCarList', something: 'lala' };
    // axios.post(url, JSON.stringify(data), {
    //     headers: {
    //         'Content-Type': 'application/json',
    //     }
    // })
    //     .then(function (response) {
    //         console.log(response.data);
    //         showOnTable(response.data)
    //     })
    //     .catch(function (error) {
    //         console.log(error);
    //     });

    // $.post(url, function( data ) {
    //     $( ".result" ).html( data );
    // });

    //var form = document.querySelector("form[name=carform]");
    //var formData = new FormData(form);
    //formData.append('action','getCarList');

    var formData = {
        'year'              : $('input[name=year]').val(),
        'engine'             : $('input[name=engine]').val(),
        'maxspeed'    : $('input[name=maxspeed]').val(),
        'action': 'getCarList'
    };


    let params = { action: "getCarList" };
    $.post(url, formData, function( data ) {
        showOnTable(data)
    }, "json");

    // axios({
    //     method: 'post',
    //     url: url,
    //     data: {
    //         action: 'getCarList',
    //         lastName: 'Flintstone'
    //     }
    // })
    //     .then(function (response) {
    //         console.log(response.data);
    //         showOnTable(response.data)
    //     })
    //     .catch(function (error) {
    //         console.log(error);
    //     });

    //)
    //.then(response => (showOnTable(response.data)));
    ////.then(response => response.json())
    ////.then(json=>{
    //////localStorage.setItem('entry', JSON.stringify(json));
    ////showOnTable(json);
    ////});
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
    let table=objToTable(entry);
    t.innerHTML=objToTable(entry);
}

function showOnModelList(cars){
    let t = document.getElementById("model");
    let htmlVal='<option value="">------Select model</option>';
    for(let car in cars){
        htmlVal+= '<option>' + cars[car].model + '</option>';
    }
    t.innerHTML=htmlVal;
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






